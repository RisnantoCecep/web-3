<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?= isset($title) ? $title.' - ' : '' ?>ArtMark</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?= base_url('assets/img/logo-title.png')?>" rel="icon">
  <link href= " <?= base_url('assets/img/logo-title.png')?>" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url() ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= base_url() ?>/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="<?= base_url() ?>/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?= base_url() ?>/assets/css/main.css" rel="stylesheet">
  <link href="<?= base_url() ?>/assets/css/app.css" rel="stylesheet">


</head>

<body>
  
  <?php $this->load->view("templates/header") ?>
  
  <!-- CUMA TAMPIL DIHALAMAN DEPAN SAJA -->
    <?php if(!$this->uri->segment(1)): ?>
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero">
    <div class="container position-relative">
      <div class="row gy-5" data-aos="fade-in">
        <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center text-center text-lg-start">
          <h2>Welcome to <span>Art Mark</span></h2>
          <p>Nikmati hidup mu dengan selalu menikamti karya dari para seniman yang ada, mulai lah dari sini untuk menimatinya,
            art mark akan berusaha dalam menyajikan dan menjadi wadah bagi para seniman. enjoyyy</p>
          <div class="d-flex justify-content-center justify-content-lg-start">
            <a href="<?= base_url('register') ?>" class="btn-get-started">Get Started</a>
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2">
          <img src="assets/img/hero-img.svg" class="img-fluid" alt="" data-aos="zoom-out" data-aos-delay="100">
        </div>
      </div>
    </div>
  </section>
  <?php endif ?>
  <!-- End Hero Section -->
  <?php if(isset($page)): ?>
  <main id="main">
    <?php $this->load->view($page); ?>
  </main><!-- End #main -->
  <?php endif ?>

  <?php $this->load->view('templates/footer') ?>

  <div id="preloader"></div>
  <script src="<?= base_url() ?>/assets/js/jquery-3.7.0.min.js"></script>
  <!-- Vendor JS Files -->
  <script src="<?= base_url() ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url() ?>/assets/vendor/aos/aos.js"></script>
  <script src="<?= base_url() ?>/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="<?= base_url() ?>/assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="<?= base_url() ?>/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="<?= base_url() ?>/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?= base_url() ?>/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="<?= base_url() ?>/assets/js/main.js"></script>
  <script src="<?= base_url() ?>/assets/js/app.js"></script>


</body>

</html>