<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>TikTok videos · Admin · {{ config('app.name', 'mxtsu') }}</title>
        <style>
            * { box-sizing: border-box; }

            body {
                margin: 0;
                font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
                background: #000000;
                color: #e5e7eb;
            }

            .shell {
                max-width: 1100px;
                margin: 0 auto;
                padding: 5rem 1.5rem 3rem;
            }

            .title {
                position: fixed;
                top: 1.5rem;
                left: 1.5rem;
                font-size: 2rem;
                font-weight: 800;
                letter-spacing: 0.02em;
                margin: 0;
                z-index: 10;
            }

            .header-actions {
                position: fixed;
                top: 1.5rem;
                right: 1.5rem;
                display: flex;
                align-items: center;
                gap: 1rem;
                z-index: 10;
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
                background: #000000;
                border-radius: 0.75rem;
                overflow: hidden;
                border: 1px solid #111827;
            }

            thead {
                background: #000000;
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

            tbody tr + tr td {
                border-top: 1px solid #020617;
            }

            tbody tr:nth-child(odd) {
                background: #000000;
            }

            tbody tr:nth-child(even) {
                background: #000000;
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

            .empty {
                margin-top: 3rem;
                text-align: center;
                opacity: 0.75;
                font-size: 0.95rem;
            }
        </style>
    </head>
    <body>
        <div class="shell">
            <h1 class="title">TikTok videos</h1>

            <div class="header-actions">
                <a href="{{ route('home') }}" class="btn btn-ghost">View site</a>
                <a href="{{ route('admin.tiktoks.create') }}" class="btn btn-primary">Add TikTok</a>
            </div>

            @if (session('status'))
                <div style="margin-bottom: 1rem; font-size: 0.9rem; color: #bbf7d0;">
                    {{ session('status') }}
                </div>
            @endif

            @if ($videos->isEmpty())
                <div class="empty">
                    <p>No TikTok videos yet. Add some to show them on the TikTok videos page.</p>
                </div>
            @else
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Status</th>
                            <th class="actions-cell">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($videos as $video)
                            <tr>
                                <td>{{ $video->title }}</td>
                                <td>
                                    @if ($video->is_active)
                                        <span class="status-pill status-pill--active">Active</span>
                                    @else
                                        <span class="status-pill status-pill--inactive">Hidden</span>
                                    @endif
                                </td>
                                <td class="actions-cell">
                                    <form method="POST" action="{{ route('admin.tiktoks.destroy', $video) }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this TikTok video?')">
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

