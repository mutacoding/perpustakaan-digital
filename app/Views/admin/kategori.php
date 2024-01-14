<?= $this->extend("layout/master_app"); ?>

<?= $this->section("style"); ?>
<!-- DataTables -->
<link href="/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<?= $this->endSection(); ?>

<?= $this->section("content"); ?>
<div class="card mt-4">
  <div class="card-header">
    <div class="d-flex justify-content-between align-items-center">
      <span>Kategori Buku</span>
      <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#TambahKategori">Tambah Kategori</button>
    </div>
  </div>
  <div class="card-body">
    <table id="tabel_kategori" class="table table-bordered" style="width: 100%;">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Kategori Buku</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
    </table>
  </div>
</div>

<!-- Start: Modal create -->
<div class="modal fade" id="TambahKategori" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header btn-primary">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-white">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="tambah_kategori" method="post" action="Javascript:Create();">
          <?= csrf_field() ?>
          <div class="form-group">
            <label for="en_kategori">Kategori Buku :</label>
            <input type="text" class="form-control" id="en_kategori" name="en_kategori">
            <small class="text-danger error-kategori"></small>
          </div>
          <button type="submit" class="btn btn-primary" id="btn_create">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End: Modal create -->

<!-- Start: Modal update -->
<div class="modal fade" id="UbahKategori" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header btn-primary">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-white">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="ubah_kategori" method="post" action="Javascript:Update();">
          <?= csrf_field() ?>
          <input type="hidden" name="en_id" id="en_id">
          <div class="form-group">
            <label for="en_kategori">Kategori Buku :</label>
            <input type="text" class="form-control" id="en_kategori" name="en_kategori">
          </div>
          <button type="submit" class="btn btn-primary" id="btn_update">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End: Modal update -->

<?= $this->endSection(); ?>

<?= $this->section("script") ?>
<!-- Required datatable js -->
<script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    var table = $('#tabel_kategori').DataTable({
      "ajax": {
        "url": '<?= base_url("kategori/getAll") ?>',
        "type": "POST",
        "dataType": "json",
        async: "true",
      }
    });
  });

  function ModalTambah() {
    $('#TambahKategori').modal('show');
  }

  function ModalEdit() {
    $('#UbahKategori').modal('show');
  }

  function Create() {
    $.ajax({
      url: "<?= base_url(); ?>kategori/create",
      type: "post",
      dataType: "json",
      data: $('#tambah_kategori').serialize(),
      beforeSend: function() {
        $('#btn_create').attr('disabled');
        $("#btn_create").html('<i class="fa fa-spin fa-spinner"></i> Loading...');
      },
      success: function(respon) {
        if (respon.error) {
          if (respon.error.en_kategori) {
            $('#en_kategori').addClass('is-invalid');
            $('.error-kategori').html(respon.error.en_kategori);
          } else {
            $('#en_kategori').removeClass('is-invalid');
            $('.error-kategori').html('');
          }

        } else {
          if (respon.status) {
            $('#TambahKategori').modal('hide');
            Swal.fire({
              icon: 'success',
              text: respon.msg,
            }).then(function() {
              $('#tabel_kategori').DataTable().ajax.reload(null, false).draw(false);
              $('#tambah_kategori')[0].reset();
            })
          } else {
            Swal.fire({
              icon: 'warning',
              text: respon.msg,
            });
          }
        }
      },
      complete: function() {
        $('#btn_create').removeAttr('disable');
        $('#btn_create').html('Simpan');
      }
    });
  }

  function Edit(id) {
    $.ajax({
      url: "<?= base_url() ?>kategori/getOne",
      type: "post",
      data: {
        id: id
      },
      dataType: "json",
      success: function(respon) {
        ModalEdit();
        //insert data to form
        $("#ubah_kategori #en_id").val(respon.id_kategori);
        $("#ubah_kategori #en_kategori").val(respon.kategori);
      }
    });
  }

  function Update() {
    $.ajax({
      url: "<?= base_url() ?>kategori/update",
      type: "post",
      data: $("#ubah_kategori").serialize(),
      dataType: "json",
      beforeSend: function() {
        $('#btn_update').attr('disabled');
        $("#btn_update").html('<i class="fa fa-spin fa-spinner"></i> Loading...');
      },
      success: function(respon) {
        if (respon.status) {
          $('#UbahKategori').modal('hide');
          Swal.fire({
            icon: 'success',
            text: respon.msg,
          }).then(function() {
            $('#tabel_kategori').DataTable().ajax.reload(null, false).draw(false);
            $('#ubah_kategori')[0].reset();
          })
        } else if (respon.status) {
          Swal.fire({
            icon: 'warning',
            text: respon.msg,
          });
        }
      },
      complete: function() {
        $('#btn_update').removeAttr('disable');
        $('#btn_update').html('Simpan');
      }
    });
  }

  function Delete(id) {
    $.ajax({
      url: "<?= base_url() ?>kategori/delete",
      type: "post",
      data: {
        id: id
      },
      dataType: "json",
      success: function(respon) {
        if (respon.status) {
          Swal.fire({
            text: respon.msg,
            icon: "success"
          }).then(function() {
            $('#tabel_prodi').DataTable().ajax.reload(null, false).draw(false);
          })
        } else {
          Swal.fire({
            icon: 'warning',
            text: respon.msg,
          });
        }
      }
    });
  }
</script>
<?= $this->endSection(); ?>