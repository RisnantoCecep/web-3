<section class="container mt-5 mb-5">
    <h1 class="mb-4">Lupa kata sandi</h1>
    <?php if(isset($msg)): ?>
    <div class="alert alert-warning"><?= $msg ?></div>
    <?php endif ?>
    <form action="<?= current_url() ?>" method="post">
        <div class="mb-3">
            <label for="email" class="form-label">Masukan alamat email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Alamat email" value="<?= @$email ?>" <?= isset($email) ? 'disabled' : 'required' ?>>
        </div>
        <?php if(isset($email)): ?>
        <div class="mb-3">
            <label for="otp" class="form-label">Masukan kode OTP</label>
            <input type="number" name="otp" id="otp" class="form-control" placeholder="Masukan OTP" required>
        </div>
        <?php endif ?>
        <button type="submit" class="btn btn-danger w-100">Lanjutkan</button>
    </form>
</section>