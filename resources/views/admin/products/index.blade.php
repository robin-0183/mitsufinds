<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Products · Admin · {{ config('app.name', 'mxtsu') }}</title>
        <style>
            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
                background: #020617;
                color: #e5e7eb;
            }

            .shell {
                max-width: 1100px;
                margin: 0 auto;
                padding: 2rem 1.5rem 3rem;
            }

            header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 1.75rem;
            }

            .title {
                font-size: 1.4rem;
                font-weight: 600;
            }

            .subtitle {
                font-size: 0.9rem;
                opacity: 0.7;
            }

            .actions {
                display: flex;
                align-items: center;
                gap: 0.75rem;
            }

            .actions form {
                margin: 0;
            }

            a.btn,
            button.btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 0.5rem 0.9rem;
                border-radius: 999px;
                border: 1px solid transparent;
                font-size: 0.85rem;
                font-weight: 500;
                cursor: pointer;
                text-decoration: none;
            }

            .btn-primary {
                background: #f97316;
                border-color: #ea580c;
                color: #0b1120;
            }

            .btn-primary:hover {
                background: #fdba74;
                border-color: #fb923c;
            }

            .btn-ghost {
                background: transparent;
                border-color: #374151;
                color: #e5e7eb;
            }

            .btn-ghost:hover {
                background: #020617;
                border-color: #4b5563;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 0.5rem;
                font-size: 0.9rem;
                background: #020617;
                border-radius: 0.75rem;
                overflow: hidden;
                border: 1px solid #1f2937;
            }

            thead {
                background: #020617;
            }

            th,
            td {
                padding: 0.7rem 0.9rem;
                text-align: left;
            }

            th {
                font-weight: 500;
                font-size: 0.8rem;
                text-transform: uppercase;
                letter-spacing: 0.08em;
                border-bottom: 1px solid #1f2937;
                color: #9ca3af;
            }

            tbody tr:nth-child(odd) {
                background: #020617;
            }

            tbody tr:nth-child(even) {
                background: #020617;
            }

            tbody tr + tr td {
                border-top: 1px solid #111827;
            }

            .status-pill {
                display: inline-flex;
                align-items: center;
                padding: 0.15rem 0.6rem;
                border-radius: 999px;
                font-size: 0.75rem;
            }

            .status-pill--active {
                background: rgba(34, 197, 94, 0.12);
                color: #4ade80;
            }

            .status-pill--inactive {
                background: rgba(148, 163, 184, 0.2);
                color: #cbd5f5;
            }

            .empty {
                margin-top: 3rem;
                text-align: center;
                opacity: 0.75;
                font-size: 0.95rem;
            }

            .price-cell {
                white-space: nowrap;
            }

            .url-cell {
                max-width: 260px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .actions-cell {
                white-space: nowrap;
                text-align: right;
            }

            .btn-danger {
                background: transparent;
                border-color: #7f1d1d;
                color: #fecaca;
            }

            .btn-danger:hover {
                background: #7f1d1d;
                border-color: #b91c1c;
                color: #fee2e2;
            }
        </style>
    </head>
    <body>
        <div class="shell">
            <header>
                <div>
                    <div class="title">Products</div>
                    <div class="subtitle">Manage items shown on the mxtsu home page.</div>
                </div>

                <div class="actions">
                    <a href="{{ route('home') }}" class="btn btn-ghost">View site</a>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add product</a>
                    <form method="POST" action="{{ route('logout') }}" class="actions-form">
                        @csrf
                        <button type="submit" class="btn btn-ghost">Logout</button>
                    </form>
                </div>
            </header>

            @if (session('status'))
                <div style="margin-bottom: 1rem; font-size: 0.9rem; color: #bbf7d0;">
                    {{ session('status') }}
                </div>
            @endif

            @if ($products->isEmpty())
                <div class="empty">
                    No products yet. Click “Add product” to create your first ACBuy affiliate item.
                </div>
            @else
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Affiliate URL</th>
                            <th>Created</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td class="price-cell">
                                    @if ($product->price)
                                        ${{ number_format($product->price, 2) }}
                                    @else
                                        —
                                    @endif
                                </td>
                                <td>
                                    @if ($product->is_active)
                                        <span class="status-pill status-pill--active">Active</span>
                                    @else
                                        <span class="status-pill status-pill--inactive">Hidden</span>
                                    @endif
                                </td>
                                <td class="url-cell">
                                    <a href="{{ $product->affiliate_url }}" target="_blank" rel="noopener noreferrer" style="color:#93c5fd;text-decoration:none;">
                                        {{ $product->affiliate_url }}
                                    </a>
                                </td>
                                <td>{{ $product->created_at?->format('Y-m-d') }}</td>
                                <td class="actions-cell">
                                    <form
                                        method="post"
                                        action="{{ route('admin.products.destroy', $product) }}"
                                        style="display:inline"
                                        onsubmit="return confirm('Delete this product?');"
                                    >
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </body>
</html>
