<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$title.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style type="text/css">
    .table-data{
        width: 100%;
        border-collapse: collapse;
    }
    .table-data tr th,
    .table-data tr td{
        border:1px solid black;
        font-size: 11pt;
        font-family:Verdana;
        padding: 15px;
        text-align: left;
        padding: 8px;
    }
    h3{
        font-family:Verdana;
        margin: 50px;
        text-align: center;
        padding: 10px;

    }

    /* .d-produk{
        margin-top: 40px;
        text-align: center;
        border: 1px solid;
        border-radius: 5px;
        margin-bottom: 10px;
        background-color: #186F65;
        color: #fff;
        padding: 8px;
        font-family:Verdana;
    }
     */
    </style>
</head>
<body>
    <h3 class="d-produk">Detail Transaksi</h3>
    <table class="table-data">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Transaksi</th>
                <th>Nama Pembeli</th>
                <th>ongkos Kirim</th>
                <th>Total Pembayaran</th>
                <th>Metode Pembayaran</th>
                <th>Order Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $no= 1; ?>

            <tr>
                <td scope="row"><?= $no++; ?></td>
                <td><?= $laporan['transaction_code']; ?></td>
                <td><?= $laporan['user_name']; ?></td>
                <td><?= rupiah($laporan['transaction_ship']); ?></td>
                <td><?= rupiah($laporan['transaction_total'] + $laporan['transaction_ship']); ?></td>
                <td><?= $laporan['payment_bank']; ?></td>
                <td><?= date('d F Y, H:i', strtotime($laporan['transaction_created'])); ?> WIB</td>
                <td><?= $laporan['transaction_status']; ?> </td>
            </tr>
        </tbody>
    </table>
  
    <h3 class="d-produk">Detail Produk</h3>
    <table class="table-data">
        
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Category</th>
                <th>Jumlah</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
        <?php $no= 1; foreach($laporan['details'] as $laporans) : ?>
            <tr>
                <td scope="row"><?= $no++; ?></td>
                <td><?= $laporans['galery_title']; ?></td>
                <td><?= $laporans['category_title']; ?></td>
                <td><?= $laporans['detail_qty']; ?></td>
                <td><?=  rupiah($laporans['detail_price']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>  
</body>
</html>