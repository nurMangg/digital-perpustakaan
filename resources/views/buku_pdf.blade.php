<!DOCTYPE html>
<html>
<head>
    <title>Daftar Buku</title>
    <style>
        /* Tambahkan style CSS sesuai kebutuhan */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Daftar Buku</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Buku</th>
                <th>Kategori</th>
                <th>Deskripsi</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bukus as $buku)
                <tr>
                    <td>{{ $buku->bukuId }}</td>
                    <td>{{ $buku->bukuNama }}</td>
                    <td>{{ $buku->kategori->kategoriNama ?? 'No Kategori' }}</td>
                    <td>{{ $buku->bukuDeskripsi }}</td>
                    <td>{{ $buku->bukuJumlah }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
