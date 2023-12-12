<!-- ======= About Us Section ======= -->
<section id="about" class="about">
      <div class="container pt-3 pb-5 mt-3" data-aos="fade-up">

        <div class="section-header">
          <h2>About Us</h2>
          <img class="mb-4 rounded-3 border border-info-subtle shadow-lg" width="100%" height="200px"src="<?= base_url('assets/img/about-image.jpg')?>" alt="">
          <p class="text-start fw-bold pt-2 mt-2">Butuh penjelasan tentang kami? cari disini</p>
          <div class="accordion" id="accordionExample">
            <div class="accordion-item">
              <h3 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Artmark?
                </button>
              </h3>
              <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body small text-start">
                  Artmark. adalah toko senirupa berbasis online, tepatnya berbasis web <br>
                  Misi kami adalah ingin menjadih wadah bagi para seniman yang ingin, mengekspose dan menjual karyanya
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h3 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                   Dimana & Bagaimana menghubungi customer service kami?
                </button>
              </h3>
              <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body small text-start">
                  Perlu bantuan? Hubungi kami: <br>
                  <div class="small">
                    Wa: Kirim pesan melalui icon phone pada menu header di halaman <span class="fst-italic">Home</span> pada web kami.
                    E-mail: Artpeduli@artmark.com
                  </div>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h3 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  Dimana, aku bisa berinteraksi dengan paraseniman?
                </button>
              </h3>
              <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body small text-start">
                  kami ada di <a href="#">Instagram</a> <br>
                  atau melalui link zoom mingguan, untuk diskusi tentang seni rupa dan obrolan santai
                </div>
              </div>
            </div>
          </div>
          
        </div>
      </div>
    </section><!-- End About Us Section -->


    <section id="news" class="Karya">
      <div class="container" data-aos="fade-up">
            <div class="section-header">
                <h2>Karya Terbaru</h2>
            </div>
            <div class="row">
                  <?php foreach ($galerys as $galery): ?>
                  <div class="col-sm-12 col-md-3 mb-5">
                    <div class="card h-100">
                      <img src="<?= $galery['galery_image']?>" class="card-img-top galery-image" alt="...">
                      <div class="card-body d-flex flex-column">
                          <h5 class="card-title text-dark"><?=$galery['galery_title'] ?></h5>
                          <p class="card-text text-dark max-line-3 small"><?= substr($galery['galery_desc'], 0, 100) ?>...</p>
                          <div class="mt-auto">
                              <p class="text-danger">Rp<?= number_format($galery['galery_price'],0) ?></p>
                              <a href="<?= base_url('galery/desc/'.$galery['galery_slug']) ?>" class="btn btn-danger w-100">Check Out</a>
                          </div>
                        </div>
                    </div>
                  </div>
                  <?php endforeach; ?>
            </div>
        
      </div>
    </section>

           
    

    <!-- ======= Our Team Section ======= -->
    <section id="team" class="team">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Our Team</h2>
          <p>Nulla dolorum nulla nesciunt rerum facere sed ut inventore quam porro nihil id ratione ea sunt quis dolorem dolore earum</p>
        </div>

        <div class="row gy-4">

          <div class="col-xl-2 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
            <div class="member">
              <img src="assets/img/team/imong.jpg" class="img-fluid h-50 w-100" alt="">
              <h4>Cecep Risnanto</h4>
              <span>Content</span>
              <div class="social">
                <a href=""><i class="bi bi-twitter"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-xl-2 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
            <div class="member">
              <img src="assets/img/team/fatih.jpg" class="img-fluid h-50" alt="">
              <h4>Fatih</h4>
              <span>Marketing</span>
              <div class="social">
                <a href=""><i class="bi bi-twitter"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-xl-2 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
            <div class="member">
              <img src="assets/img/team/kusnadia.jpg" class="img-fluid h-50" alt="">
              <h4>Kusnadia</h4>
              <span>Staff Admin</span>
              <div class="social">
                <a href=""><i class="bi bi-twitter"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-xl-2 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="400">
            <div class="member">
              <img src="assets/img/team/maul.jpg" class="img-fluid h-50" alt="">
              <h4>M. Rezza Haqq</h4>
              <span>Accountant</span>
              <div class="social">
                <a href=""><i class="bi bi-twitter"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div><!-- End Team Member -->
          <div class="col-xl-2 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="400">
            <div class="member">
              <img src="assets/img/team/team-4.jpg" class="img-fluid" alt="">
              <h4>M.Ihsan</h4>
              <span>Maintenance</span>
              <div class="social">
                <a href=""><i class="bi bi-twitter"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div><!-- End Team Member -->
          <div class="col-xl-2 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="400">
            <div class="member">
              <img src="assets/img/team/team-4.jpg" class="img-fluid" alt="">
              <h4>M. Luthfi</h4>
              <span>sosial media content</span>
              <div class="social">
                <a href=""><i class="bi bi-twitter"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div><!-- End Team Member -->

        </div>

      </div>
    </section><!-- End Our Team Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Contact</h2>
          <p>Nulla dolorum nulla nesciunt rerum facere sed ut inventore quam porro nihil id ratione ea sunt quis dolorem dolore earum</p>
        </div>

        <div class="row gx-lg-0 gy-4 d-flex justify-content-center">

          <div class="col-lg-4">

            <div class="info-container d-flex flex-column align-items-center justify-content-center">
              <div class="info-item d-flex">
                <i class="bi bi-geo-alt flex-shrink-0"></i>
                <div>
                  <h4>Location:</h4>
                  <p>Kramat,98. Jakarta Pusat</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex">
                <i class="bi bi-envelope flex-shrink-0"></i>
                <div>
                  <h4>Email:</h4>
                  <p>artmark@artrup.com</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex">
                <i class="bi bi-phone flex-shrink-0"></i>
                <div>
                  <h4>Call:</h4>
                  <p>+62 87879234369</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex">
                <i class="bi bi-clock flex-shrink-0"></i>
                <div>
                  <h4>Open Hours:</h4>
                  <p>Mon-Sat: 09.00 - 18.00 WIB</p>
                </div>
              </div><!-- End Info Item -->
            </div>

          </div>

          <!-- <div class="col-lg-8">
            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="7" placeholder="Message" required></textarea>
              </div>
              <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div>
          End Contact Form -->

        </div>

      </div>
    </section><!-- End Contact Section -->