<section class="container mt-5 mb-5">
    <h1 class="mb-4"><?= $title ?></h1>
    <?php if(isset($msg)): ?>
    <div class="alert alert-warning"><?= $msg ?></div>
    <?php endif ?>
    <form action="<?= current_url() ?>" method="post">
        <div class="mb-3">
            <label for="password" class="form-label">Masukan kata sandi baru</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Masukan kata sandi baru" required>
        </div>
        <div class="mb-3">
            <label for="password-conf" class="form-label">Konfirmasi kata sandi baru</label>
            <input type="password" name="password-conf" id="password-conf" class="form-control" placeholder="Konfirmasi kata sandi baru" required>
        </div>
        <button type="submit" class="btn btn-danger w-100">Simpan kata sandi</button>
    </form>
</section>