<section class="container mt-5 mb-1" id="order-view" data-clear="<?= $this->input->get('order') ? '1' : '0' ?>">
    <h1 class="mb-3">Detail Transaksi</h1>
        <div clas="row ">
            <a href="<?= base_url(''); ?>" class="btn btn-primary mb-3 me-1"><i class="bi bi-printer">Print</i></a>
            <a href="<?= base_url(''); ?>" class="btn btn-warning mb-3"><i class="bi bi-file-earmark-pdf"></i>Download Pdf</a>
            <a href="<?= base_url(''); ?>" class="btn btn-success mb-3 ms-1"><i class="bi bi-file-earmark-excel"></i>Export ke Excel</a>
        </div>
        <div class="text-end">
            <a class="btn btn-danger p-2 mb-3" href="https://wa.me/6287879234369"><i class="bi bi-whatsapp" style="font-size: 15px;"> konfirmasi pembayaran</i></a>
        </div>
    <div class="border p-4 mb-5">
        <div class="mb-3">
            <label for="" class="form-label">Kode transaksi</label>
            <input type="text" class="form-control" value="<?= $order['transaction_code'] ?>" disabled>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Status</label>
            <input type="text" class="form-control" value="<?= $order['transaction_status'] ?>" disabled>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Pengiriman</label>
            <div class="border p-3 bg-light rounded">
                <div class="fw-bold"><?= $order['kurir_name'] ?></div>
                <div><?= $order['transaction_address'] ?></div>
            </div>
        </div>
        <div class="mb-3">  
            <label for="" class="form-label">Waktu order</label>
            <input type="text" class="form-control" value="<?= date('d F Y, H:i', strtotime($order['transaction_created'])) ?> WIB" disabled>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Galery yang dibeli</label>
            <?php foreach($order['details'] as $detail): ?>
            <div class="mb-2 border p-3 d-flex">
                <div>
                    <img src="<?= $detail['galery_image'] ?>" style="height: 50px; width: 50px; object-fit: cover;">
                </div>
                <div class="flex-fill ms-3">
                    <div><?= $detail['galery_title'] ?></div>
                    <div class="small text-muted">
                        <span><?= $detail['detail_qty'] ?></span>
                        <span>x</span>
                        <span><?= rupiah($detail['detail_price']) ?></span>
                    </div>
                </div>
            </div>
            <?php endforeach ?>
        </div>
    </div>
    <h1>Detail Pembayaran</h1>
    <div class="border p-4 mb-5">
        <div class="mb-3">
            <label for="" class="form-label">Total order</label>
            <input type="text" class="form-control" value="<?= rupiah($order['transaction_total']) ?>" disabled>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Ongkos kirim</label>
            <input type="text" class="form-control" value="<?= rupiah($order['transaction_ship']) ?>" disabled>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Total bayar</label>
            <input type="text" class="form-control" value="<?= rupiah($order['transaction_total']+ $order['transaction_ship']) ?>" disabled>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Metode pembayaran</label>
            <div class="border p-3 bg-light rounded">
                <div class="fw-bold"><?= $order['payment_bank'] ?></div>
                <div><?= $order['payment_an'] ?></div>
                <div><?= $order['payment_rekening'] ?></div>
            </div>
        </div>
        <span style="color: red; font-style: italic;">*Selalu konfirmasi pembayaran, dengan kirim bukti pembayaran ke no Whatsapps diatas</span> <br>
        <span>Terimakasih!</span>
    </div>
</section>