<?= $this->extend('layout/master_user'); ?>

<?= $this->section('content'); ?>
<div class="container">
  <div class="mb-5">
    <div class="page-title-box">
      <h4 class="page-title">Profile</h4>
    </div>
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-xl-10">
            <form id="ubah_profile" method="post" enctype="multipart/form-data" action="Javascript:Profil();">
              <?= csrf_field(); ?>
              <input type="hidden" name="en_id" value="<?= session()->get('id_user'); ?>">
              <input type="hidden" name="en_foto" value="<?= $pengguna['foto']; ?>">
              <div class="form-group row">
                <label for="en_nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                <div class="col-sm-10">
                  <input class="form-control" type="text" value="<?= $pengguna['nama']; ?>" id="en_nama" name="en_nama">
                </div>
              </div>
              <div class="form-group row">
                <label for="en_noin" class="col-sm-2 col-form-label">Nomor Induk</label>
                <div class="col-sm-10">
                  <input class="form-control" type="text" value="<?= $pengguna['no_induk']; ?>" id="en_noin" name="en_noin">
                </div>
              </div>
              <div class="form-group row">
                <label for="en_email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input class="form-control" type="text" value="<?= $pengguna['email']; ?>" id="en_email" name="en_email" readonly>
                  <input class="form-control" type="hidden" value="<?= $pengguna['email']; ?>" id="en_email" name="en_email">
                </div>
              </div>
              <div class="form-group row">
                <label for="en_jenkel" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-10">
                  <select class="form-control" id="en_jenkel" name="en_jenkel">
                    <option value="">Pilih Jenis Kelamin</option>
                    <?php foreach ($jenkel as $j) : ?>
                      <?php
                      if ($j == $pengguna['jenkel']) :
                      ?>
                        <option value="<?= $j ?>" selected>
                          <?php
                          if ($j == "L") {
                          ?>
                            Laki-Laki
                          <?php
                          } else {
                          ?>
                            Perempuan
                          <?php
                          }
                          ?>
                        </option>
                      <?php
                      else :
                      ?>
                        <option value="<?= $j ?>">
                          <?php
                          if ($j == "L") {
                          ?>
                            Laki-Laki
                          <?php
                          } else {
                          ?>
                            Perempuan
                          <?php
                          }
                          ?>
                        </option>
                      <?php
                      endif;
                      ?>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="en_alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                  <input class="form-control" type="text" value="<?= $pengguna['alamat']; ?>" id="en_alamat" name="en_alamat">
                </div>
              </div>
              <div class="form-group row">
                <label for="en_telp" class="col-sm-2 col-form-label">Telp</label>
                <div class="col-sm-10">
                  <input class="form-control" type="text" value="<?= $pengguna['telp']; ?>" id="en_telp" name="en_telp">
                </div>
              </div>
              <div class="form-group row">
                <label for="en_status" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                  <input class="form-control" type="text" value="<?= $pengguna['status']; ?>" id="en_status" name="en_status" readonly>
                  <input class="form-control" type="hidden" value="<?= $pengguna['status']; ?>" id="en_status" name="en_status">
                </div>
              </div>
              <div class="form-group row">
                <label for="en_prodi" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                  <input class="form-control" type="text" value="<?= $pengguna['prodi']; ?>" id="en_prodi" name="en_prodi" readonly>
                  <input class="form-control" type="hidden" value="<?= $pengguna['prodi']; ?>" id="en_prodi" name="en_prodi">
                </div>
              </div>
              <div class="form-group row">
                <label for="new_foto" class="col-sm-2 col-form-label">Foto</label>
                <div class="col-sm-10 custom-file">
                  <input type="file" class="form-control" id="new_foto" name="new_foto">
                  <small class="text-danger error-foto"></small>
                </div>
              </div>
              <div class="form-group row">
                <button type="submit" class="btn btn-primary mx-3" id="btn_update">Update Profile</button>
              </div>
            </form>
          </div>
          <div class="col-xl-2">
            <div class="border border-dark">
              <img src="/gambar/<?= $pengguna['foto']; ?>" style="width: 153px; height: 200px;">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
  function Profil() {
    var form = $('#ubah_profile');
    var formData = new FormData(form[0]);
    $.ajax({
      url: "<?= base_url() ?>auth/profil",
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
        if (respon.error) {
          if (respon.error.new_foto) {
            $('#new_foto').addClass('is-invalid');
            $('.error-foto').html(respon.error.new_foto);
          } else {
            $('#new_foto').removeClass('is-invalid');
            $('.error-foto').html('');
          }
        } else if (respon.status) {
          Swal.fire({
            icon: 'success',
            text: respon.msg,
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
        $('#btn_update').html('Update Profile');
      }
    });
  }
</script>
<?= $this->endSection(); ?>