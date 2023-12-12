<section class="container mt-5">
    <h1 class="mb-4">Data Galery</h1>
    <?php if($this->session->flashdata("warning")): ?>
    <div class="alert alert-warning"><?= $this->session->flashdata("warning") ?></div>
    <?php endif ?>
    <?php if($this->session->flashdata("success")): ?>
    <div class="alert alert-success"><?= $this->session->flashdata("success") ?></div>
    <?php endif ?>
    <div class="row mb-3">
        <div class="col-sm-12 col-md mb-3">
            <form class="input-group" action="<?= current_url() ?>" method="get">
                <select name="category" id="category" class="form-select">
                    <option value="">Semua Kategori</option>
                    <?php foreach($categories as $category): ?>
                    <option value="<?= $category['category_id'] ?>" <?= $category['category_id'] == $this->input->get('category') ? 'selected' : '' ?>><?= $category['category_title'] ?></option>
                    <?php endforeach ?>
                </select>
                <input type="text" name="search" id="search" class="form-control" placeholder="Pencarian..." value="<?= $this->input->get('search') ?>">
                <button type="submit" class="btn btn-outline-danger">
                    <i class="bi bi-search"></i>
                    Cari
                </button>
            </form>
        </div>
        <div class="col-sm-12 col-md-auto mb-3">
            <a href="<?= base_url('admin/galery_editor') ?>" class="btn btn-danger w-100">
                <i class="bi bi-plus"></i>
                <span>Tambah Galery</span>
            </a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered" style="min-width: 800px;">
            <thead>
                <th class="text-center" width="60px">#</th>
                <th class="text-center">Galery</th>
                <th class="text-center">Stok</th>
                <th class="text-center" width="100px"><i class="bi bi-gear"></i></th>
            </thead>
            <tbody>
                <?php if($galerys): foreach($galerys as $i => $galery): ?>
                <tr>
                    <td class="text-center align-middle"><?= $i+$order+1 ?></td>
                    <td class="text-left align-middle d-flex">
                        <div>
                            <img src="<?= $galery['galery_image'] ?>" width="60px" height="60px" style="object-fit:cover;">
                        </div>
                        <div class="ms-2">
                            <div><?= $galery['galery_title'] ?></div>
                            <div class="small text-muted"><i class="bi bi-tag"></i> <?= $galery['category_title'] ?></div>
                            <div class="small text-muted"><i class="bi bi-wallet2"></i> Rp<?= number_format($galery['galery_price'],0) ?></div>
                        </div>
                    </td>
                    <td class="text-center align-middle">
                        <div><?= $galery['galery_stok'] ?></div>
                    </td>
                    <td class="text-end align-middle">
                        <a href="<?= base_url('admin/galery_editor/'.$galery['galery_slug']) ?>" class="btn btn-sm btn-outline-danger"><i class="bi bi-pen"></i></a>
                        <a href="<?= base_url('admin/galery_delete/'.$galery['galery_slug']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus galery <?= $galery['galery_title'] ?>')"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr>
                    <td colspan="4" class="text-center">Galery Kosong</td>
                </tr>
                
                <?php endif ?>
            </tbody>
        </table>
    </div>
    <div class="text-right">
        <?= $this->pagination->create_links(); ?>
    </div>
</section>