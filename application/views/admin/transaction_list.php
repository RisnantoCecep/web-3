<section class="container mt-5 mb-5">
    <h1 class="mb-4"><?= $title ?></h1>
    <?php if($this->session->flashdata("warning")): ?>
    <div class="alert alert-warning"><?= $this->session->flashdata("warning") ?></div>
    <?php endif ?>
    <?php if($this->session->flashdata("success")): ?>
    <div class="alert alert-success"><?= $this->session->flashdata("success") ?></div>
    <?php endif ?>
    <div class="table-responsive">
        <table class="table table-bordered" style="min-width: 800px;">
            <thead>
                <th class="text-center" width="60px">#</th>
                <th class="text-center">Pembeli</th>
                <th class="text-center">Pembayaran</th>
                <th class="text-center">Status</th>
                <th class="text-center" width="100px"><i class="bi bi-gear"></i></th>
            </thead>
            <tbody>
                <?php if($orders): foreach($orders as $i => $galery): ?>
                <tr>
                    <td class="text-center align-middle"><?= $i+$order+1 ?></td>
                    <td class="text-start align-middle">
                        <div><?= $galery['user_name'] ?></div>
                        <div class="small text-muted"><i class="bi bi-envelope"></i> <?= $galery['user_email'] ?></div>
                        <div class="small text-muted"><i class="bi bi-phone"></i> <?= $galery['user_phone'] ?></div>
                    </td>
                    <td class="text-start align-middle">
                        <div><?= $galery['payment_bank'] ?></div>
                        <div><?= rupiah($galery['transaction_total']+$galery['transaction_ship']) ?></div>
                    </td>
                    <td class="text-center align-middle">
                        <div><?= $galery['transaction_status'] ?></div>
                    </td>
                    <td class="text-end align-middle">
                        <a href="<?= base_url('admin/transactions/'.$galery['transaction_id']) ?>" class="btn btn-sm btn-outline-danger">
                            <i class="bi bi-eye"></i> Lihat
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
    <div class="text-right">
        <?= $this->pagination->create_links(); ?>
    </div>
</section>