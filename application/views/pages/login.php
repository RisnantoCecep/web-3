<div class="container pt-5 pb-5 mt-5">

    <div class="row justify-content-center">

      <div class="col-xl-7 col-lg-12 col-md-9">

        <div class="card o-hidden border-5 shadow-lg my-5">
          <div class="card-body p-10">
            <div class="row">
              <div class="col-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h3 text-gray-900 mb-4">Login</h1>
                  </div>
                    <?php if($this->session->flashdata('warning')): ?>
                        <div class="alert alert-warning"><?= $this->session->flashdata('warning') ?></div>
                    <?php endif ?>
                  <form class="user" method="post" action="<?= base_url('login/acc') ?>">
                    <div class="form-group mb-3">
                      <label class="mb-1">Alamat email</label>
                      <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" required placeholder="Alamat email">
                    </div>
                    <div class="form-group">
                      <label class="mb-1">Kata sandi</label>
                      <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" required placeholder="Kata sandi">
                    </div>
                    <div class="custom-text small mt-2"> 
                        <p class="text-end">
                            <a href="<?= base_url('login/forget') ?>">Lupa kata sandi?</a>
                        </p>
                        <p class="custom-text small">
                            <span class="text-danger">*</span>Belum Punya Akun?|<a class="btn-book-a-table" href="<?= base_url('register') ?>">Daftar Disini</a>
                        </p>
                    </div>
                    <button type="submit" class="btn btn-danger btn-user btn-block w-100">Kirim</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

</div>
  

