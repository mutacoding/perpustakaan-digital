<?= $this->extend("layout/master_auth"); ?>

<?= $this->section('content'); ?>

<h3 class="text-center mt-0">
  <img src="/gambar/library-logo.png" class="my-1" style="width: 250px; height: 80px; object-fit: cover;">
  <p style="font-size: 22px;">Registrasi</p>
</h3>

<div class="px-3 py-0">
  <form class="form-horizontal m-t-20" id="tambah_user" action="Javascript:Create();">

    <div class="form-group row">
      <div class="col-12">
        <input class="form-control" type="text" id="en_nama" name="en_nama" placeholder="Nama Lengkap">
        <small class="text-danger error-nama"></small>
      </div>
    </div>

    <div class="form-group row">
      <div class="col-12">
        <input class="form-control" type="text" id="en_email" name="en_email" placeholder="Email">
        <small class="text-danger error-email"></small>
      </div>
    </div>

    <div class="form-group row">
      <div class="col-12">
        <input class="form-control" type="password" id="en_password" name="en_password" placeholder="Password">
        <small class="text-danger error-password"></small>
      </div>
    </div>

    <div class="form-group row">
      <div class="col-12">
        <input class="form-control" type="password" id="con_password" name="con_password" placeholder="Confirm Password">
        <small class="text-danger error-conpass"></small>
      </div>
    </div>

    <div class="row">
      <div class="col-xl-6">
        <div class="form-group row">
          <div class="col-12">
            <select class="form-control" name="en_status" id="en_status">
              <option>Status</option>
              <option value="mahasiswa">Mahasiswa</option>
              <option value="dosen">Dosen</option>
            </select>
          </div>
        </div>
      </div>
      <div class="col-xl-6">
        <div class="form-group row">
          <div class="col-12">
            <select class="form-control" name="en_prodi" id="en_prodi">
              <option>Program Studi</option>
              <?php
              foreach ($prodi as $value) {
              ?>
                <option value="<?= $value['prodi'] ?>"><?= $value['prodi'] ?></option>
              <?php
              }
              ?>
            </select>
          </div>
        </div>
      </div>
    </div>

    <div class="form-group text-center row m-t-20">
      <div class="col-12">
        <button type="submit" id="btn_create" class="btn btn-danger btn-block waves-effect waves-light">Registrasi</button>
      </div>
    </div>

    <div class="form-group m-t-10 mb-0 row">
      <div class="col-sm-10 m-t-20">
        <a href="<?= base_url() ?>" class="text-muted"><i class="mdi mdi-account-circle"></i> <small>Have an account ? Please Login</small></a>
      </div>
    </div>
  </form>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
  function Create() {
    $.ajax({
      url: "<?= base_url() ?>auth/create",
      data: $('#tambah_user').serialize(),
      type: "post",
      dataType: "json",
      beforeSend: function() {
        $('#btn_create').attr('disabled');
        $("#btn_create").html('<i class="fa fa-spin fa-spinner"></i> Loading...');
      },
      success: function(respon) {
        if (respon.error) {
          if (respon.error.en_nama) {
            $('#en_nama').addClass('is-invalid');
            $('.error-nama').html(respon.error.en_nama);
          } else {
            $('#en_nama').removeClass('is-invalid');
            $('.error-nama').html('');
          }

          if (respon.error.en_email) {
            $('#en_email').addClass('is-invalid');
            $('.error-email').html(respon.error.en_email);
          } else {
            $('#en_email').removeClass('is-invalid');
            $('.error-email').html('');
          }

          if (respon.error.en_password) {
            $('#en_password').addClass('is-invalid');
            $('.error-password').html(respon.error.en_password);
          } else {
            $('#en_password').removeClass('is-invalid');
            $('.error-password').html('');
          }

          if (respon.error.con_password) {
            $('#con_password').addClass('is-invalid');
            $('.error-conpass').html(respon.error.con_password);
          } else {
            $('#con_password').removeClass('is-invalid');
            $('.error-conpass').html('');
          }
        } else {
          if (respon.status) {
            Swal.fire({
              icon: 'success',
              text: respon.msg,
              showConfirmButton: false,
              timer: 1500
            });
            setTimeout(function() {
              window.location = respon.link;
            }, 500)
          } else {
            Swal.fire({
              icon: 'warning',
              text: respon.msg,
              showConfirmButton: false,
            });
          }
        }
      },
      complete: function() {
        $('#btn_create').removeAttr('disable');
        $('#btn_create').html('Registrasi');
      }
    })
  }
</script>
<?= $this->endSection(); ?>