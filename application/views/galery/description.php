<div class="container" style="margin-top: 140px; margin-bottom: 120px;">
    
    <div class="row">
        <div class="col-sm-12 col-md-4 col-lg-3 mb-3">
            <img src="<?= $galery['galery_image'] ?>" alt="identity theft" width="100%">
        </div>
        <div class="col-sm-12 col-md-8 col-lg-9 mb-3">
            <h1 class="mb-0"><?= $galery['galery_title'] ?></h1>
            <div class="small mb-2 text-muted">
                <span class="me-2"><i class="bi bi-bag-fill"></i> Terjual <?= $galery['terjual'] ?></span>
            </div>
            <h4 class="mb-4 text-danger"><?= rupiah($galery['galery_price']) ?></h4>
            <div class="col-xs-12">
                <h3>Deskripsi</h3>
                <div class="text-justify"><?= $galery['galery_desc'] ?></div>
                <div class="mt-4 d-flex">
                    <div id="button-basket" data-id="<?= $galery['galery_id'] ?>">
                        <a href="#" class="btn btn-danger btn-md btn-add-basket" data-id="<?= $galery['galery_id'] ?>">
                            <i class="bi bi-cart-plus-fill"></i> Keranjang
                        </a>
                    </div>
                    <a href="<?= base_url('keranjang') ?>" class="btn btn-outline-danger btn-md ms-2">
                        <i class="bi bi-bag-fill"></i> Beli Sekarang
                    </a>
                </div>  
            </div>
        </div>
    </div>
</div>