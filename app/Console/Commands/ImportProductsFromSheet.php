<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ImportProductsFromSheet extends Command
{
    protected $signature = 'products:import-from-sheet
                            {--url= : CSV export URL (optional; uses default sheet if not set)}
                            {--category= : Force category for all rows (hoodies, tees, jeans, sweats, boots, shoes, jerseys, jewelry)}
                            {--dry-run : Parse and show what would be imported without saving}';

    protected $description = 'Import products from a published Google Sheet CSV (Names, Photos, Links, Prices)';

    private string $defaultSheetUrl = 'https://docs.google.com/spreadsheets/d/1p9C-2Rf5tbNtI-K5kr0sPp9l-ETyHHSdVj0LeK7MGN8/export?format=csv&gid=925700975';

    public function handle(): int
    {
        $url = $this->option('url') ?: $this->defaultSheetUrl;
        $forceCategory = $this->option('category');
        $dryRun = $this->option('dry-run');

        $this->info('Fetching CSV from sheet...');

        $response = Http::timeout(30)->get($url);

        if (! $response->successful()) {
            $this->error('Could not fetch sheet. Status: '.$response->status().'. Ensure the sheet is shared (Anyone with the link can view) or use File → Share → Publish to web → CSV and pass that URL with --url=');

            return self::FAILURE;
        }

        $csv = $response->body();
        $rows = $this->parseCsv($csv);
        if (empty($rows)) {
            $this->warn('No rows parsed from CSV.');

            return self::FAILURE;
        }

        $currentCategory = $forceCategory ?: 'hoodies';
        $created = 0;
        $skipped = 0;
        $sectionMap = [
            'hoodies' => 'hoodies',
            'jeans' => 'jeans',
            'jeans/sweatpants' => 'jeans',
            'sweats' => 'sweats',
            'shirts' => 'tees',
            'shirts/longsleeves' => 'tees',
            'longsleeves' => 'tees',
            'tees' => 'tees',
            'jerseys' => 'jerseys',
            'shoes' => 'shoes',
            'shoes/boots' => 'shoes',
            'boots' => 'boots',
            'jewelery' => 'jewelry',
            'jewelry' => 'jewelry',
            'accesories' => 'jewelry',
            'accessories' => 'jewelry',
        ];

        foreach ($rows as $index => $row) {
            $rowNum = $index + 1;
            $name = isset($row[0]) ? trim((string) $row[0]) : '';
            $image = isset($row[1]) ? trim((string) $row[1]) : '';
            $link = isset($row[3]) ? trim((string) $row[3]) : (isset($row[2]) ? trim((string) $row[2]) : '');
            $priceStr = isset($row[4]) ? trim((string) $row[4]) : '';

            if ($name === '') {
                continue;
            }

            if ($this->isSectionHeader($name, $sectionMap)) {
                $currentCategory = $this->resolveSectionCategory($name, $sectionMap);
                if (! $forceCategory) {
                    $this->line("  Section: {$name} → category: {$currentCategory}");
                }
                continue;
            }

            if (in_array(strtolower($name), ['names', 'photos', 'links', 'prices'], true)) {
                continue;
            }

            $affiliateUrl = $this->extractUrl($link);
            if ($affiliateUrl === null) {
                $affiliateUrl = config('app.url', 'https://mitsufinds.test').'/links';
            }

            $imageUrl = $this->extractUrl($image);
            $price = $this->parsePrice($priceStr);

            $slugBase = Str::slug($name);
            $slug = $slugBase;
            $counter = 1;
            while (Product::query()->where('slug', $slug)->exists()) {
                $slug = $slugBase.'-'.$counter;
                $counter++;
            }

            $category = $forceCategory ?: $currentCategory;
            if (! in_array($category, ['hoodies', 'tees', 'jeans', 'sweats', 'boots', 'shoes', 'jerseys', 'jewelry'], true)) {
                $category = 'hoodies';
            }

            if ($dryRun) {
                $this->line("  [{$rowNum}] {$name} | {$category} | ".($price !== null ? '€'.$price : 'no price').' | '.($imageUrl ? 'has image' : 'no image'));

                $created++;
                continue;
            }

            Product::query()->create([
                'name' => $name,
                'category' => $category,
                'brand' => null,
                'slug' => $slug,
                'image_url' => $imageUrl,
                'image_path' => null,
                'price' => $price,
                'affiliate_url' => $affiliateUrl,
                'description' => null,
                'is_active' => true,
            ]);
            $created++;
        }

        if ($dryRun) {
            $this->info("Dry run: would import {$created} products.");
        } else {
            $this->info("Imported {$created} products.");
        }

        return self::SUCCESS;
    }

    private function parseCsv(string $csv): array
    {
        $lines = preg_split('/\r\n|\r|\n/', $csv);
        $out = [];
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '') {
                continue;
            }
            $decoded = str_getcsv($line);
            if ($decoded !== false && $decoded !== [null]) {
                $out[] = $decoded;
            }
        }

        return $out;
    }

    private function isSectionHeader(string $name, array $sectionMap): bool
    {
        $lower = strtolower($name);
        if (isset($sectionMap[$lower])) {
            return true;
        }
        foreach (array_keys($sectionMap) as $key) {
            if (str_contains($key, $lower) || str_contains($lower, $key)) {
                return true;
            }
        }
        if (in_array($lower, ['hoodies', 'jeans', 'tees', 'jerseys', 'shirts', 'sweats', 'shoes', 'boots', 'jewelry', 'accessories', 'jewelery'], true)) {
            return true;
        }

        return false;
    }

    private function resolveSectionCategory(string $name, array $sectionMap): string
    {
        $lower = strtolower($name);
        if (isset($sectionMap[$lower])) {
            return $sectionMap[$lower];
        }
        foreach ($sectionMap as $key => $cat) {
            if (str_contains($lower, $key) || str_contains($key, $lower)) {
                return $cat;
            }
        }

        return 'hoodies';
    }

    private function extractUrl(string $value): ?string
    {
        $value = trim($value);
        if ($value === '' || strtolower($value) === 'link') {
            return null;
        }
        if (preg_match('/^https?:\/\/\S+$/i', $value)) {
            return $value;
        }
        if (preg_match('/https?:\/\/[^\s\)"\']+/i', $value, $m)) {
            return trim($m[0]);
        }

        return null;
    }

    private function parsePrice(string $value): ?float
    {
        if ($value === '') {
            return null;
        }
        if (preg_match('/≈?EUR\s*€?\s*([\d,\.]+)/ui', $value, $m)) {
            $num = str_replace(',', '.', $m[1]);

            return is_numeric($num) ? (float) $num : null;
        }
        if (preg_match('/USD\s*\$?\s*([\d,\.]+)/ui', $value, $m)) {
            $num = str_replace(',', '.', $m[1]);

            return is_numeric($num) ? (float) $num : null;
        }
        if (preg_match('/€\s*([\d,\.]+)/u', $value, $m)) {
            $num = str_replace(',', '.', $m[1]);

            return is_numeric($num) ? (float) $num : null;
        }

        return null;
    }
}
