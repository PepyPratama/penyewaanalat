<!-- Footer -->
<footer class="text-center text-lg-start bg-body-tertiary text-muted">
  <!-- Section: Social media -->
  <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">

    <!-- Right -->
    <div>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-twitter"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-google"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-instagram"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-linkedin"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-github"></i>
      </a>
    </div>
    <!-- Right -->
  </section>
  <!-- Section: Social media -->

  <!-- Section: Links  -->
  <section class="">
    <div class="container text-center text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <!-- Content -->
          <div class="col-12 col-lg-6 d-flex align-items-center">
                <img src="<?= base_url('assets/images/logo/logo-hitam.png'); ?>" class="img-fluid" alt="">
            </div>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <!-- <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4"> -->
          <!-- Links -->
          <!-- <h6 class="text-uppercase fw-bold mb-4">
            Products
          </h6>
          <p>
            <a href="#!" class="text-reset">Equipment</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Kamera</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Lensa</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Lighting</a>
          </p>
        </div> -->
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Menu
          </h6>
          <p>
            <a class="nav-link <?= ($this->uri->segment(1) == 'home') ? ' active' : '' ?>" href="<?= base_url('home'); ?>">Home</a>
          </p>
          <p>
            <a class="nav-link <?= ($this->uri->segment(1) == 'equipment') ? ' active' : '' ?>" href="<?= base_url('equipment'); ?>">Equipment</a>
          </p>
          <p>
            <a class="nav-link <?= ($this->uri->segment(1) == 'tentang_kami') ? ' active' : '' ?>" href="<?= base_url('tentang_kami'); ?>">Tentang Kami</a>
          </p>
          <p>
            <a class="nav-link <?= ($this->uri->segment(1) == 'kontak') ? ' active' : '' ?>" href="<?= base_url('kontak'); ?>">Kontak</a>
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
          <p><i class="fas fa-home me-3"></i> Jl. Puyuh Dalam II No.50</p>
          <p>
            <i class="fas fa-envelope me-3"></i>
            mezzorentkamera@gmail.com
          </p>
          <p><i class="fas fa-phone me-3"></i>+62 899-0278-778</p>
        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row -->
    </div>
  </section>
  <!-- Section: Links  -->

  <!-- Copyright -->
  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
    © 2021 Copyright:
    <a class="text-reset fw-bold">PT. MEZZO KREASI UTAMA</a>
  </div>
  <!-- Copyright -->
</footer>
<!-- Footer -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

<script src="<?= base_url('assets/js/script.js'); ?>"></script>

</body>

</html>