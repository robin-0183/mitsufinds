<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function home()
    {
        $products = collect();

        $allCoupons = [
            '10% off <0€',
            '5% off <0€',
            '16,11€ off <161,41€',
            '3€ off <0€',
            '35,15€ off <300€',
            '100€ off <550€',
        ];
        $coupons = collect($allCoupons)->random(3)->values()->all();

        return view('home', [
            'products' => $products,
            'coupons' => $coupons,
        ]);
    }

    public function publicIndex()
    {
        $products = Cache::remember('products.public', now()->addMinutes(5), function () {
            return Product::query()
                ->where('is_active', true)
                ->latest()
                ->get();
        });

        return view('products', [
            'products' => $products,
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::query()->latest()->get();

        return view('admin.products.index', [
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:50'],
            'brand' => ['nullable', 'string', 'max:50'],
            'image' => ['nullable', 'image', 'max:2048'],
            'image_url' => ['nullable', 'url', 'max:2048'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'affiliate_url' => ['required', 'url', 'max:2048'],
            'description' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $slugBase = Str::slug($validated['name']);
        $slug = $slugBase;
        $counter = 1;

        while (Product::query()->where('slug', $slug)->exists()) {
            $slug = $slugBase.'-'.$counter;
            $counter++;
        }

        $imagePath = null;
        $imageUrl = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        } elseif (! empty($validated['image_url'] ?? null)) {
            $imageUrl = $validated['image_url'];
        }

        Product::query()->create([
            'name' => $validated['name'],
            'category' => $validated['category'],
            'brand' => $validated['brand'] ?? null,
            'slug' => $slug,
            'image_url' => $imageUrl,
            'image_path' => $imagePath,
            'price' => $validated['price'] ?? null,
            'affiliate_url' => $validated['affiliate_url'],
            'description' => $validated['description'] ?? null,
            'is_active' => $request->boolean('is_active', true),
        ]);

        Cache::forget('products.public');

        return redirect()
            ->route('admin.products.index')
            ->with('status', 'Product created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        Cache::forget('products.public');

        return redirect()
            ->route('admin.products.index')
            ->with('status', 'Product deleted.');
    }
}
