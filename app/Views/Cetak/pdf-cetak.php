<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Stok Produk</title>
    <style>
        /* Base styles for readability and consistency */
        body {
            font-family: Arial, sans-serif;
            /* Modern font family */
            margin: 2rem;
            /* Add margin for better spacing */
        }

        table {
            width: 100%;
            /* Ensure full width on all screens */
            border-collapse: collapse;
            /* Combine cell borders */
            border: 1px solid #ddd;
            /* Light border for contrast */
            font-size: 16px;
            /* Adjust default font size */
        }

        th,
        td {
            padding: 1rem;
            /* Increase padding for better readability */
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            /* Light background for headers */
        }

        /* Optional styling for visual appeal */
        table {
            border-radius: 5px;
            /* Add subtle border radius for smoothness */
        }

        th,
        td {
            box-shadow: 0 0 2px rgba(0, 0, 0, 0.1);
            /* Subtle shadow for depth */
        }

        /* Optional media query for responsiveness (adjust as needed) */
        @media (max-width: 768px) {
            table {
                font-size: 14px;
                /* Adjust font size for smaller screens */
            }
        }
    </style>
</head>

<body>
    <h1 style="text-align: center; font-weight: bold; margin-bottom: 1.5rem;">LAPORAN STOK PRODUK</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Harga Jual</th>
                <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($listProduk as $baris) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $baris['nama_produk']; ?></td>
                    <td><?= $baris['harga_jual']; ?></td>
                    <td><?= $baris['stok']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>