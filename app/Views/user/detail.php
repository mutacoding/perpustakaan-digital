<?= $this->extend('layout/master_user') ?>

<?= $this->section('content') ?>
<style>
  .swiper {
    width: 100%;
    height: 100%;
  }

  .swiper-slide {
    text-align: justify;
    font-size: 18px;
    background: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
  }
</style>

<div class="container-fluid">
  <!-- Start: Detail book -->
  <div class="my-3">
    <div class="row no-gutters">
      <div class="col-md-2 col-sm-2">
        <img src="/gambar/<?= $buku['cover_buku']; ?>" style="width: 200px;">
        <div class="py-2">
          <button type="submit" class="btn btn-success" onclick="Javasript:View('<?= $buku['id_buku']; ?>');">Lanjut Membaca</button>
        </div>
      </div>
      <div class="col-md-10 col-sm-10">
        <div class="card-body p-0">
          <div class="alert alert-dark ml-1" role="alert">
            <h3 class="card-text p-0 m-0"><?= $buku['judul']; ?></h3>
            <h5 class="card-text p-0 m-0" style="font-weight: 100;"><?= $buku['penulis']; ?></h5>
          </div>
          <div class="ml-3">
            <p class="card-text p-0 m-0">Penerbit : <?= $buku['penerbit']; ?></p>
            <div>
              <h6 class="card-text">Deskripsi</h6>
              <div class="border-bottom border-dark"></div>
              <p class="card-text" style="padding-top: 5px;">
                <?= $buku['deskripsi']; ?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End: Detail book -->

  <!-- Start: Another Book -->
  <div class="my-5">
    <h5>
      Daftar Buku Lainnya
    </h5>
    <hr>
    <div>
      <div class="swiper mySwiper">
        <div class="swiper-wrapper">
          <?php
          foreach ($tampil as $value) {
          ?>
            <div class="swiper-slide">
              <a href="<?= base_url() ?>user/title/<?= $value['id_buku']; ?>">
                <div class="card">
                  <img src="/gambar/<?= $value['cover_buku'] ?>" class="card-img-top" style="height: 250px; width: 200px">
                  <div class="card-body" style="padding: 0px 4px;">
                    <p class="card-title text-truncate" style="font-size: 13px; color: black; font-weight: 500; margin: 0px"><?= $value['judul']; ?></p>
                    <p class="card-title text-truncate" style="font-size: 13px; color: black; margin: 0px"><?= $value['penulis']; ?></p>
                  </div>
                </div>
              </a>
            </div>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
    <!-- End: Another Book -->
  </div>
  <?= $this->endSection() ?>

  <?= $this->section('script') ?>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  <script>
    var swiper = new Swiper(".mySwiper", {
      slidesPerView: 1,
      spaceBetween: 10,
      loop: true,
      breakpoints: {
        640: {
          slidesPerView: 2,
          spaceBetween: 20,
        },
        768: {
          slidesPerView: 4,
          spaceBetween: 40,
        },
        1024: {
          slidesPerView: 5,
          spaceBetween: 50,
        },
      },
    });
  </script>

  <script>
    function View(a) {
      const id = a;
      $.ajax({
        url: "<?= base_url() ?>buku/view",
        type: "post",
        data: {
          id: id
        },
        dataType: "json",
        success: function(respon) {
          if (respon.status) {
            window.location = respon.link;
          }
        }
      })
    }
  </script>
  <?= $this->endSection() ?>