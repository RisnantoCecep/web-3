<!-- ======= Header ======= -->
<section id="topbar" class="topbar d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">artmark@artrup.com</a></i>
        <i class="bi bi-phone d-flex align-items-center ms-4"><span>+62 87879234369</span></i>
      </div>
      <div class="social-links d-none d-md-flex align-items-center">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>
    </div>
</section><!-- End Top Bar -->
<?php 
  $categories = $this->galery->categories();
?>

<header id="header" class="header d-flex align-items-center shadow-lg">
    <div class="container d-flex align-items-center justify-content-between">
        <a href="<?= base_url() ?>" class="logo d-flex align-items-center me-auto me-lg-0">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <img src="<?= base_url('assets/img/logo.png') ?>" alt="">
           <!-- <img src="assets/img/Artmarket.png" class="h-100" style="width: 200px;"> -->
        </a>
        <nav id="navbar" class="navbar mx-auto">
            <ul>
              <?php if($this->session->userdata('user_flag')!=='admin'): ?>
                <li><a href="<?= base_url()?>">Home</a></li>
                <li><a href="<?= base_url("#about") ?>">About</a></li>
                <li class="dropdown"><a href="#"><span>Galery</span><i class="bi bi-chevron-down dropdown-indicator"></i></a>
                  <ul>
                      <?php if($categories): foreach($categories as $category): ?>
                        <li><a href="<?= base_url('galery/category/'.$category['category_slug'])?>"><?= $category['category_title'] ?></a></li>
                      <?php endforeach; endif; ?>
                  </ul>
                </li>
                <li><a href="<?= base_url("#news") ?>">News ART</a></li>
                <li><a href="<?= base_url("#team") ?>">Team</a></li>
                <li><a href="<?= base_url("#contact") ?>">Contact</a></li>
              <?php endif ?>

              <?php if($this->session->userdata('user_flag') == 'admin'): ?>
                <li class="dropdown">
                    <a href="#"><span>Admin Panel</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                    <ul>
                        <li><a href="<?= base_url('admin') ?>">Dashboard</a></li>
                        <li><a href="<?= base_url('admin/galerys') ?>">Galery</a></li>
                        <li><a href="<?= base_url('admin/transactions') ?>">Data Transaksi</a></li>
                        <li><a href="<?= base_url('admin/payments') ?>">Data Pembayaran</a></li>
                        <li><a href="<?= base_url('admin/cooriers') ?>">Data Kurir</a></li>
                    </ul>
                </li>
                <?php endif ?>
            </ul>
              
            <div class="ms-5 d-flex">
              <?php if($this->session->userdata('user_id')): ?>
              <?php if($this->session->userdata('user_flag') !== 'admin'): ?>
                <a href="<?= base_url('keranjang') ?>" class="btn btn-outline-secondary btn-lg position-relative ms-3">
                <i class="bi bi-cart3"></i>
                <span class="position-absolute top-0 start-100 translate-middle-y badge rounded-pill bg-danger">
                    <span id="my-basket-count"><?= countBasket() ?></span>
                    <span class="visually-hidden">Belum Di Check Out</span>
                </span>
              </a>
              <?php endif ?>
              
                <a class="btn btn-outline-secondary ms-4" href="<?= base_url('profile') ?>">
                    <i class="bi bi-person-circle"></i>
                    <span class="d-none d-md-inline">Profile</span>
                </a>
                <?php else: ?>
                  <a class="btn btn-outline-warning ms-5" href="<?=base_url('login')?> ">Login</a>
                <?php endif ?>
                </div>
            

            
                
        </nav><!-- .navbar -->
          <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
          <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
    </div>
</header><!-- End Header -->
<!-- End Header -->