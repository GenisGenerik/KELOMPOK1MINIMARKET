<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Report</title>

    <!-- Tailwind CSS Styles (inline for PDF generation) -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            padding: 16px;
            background-color: #ffffff;
        }

        h1 {
            text-align: center;
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 24px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 24px;
        }

        th, td {
            padding: 8px 16px;
            text-align: left;
            border: 1px solid #e2e8f0; /* Tailwind gray-200 */
            font-size: 14px;
            color: #4a4a4a; /* Tailwind gray-700 */
        }

        th {
            font-weight: 500;
            background-color: #f1f5f9; /* Tailwind gray-100 */
        }

        tr:nth-child(even) {
            background-color: #f9fafb; /* Tailwind gray-50 */
        }

        .status {
            font-weight: 500;
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
        }

        .status-in {
            background-color: #4ade80; /* Green */
            color: white;
        }

        .status-out {
            background-color: #ef4444; /* Red */
            color: white;
        }
    </style>
</head>
<body>

    <h1>Log Report</h1>

    <table>
        <thead>
            <tr>
                <th>Produk</th>
                <th>Status</th>
                <th>Jumlah</th>
                <th>User</th>
                <th>Cabang</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>

            @foreach($logs as $log)
 
                <tr>
                    <td>{{ $log->produk->nama }}</td>
                    <td>
                        <span class="status {{ $log->status->value == 1 ? 'status-in' : 'status-out' }}">
                            {{ $log->status->label() }}
                        </span>
                    </td>
                    <td>{{ $log->jumlah }}</td>
                    <td>{{ $log->user->name }}</td>
                    <td>{{ $log->cabang->nama }}</td>
                    <td>{{ $log->created_at->toDateString() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
