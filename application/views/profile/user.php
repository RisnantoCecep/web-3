<div class="section-bg">
    <div class="container mt-5 pt-5 pb-5">

        <div class="row mt-5 d-flex justify-content-center">
            <div class="col-12 text-center">
                <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <img src="<?= $profile["user_image"]?>" width="100px" height="100px" class="rounded-circle" style="object-fit: cover;">
                    <div class="small">Ganti Foto</div>
                </a>
                <h2 class="mt-2"> <?= $profile["user_name"]?></h2>
                <a href="<?= base_url('home/logout')?>" class="btn btn-danger mt-3"><i class="bi bi-box-arrow-left"></i> Logout</a>
            </div>
        </div>
    </div>
</div>
    
<div class="container pt-0 mb-5">
    <ul class="nav nav-tabs mt-5" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Detail Akun</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Riwayat Order</button>
        </li>
    </ul>
    <div class="tab-content mt-3" id="myTabContent">
        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <form action="<?=base_url('profile/edit')?>" method="post">
                <div>
                    <label class="mb-2 fw-bold">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" value="<?= $profile['user_name']?>">
                </div>
                <div class="mt-3">
                    <label class="mb-2 fw-bold">Tanggal Lahir</label>
                    <input type="date" name="birthday" class="form-control" value="<?= $profile['user_birthday']?>">
                </div>
                <div class="mt-3">
                    <label class="mb-2 fw-bold">Jenis Kelamin</label>
                    <select name="gender" class="form-select">
                        <option value="">-- pilih salah satu --</option>

                        <!-- tanda tanya dan titik dua penulisan singkat pengkondisian if -->
                        <option value="Laki-laki" <?= $profile['user_gender']=='Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                        <option value="Perempuan" <?= $profile['user_gender']=='Perempuan' ? 'selected': '' ?>>Perempuan</option>
                    </select>
                </div>

                <div class="mt-3">
                    <label class="mb-2 fw-bold">E-mail</label>
                    <input type="text" name="mail" class="form-control" value="<?= $profile['user_email']?>">
                </div>
                <div class="mt-3">
                    <label class="mb-2 fw-bold">No Hanphone</label>
                    <input type="text" name="hp" class="form-control" value="<?= $profile['user_phone']?>">
                </div>
                <div>
                    <button class="btn btn-danger mt-3 w-100" type="submit">Simpan</button>
                </div>
            </form>
        </div>
        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
            <div>
                <?php foreach($histories as $order): ?>
                <a href="<?= base_url('profile/orders/'.$order['transaction_id']) ?>">
                    <div class="border p-3 rounded mb-2">
                        <div class="small text-muted"><?= date("d F Y, H:i", strtotime($order['transaction_created'])) ?> WIB</div>
                        <div class="text-dark">Order <?= $order['transaction_code'] ?></div>
                        <div class="text-dark small">
                            <span><?= rupiah($order['transaction_total']+$order['transaction_ship']) ?></span>
                            <span class="ms-3 text-<?= $order['transaction_status']=='Selesai' ? 'success' : 'primary' ?>">
                                <i class="bi bi-<?= $order['transaction_status']=='Selesai' ? 'check' : 'info' ?>-circle"></i>
                                <?= $order['transaction_status'] ?>
                            </span>
                        </div>
                    </div>
                </a>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" method="post" action="<?= base_url('profile/imageSave') ?>" enctype="multipart/form-data">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ganti Foto Profile</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label for="image" class="form-label">Upload gambar</label>
                <input type="file" name="image" id="image" class="form-control" required>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger">Upload gambar</button>
            </div>
        </form>
    </div>
</div>