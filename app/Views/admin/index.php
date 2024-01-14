<?= $this->extend("layout/master_app"); ?>

<?= $this->section("style"); ?>
<!-- DataTables -->
<link href="/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="row mt-4">
  <!-- Column -->
  <div class="col-md-6 col-lg-6 col-xl-4">
    <div class="card m-b-30">
      <div class="card-body">
        <div class="d-flex flex-row">
          <div class="col-3 align-self-center">
            <div class="round">
              <i class="fa fa-book"></i>
            </div>
          </div>
          <div class="col-6 align-self-center text-center">
            <div class="m-l-10">
              <h5 class="mt-0 round-inner"><?= $jmlbuku; ?></h5>
              <p class="mb-0 text-muted">Total Buku</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Column -->

  <!-- Column -->
  <div class="col-md-6 col-lg-6 col-xl-4">
    <div class="card m-b-30">
      <div class="card-body">
        <div class="d-flex flex-row">
          <div class="col-3 align-self-center">
            <div class="round">
              <i class="fa fa-clipboard"></i>
            </div>
          </div>
          <div class="col-6 text-center align-self-center">
            <div class="m-l-10 ">
              <h5 class="mt-0 round-inner"><?= $jmlkategori; ?></h5>
              <p class="mb-0 text-muted">Kategori</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Column -->

  <!-- Column -->
  <div class="col-md-6 col-lg-6 col-xl-4">
    <div class="card m-b-30">
      <div class="card-body">
        <div class="d-flex flex-row">
          <div class="col-3 align-self-center">
            <div class="round">
              <i class="fa fa-database"></i>
            </div>
          </div>
          <div class="col-6 text-center align-self-center">
            <div class="m-l-10 ">
              <h5 class="mt-0 round-inner"><?= $jmlpengguna; ?></h5>
              <p class="mb-0 text-muted">Pengguna</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Column -->
</div>
<div class="row">
  <div class="col-md-12 col-lg-12 col-xl-8">
    <div class="card">
      <div class="card-header">
        <span>Feedback pengguna</span>
      </div>
      <div class="card-body">
        <table id="tabel_pesan" class="table table-bordered" style="width: 100%;">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Email</th>
              <th scope="col">Pesan</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-12 col-lg-12 col-xl-4">
    <div class="card m-b-30">
      <div class="card-body">
        <h5 class="header-title mt-0 pb-3">E-Komik</h5>
        <div>
          <p class="text-center">Selamat datang di E-Komik, sebuah perpustakaan digital yang menyediakan berbagai buku, yang bertujuan untuk meningkatkan minat baca masyarakat indonesia</p>
        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script') ?>

<!-- Required datatable js -->
<script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>

<script>
  $(document).ready(function() {
    var table = $('#tabel_pesan').DataTable({
      "ajax": {
        "url": '<?= base_url("contact/getAll") ?>',
        "type": "POST",
        "dataType": "json",
        async: "true",
      }
    });
  });
</script>
<?= $this->endSection('script') ?>