<div class="container" style="margin-top:140px; margin-bottom:140px;">

    <h1 class="fw-bold mb-5">Keranjang</h1>
    
    <?php if($baskets): ?>
    <div class="row">
        <div class="col-sm-12 col-md-8 basket-checkout">
            <?php foreach($baskets as $galery): ?>
            <div class="border-bottom pb-3 pt-3 basket-checkout-book-<?= $galery['galery_id'] ?>" id="<?= $galery['galery_id'] ?>" data-price="<?= $galery['galery_price'] ?>" data-qty="1">
                <div class="row">
                    <div class="col-auto">
                        <img class="rounded-2" src="<?= $galery['galery_image'] ?>" alt="" style="width: 70px; height: 70px; object-fit: cover;">
                    </div>
                    <div class="col">
                        <h5><?= $galery['galery_title'] ?></h5>
                        <h6 class="text-danger"><?= rupiah($galery['galery_price']) ?></h6>
                    </div>
                </div>
                <div class="text-end">
                    <a href="#" class="basket-checkout-del" data-id="<?= $galery['galery_id'] ?>">
                        <i class="bi bi-trash-fill text-muted fs-5 me-5"></i>
                    </a>
                    <a href="#" class="basket-checkout-min" data-id="<?= $galery['galery_id'] ?>">
                        <i class="bi bi-dash-circle text-muted fs-5 me-3"></i>
                    </a>
                    <span class="basket-checkout-count-<?= $galery['galery_id'] ?>">0</span>
                    <a href="#" class="basket-checkout-plus" data-id="<?= $galery['galery_id'] ?>">
                        <i class="bi bi-plus-circle text-success fs-5 ms-3"></i>
                    </a>
                </div>
            </div>
            <?php endforeach ?>
        </div>

        <div class="col-sm-12 col-md-4">
            <form class="card border-shadow mb-3" method="post" action="<?= base_url('keranjang/checkout') ?>">
                <div class="card-body">
                    <h5 class="card-title mb-3">Preorder</h5>
                    <div class="mb-3">
                        <label class="form-label">Jasa pengiriman</label>
                        <select name="kurir_id" id="kurir_id" class="form-control" required>
                            <option value="">-- pilih salah satu --</option>
                            <?php foreach($kurir as $kur): ?>
                            <option value="<?= $kur['kurir_id'] ?>" data-price="<?= $kur['kurir_price'] ?>"><?= $kur['kurir_name'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Metode pembayaran</label>
                        <select name="payment_id" id="payment_id" class="form-control" required>
                            <option value="">-- pilih salah satu --</option>
                            <?php foreach($payments as $pay): ?>
                            <option value="<?= $pay['payment_id'] ?>"><?= $pay['payment_bank'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat pengiriman</label>
                        <textarea name="address" id="address" class="form-control" required></textarea>
                    </div>
                </div>
                <div class="card-footer bg-white pb-3">
                    <div class="d-flex justify-content-between">
                        <div class="">Total harga</div>
                        <div class="basket-checkout-price">...</div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="">Ongkos kirim</div>
                        <div class="basket-checkout-ongkir">...</div>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <div class="fw-bold">Total bayar</div>
                        <div class="fw-bold basket-checkout-price-total">...</div>
                    </div>
                    <button class="btn btn-danger w-100" type="submit">Lanjutkan Pembelian</button>
                </div>
            </form>
        </div>
    </div>
    <?php else: ?>
    <div class="alert alert-secondary pt-5 pb-5">
        <h1 class="text-center"><i class="bi bi-palette"></i></h1>
        <div class="text-center">Belum ada karya apapun di keranjang, silahkan pilih karya yang kamu suka di Art Mark</div>
    </div>
    <?php endif; ?>
</div>