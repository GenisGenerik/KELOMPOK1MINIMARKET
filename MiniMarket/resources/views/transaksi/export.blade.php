<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Report</title>

    <!-- Tailwind CSS Styles -->
    <style>
        /* Tailwind CSS styles directly embedded */
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
    </style>
</head>
<body>

    <h1>Transaksi Report</h1>

    <table>
        <thead>
            <tr>
                <th>No. Transaksi</th>
                <th>Jumlah Transaksi</th>
                <th>Jumlah Barang</th>
                <th>Nama User</th>
                <th>Nama Cabang</th>
                <th>Tanggal Transaksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksis as $data)
                <tr>
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->detailtransaksi_count }}</td>
                    <td>{{ $data->detailtransaksi_sum_jumlah }}</td>
                    <td>{{ $data->user->name }}</td>
                    <td>{{ $data->cabang->nama }}</td>
                    <td>{{ $data->created_at->toDateString() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
