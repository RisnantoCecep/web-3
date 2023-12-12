<section class="container mt-5 mb-1" id="order-view" data-clear="<?= $this->input->get('order') ? '1' : '0' ?>">
    <h1 class="mb-3">Detail Transaksi</h1>
    <?php if($this->session->flashdata("warning")): ?>
    <div class="alert alert-warning"><?= $this->session->flashdata("warning") ?></div>
    <?php endif ?>
    <?php if($this->session->flashdata("success")): ?>
    <div class="alert alert-success"><?= $this->session->flashdata("success") ?></div>
    <?php endif ?>
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
            <input type="text" class="form-control" value="<?= rupiah($order['transaction_total']+$order['transaction_ship']) ?>" disabled>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Metode pembayaran</label>
            <div class="border p-3 bg-light rounded">
                <div class="fw-bold"><?= $order['payment_bank'] ?></div>
                <div><?= $order['payment_an'] ?></div>
                <div><?= $order['payment_rekening'] ?></div>
            </div>
        </div>
    </div>
    <a href="#" class="btn btn-lg btn-danger w-100" data-bs-toggle="modal" data-bs-target="#exampleModal">Ubah Status Proses</a>
</section>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" method="post" action="<?= current_url() ?>">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Proses transaksi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php if($order['transaction_status'] != 'Selesai'): ?>
                <label for="" class="form-label">Pilih Status</label>
                <select name="status" id="status" class="form-select" required>
                    <option value="">-- pilih salah satu --</option>
                    <option value="Menunggu pembayaran" <?= $order['transaction_status'] == 'Menunggu pembayaran' ? 'selected' : '' ?>>Menunggu pembayaran</option>
                    <option value="Pembayaran diterima" <?= $order['transaction_status'] == 'Pembayaran diterima' ? 'selected' : '' ?>>Pembayaran diterima</option>
                    <option value="Sedang dikirim" <?= $order['transaction_status'] == 'Sedang dikirim' ? 'selected' : '' ?>>Sedang dikirim</option>
                    <option value="Selesai" <?= $order['transaction_status'] == 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                    <option value="Dibatalkan" <?= $order['transaction_status'] == 'Dibatalkan' ? 'selected' : '' ?>>Batalkan pembelian</option>
                </select>
                <?php else: ?>
                <div class="alert alert-success">Pembelian ini sudah diterima oleh pelanggan</div>
                <?php endif ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger">Simpan</button>
            </div>
        </form>
    </div>
</div>