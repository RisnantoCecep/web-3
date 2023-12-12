<section class="container mt-5 mb-5">
    <h1 class="mb-4"><?= $title ?></h1>
    <?php if($this->session->flashdata("warning")): ?>
    <div class="alert alert-warning"><?= $this->session->flashdata("warning") ?></div>
    <?php endif ?>
    <?php if($this->session->flashdata("success")): ?>
    <div class="alert alert-success"><?= $this->session->flashdata("success") ?></div>
    <?php endif ?>
    <div class="table-responsive mb-3">
        <table class="table table-bordered" style="min-width: 800px;">
            <thead>
                <th class="text-center" width="60px">#</th>
                <th class="text-center">Nama Kurir</th>
                <th class="text-center">Ongkor Kirim</th>
                <th class="text-center" width="190px"><i class="bi bi-gear"></i></th>
            </thead>
            <tbody>
                <?php if($data): foreach($data as $i => $val): ?>
                <tr>
                    <td class="text-center align-middle"><?= $i+1 ?></td>
                    <td class="text-start align-middle">
                        <div><?= $val['kurir_name'] ?></div>
                    </td>
                    <td class="text-start align-middle">
                        <div><?= rupiah($val['kurir_price']) ?></div>
                    </td>
                    <td class="text-end align-middle">
                        <a href="#" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#kurirModal" data-hash="<?= base64_encode(json_encode($val)) ?>">
                            <i class="bi bi-pen"></i> Edit
                        </a>
                        <a href="<?= base_url('admin/coorier_delete?id='.$val['kurir_id']) ?>" class="btn btn-sm btn-outline-dark" onclick="return confirm('Yakin ingin menghapus <?= $val['kurir_name'] ?>')">
                            <i class="bi bi-eye"></i> Hapus
                        </a>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr>
                    <td colspan="4" class="text-center">Belum ada data Galery</td>
                </tr>
                
                <?php endif ?>
            </tbody>
        </table>
    </div>
    <div class="text-end">
        <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#kurirModal"><i class="bi bi-plus"></i> Buat baru</a>
    </div>
</section>
<div class="modal fade" id="kurirModal" tabindex="-1" aria-labelledby="kurirModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" method="post" action="<?= base_url('admin/coorier_save') ?>">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="kurirModalLabel">Kurir</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" value="">
                <div class="mb-3">
                    <label for="" class="form-label">Nama Kurir</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Ongkos Kirim</label>
                    <input type="number" name="price" id="price" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger">Simpan</button>
            </div>
        </form>
    </div>
</div>