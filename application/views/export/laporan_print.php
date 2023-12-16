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
    }
    h3{
    font-family:Verdana;
    margin: 25px;
    }

    .hr{
        margin-top: 40px;
    }
    </style>
</head>
<body>
    <h3><center>Detail Transaksi</center></h3><br>
    <table class="table-data" border="1">
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
    <div>
    <hr class="hr">
        <h3>Detail Produk</h3>
    <hr>
    </div>
    
    <table>
        
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Category</th>
                <th>Jumlah</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
        <?php $no= 1; foreach($laporan['details'] as $laporans) : ?>
            <tr>
                <td><?= $laporans['galery_title']; ?></td>
                <td><?= $laporans['category_title']; ?></td>
                <td><?= $laporans['detail_qty']; ?></td>
                <td><?=  rupiah($laporans['detail_price']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
        <script type="text/javascript">
            window.print();
        </script>   
</body>
</html>