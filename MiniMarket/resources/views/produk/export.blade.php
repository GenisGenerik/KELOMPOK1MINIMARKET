<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Export</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <h1>Produk Export</h1>
    <table>
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Cabang</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produks as $produk)
                <tr>
                    <td>{{ $produk->produk->nama }}</td>
                    <td>{{ $produk->jumlah }}</td>
                    <td>{{ $produk->cabang->nama }}</td>
                    <td>{{ $produk->created_at->toDateString() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
