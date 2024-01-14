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
      <span>Daftar Buku</span>
      <button type="button" class="btn btn-primary waves-effect waves-light" onclick="ModalTambah();">Tambah Buku</button>
    </div>
  </div>
  <div class="card-body">
    <table id="tabel_buku" class="table table-bordered" style="width: 100%;">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Judul Buku</th>
          <th scope="col">Kategori Buku</th>
          <th scope="col">Penulis Buku</th>
          <th scope="col">Penerbit Buku</th>
          <th scope="col">Tahun Terbit</th>
          <th scope="col">Cover Buku</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>
</div>

<!-- Start: Modal create -->
<div class="modal fade" id="TambahBuku" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header btn-primary">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Buku</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-white">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="tambah_buku" method="post" action="Javascript:Create();">
          <?= csrf_field(); ?>
          <div class="form-group">
            <label for="en_judul">Judul Buku :</label>
            <input type="text" class="form-control" id="en_judul" name="en_judul">
            <small class="text-danger error-judul"></small>
          </div>
          <div class="row">
            <div class="col-xl-4">
              <div class="form-group">
                <label for="en_kat">Kategori Buku :</label>
                <select class="form-control" id="en_kat" name="en_kat">
                  <option>Pilih</option>
                  <?php
                  foreach ($kategori as $value) {
                  ?>
                    <option value="<?= $value['id_kategori']; ?>"><?= $value['kategori']; ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-xl-4">
              <div class="form-group">
                <label for="en_penulis">Penulis Buku :</label>
                <input type="text" class="form-control" name="en_penulis" id="en_penulis">
                <small class="text-danger error-penulis"></small>
              </div>
            </div>
            <div class="col-xl-4">
              <div class="form-group">
                <label for="en_penerbit">Penerbit Buku :</label>
                <input type="text" class="form-control" name="en_penerbit" id="en_penerbit">
                <small class="text-danger error-penerbit"></small>
              </div>
            </div>
            <div class="col-xl-4">
              <div class="form-group">
                <label for="en_terbit">Terbit Buku:</label>
                <input type="date" class="form-control" id="en_terbit" name="en_terbit">
              </div>
            </div>
            <div class="col-xl-4">
              <div class="form-group">
                <label for="en_cover">Cover Buku :</label>
                <div class="custom-file mb-3">
                  <input type="file" class="form-control" id="en_cover" name="en_cover">
                  <small class="text-danger error-cover"></small>
                </div>
              </div>
            </div>
            <div class="col-xl-4">
              <div class="custom-file">
                <label for="en_doc">File Buku :</label>
                <div class="custom-file mb-3">
                  <input type="file" class="form-control" id="en_doc" name="en_doc">
                  <small class="text-danger error-doc"></small>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="en_deskripsi">Deskripsi Buku :</label>
            <textarea class="form-control" id="en_deskripsi" name="en_deskripsi" rows="3"></textarea>
            <small class="text-danger error-deskripsi"></small>
          </div>
          <button type="submit" class="btn btn-primary" id="btn-create">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End: Modal create -->

<!-- Start: Modal update -->
<div class="modal fade" id="UbahBuku" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header btn-primary">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Buku</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-white">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="ubah_buku" method="post" action="Javascript:Update();">
          <?= csrf_field(); ?>
          <input type="hidden" name="en_id" id="en_id">
          <input type="hidden" name="en_cover" id="en_cover">
          <input type="hidden" name="en_doc" id="en_doc">
          <div class="form-group">
            <label for="en_judul">Judul Buku :</label>
            <input type="text" class="form-control" id="en_judul" name="en_judul">
            <small class="text-danger error-judul"></small>
          </div>
          <div class="row">
            <div class="col-xl-4">
              <div class="form-group">
                <label for="en_kat">Kategori Buku :</label>
                <select class="form-control" id="en_kat" name="en_kat">
                  <option>Pilih</option>
                  <?php
                  foreach ($kategori as $value) {
                  ?>
                    <option value="<?= $value['id_kategori']; ?>"><?= $value['kategori']; ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-xl-4">
              <div class="form-group">
                <label for="en_penulis">Penulis Buku :</label>
                <input type="text" class="form-control" name="en_penulis" id="en_penulis">
              </div>
            </div>
            <div class="col-xl-4">
              <div class="form-group">
                <label for="en_penerbit">Penerbit Buku :</label>
                <input type="text" class="form-control" name="en_penerbit" id="en_penerbit">
              </div>
            </div>
            <div class="col-xl-4">
              <div class="form-group">
                <label for="en_terbit">Terbit Buku:</label>
                <input type="date" class="form-control" id="en_terbit" name="en_terbit">
              </div>
            </div>
            <div class="col-xl-4">
              <div class="form-group">
                <label for="new_cover">Cover Buku :</label>
                <div class="custom-file mb-3">
                  <input type="file" class="form-control" id="new_cover" name="new_cover">
                  <small class="text-danger error-cover"></small>
                </div>
              </div>
            </div>
            <div class="col-xl-4">
              <div class="custom-file">
                <label for="new_doc">File Buku :</label>
                <div class="custom-file mb-3">
                  <input type="file" class="form-control" id="new_doc" name="new_doc">
                  <small class="text-danger error-doc"></small>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="en_deskripsi">Deskripsi Buku :</label>
            <textarea class="form-control" id="en_deskripsi" name="en_deskripsi" rows="3"></textarea>
            <small class="text-danger error-deskripsi"></small>
          </div>
          <button type="submit" class="btn btn-primary" id="btn_update">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End: Modal Update -->

<?= $this->endSection(); ?>

<?= $this->section("script") ?>
<!-- Required datatable js -->
<script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    var table = $('#tabel_buku').DataTable({
      "ajax": {
        "url": '<?= base_url("buku/getAll") ?>',
        "type": "POST",
        "dataType": "json",
        async: "true"
      }
    });
  });

  function ModalTambah() {
    $('#TambahBuku').modal('show');
  }

  function ModalEdit() {
    $('#UbahBuku').modal('show');
  }

  function Create() {
    var form = $('#tambah_buku');
    var formData = new FormData(form[0]);
    $.ajax({
      url: "<?= base_url(); ?>buku/create",
      type: "post",
      dataType: "json",
      data: formData,
      enctype: 'multipart/form-data',
      cache: false,
      contentType: false, // Let jQuery handle content type
      processData: false, // Don't process data, let jQuery handle it
      beforeSend: function() {
        $('#btn_create').attr('disabled');
        $("#btn_create").html('<i class="fa fa-spin fa-spinner"></i> Loading...');
      },
      success: function(respon) {
        if (respon.error) {
          if (respon.error.en_judul) {
            $('#en_judul').addClass('is-invalid');
            $('.error-judul').html(respon.error.en_judul);
          } else {
            $('#en_judul').removeClass('is-invalid');
            $('.error-judul').html('');
          }

          if (respon.error.en_penulis) {
            $('#en_penulis').addClass('is-invalid');
            $('.error-penulis').html(respon.error.en_penulis);
          } else {
            $('#en_penulis').removeClass('is-invalid');
            $('.error-penulis').html('');
          }

          if (respon.error.en_penerbit) {
            $('#en_penerbit').addClass('is-invalid');
            $('.error-penerbit').html(respon.error.en_penerbit);
          } else {
            $('#en_penerbit').removeClass('is-invalid');
            $('.error-penerbit').html('');
          }

          if (respon.error.en_deskripsi) {
            $('#en_deskripsi').addClass('is-invalid');
            $('.error-deskripsi').html(respon.error.en_deskripsi);
          } else {
            $('#en_deskripsi').removeClass('is-invalid');
            $('.error-deskripsi').html('');
          }

          if (respon.error.en_cover) {
            $('#en_cover').addClass('is-invalid');
            $('.error-cover').html(respon.error.en_cover);
          } else {
            $('#en_cover').removeClass('is-invalid');
            $('.error-cover').html('');
          }

          if (respon.error.en_doc) {
            $('#en_doc').addClass('is-invalid');
            $('.error-doc').html(respon.error.en_doc);
          } else {
            $('#en_doc').removeClass('is-invalid');
            $('.error-doc').html('');
          }

        } else {
          if (respon.status) {
            $('#TambahBuku').modal('hide');
            Swal.fire({
              icon: 'success',
              text: respon.msg,
            }).then(function() {
              $('#tabel_buku').DataTable().ajax.reload(null, false).draw(false);
              $('#tambah_buku')[0].reset();
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
      url: "<?= base_url() ?>buku/getOne",
      type: "post",
      data: {
        id: id
      },
      dataType: "json",
      success: function(respon) {
        ModalEdit();
        //insert data to form
        $("#ubah_buku #en_id").val(respon.id_buku);
        $("#ubah_buku #en_judul").val(respon.judul);
        $("#ubah_buku #en_kat").val(respon.kategori_id);
        $("#ubah_buku #en_penulis").val(respon.penulis);
        $("#ubah_buku #en_penerbit").val(respon.penerbit);
        $("#ubah_buku #en_terbit").val(respon.tahun_terbit);
        $("#ubah_buku #en_deskripsi").val(respon.deskripsi);
        $("#ubah_buku #en_cover").val(respon.cover_buku);
        $("#ubah_buku #en_doc").val(respon.file_buku);
      }
    });
  }

  function Update() {
    var form = $('#ubah_buku');
    var formData = new FormData(form[0]);
    $.ajax({
      url: "<?= base_url() ?>buku/update",
      type: "post",
      data: formData,
      dataType: "json",
      enctype: 'multipart/form-data',
      cache: false,
      contentType: false, // Let jQuery handle content type
      processData: false, // Don't process data, let jQuery handle it
      beforeSend: function() {
        $('#btn_update').attr('disabled');
        $("#btn_update").html('<i class="fa fa-spin fa-spinner"></i> Loading...');
      },
      success: function(respon) {
        if (respon.status) {
          $('#UbahBuku').modal('hide');
          Swal.fire({
            icon: 'success',
            text: respon.msg,
          }).then(function() {
            $('#tabel_buku').DataTable().ajax.reload(null, false).draw(false);
            $('#ubah_buku')[0].reset();
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
      url: "<?= base_url() ?>buku/delete",
      type: "post",
      data: {
        id: id
      },
      dataType: "json",
      success: function(respon) {
        if (respon.status) {
          Swal.fire({
            text: "Anda ingin menghapus data ini?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Hapus"
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire({
                title: "Deleted!",
                icon: "success",
                showConfirmButton: false,
                timer: 1000
              });
            }
          }).then(function() {
            $('#tabel_buku').DataTable().ajax.reload(null, false).draw(false);
          });
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