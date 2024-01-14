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
      <span>Data Program Studi</span>
      <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#TambahProdi">Tambah Prodi</button>
    </div>
  </div>
  <div class="card-body">
    <table id="tabel_prodi" class="table table-bordered" style="width: 100%;">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Program Studi</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
    </table>
  </div>
</div>

<!-- Start: Modal create -->
<div class="modal fade" id="TambahProdi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header btn-primary">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Program Studi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-white">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="tambah_prodi" method="post" action="Javascript:Create();">
          <?= csrf_field() ?>
          <div class="form-group">
            <label for="en_prodi">Program Studi :</label>
            <input type="text" class="form-control" id="en_prodi" name="en_prodi">
            <small class="text-danger error-prodi"></small>
          </div>
          <button type="submit" class="btn btn-primary" id="btn_create">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End: Modal create -->

<!-- Start: Modal update -->
<div class="modal fade" id="UbahProdi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header btn-primary">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Program Studi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-white">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="ubah_prodi" method="post" action="Javascript:Update();">
          <?= csrf_field() ?>
          <input type="hidden" name="en_id" id="en_id">
          <div class="form-group">
            <label for="en_prodi">Program Studi :</label>
            <input type="text" class="form-control" id="en_prodi" name="en_prodi">
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
    var table = $('#tabel_prodi').DataTable({
      "ajax": {
        "url": '<?= base_url("prodi/getAll") ?>',
        "type": "POST",
        "dataType": "json",
        async: "true",
      }
    });
  });

  function ModalTambah() {
    $('#TambahProdi').modal('show');
  }

  function ModalEdit() {
    $('#UbahProdi').modal('show');
  }

  function Create() {
    $.ajax({
      url: "<?= base_url(); ?>prodi/create",
      type: "post",
      dataType: "json",
      data: $('#tambah_prodi').serialize(),
      beforeSend: function() {
        $('#btn_create').attr('disabled');
        $("#btn_create").html('<i class="fa fa-spin fa-spinner"></i> Loading...');
      },
      success: function(respon) {
        if (respon.error) {
          if (respon.error.en_prodi) {
            $('#en_prodi').addClass('is-invalid');
            $('.error-prodi').html(respon.error.en_prodi);
          } else {
            $('#en_prodi').removeClass('is-invalid');
            $('.error-prodi').html('');
          }

        } else {
          if (respon.status) {
            $('#TambahProdi').modal('hide');
            Swal.fire({
              icon: 'success',
              text: respon.msg,
            }).then(function() {
              $('#tabel_prodi').DataTable().ajax.reload(null, false).draw(false);
              $('#tambah_prodi')[0].reset();
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
      url: "<?= base_url() ?>prodi/getOne",
      type: "post",
      data: {
        id: id
      },
      dataType: "json",
      success: function(respon) {
        ModalEdit();
        //insert data to form
        $("#ubah_prodi #en_id").val(respon.id_prodi);
        $("#ubah_prodi #en_prodi").val(respon.prodi);
      }
    });
  }

  function Update() {
    $.ajax({
      url: "<?= base_url() ?>prodi/update",
      type: "post",
      data: $("#ubah_prodi").serialize(),
      dataType: "json",
      beforeSend: function() {
        $('#btn_update').attr('disabled');
        $("#btn_update").html('<i class="fa fa-spin fa-spinner"></i> Loading...');
      },
      success: function(respon) {
        if (respon.status) {
          $('#UbahProdi').modal('hide');
          Swal.fire({
            icon: 'success',
            text: respon.msg,
          }).then(function() {
            $('#tabel_prodi').DataTable().ajax.reload(null, false).draw(false);
            $('#ubah_prodi')[0].reset();
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
      url: "<?= base_url() ?>prodi/delete",
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