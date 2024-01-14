<?= $this->extend("layout/master_auth"); ?>

<?= $this->section('content'); ?>


<h3 class="text-center mt-0">
  <img src="/gambar/library-logo.png" class="my-1" style="width: 250px; height: 80px; object-fit: cover;">
  <p style="font-size: 22px;">Login</p>
</h3>

<div class="px-3 py-0">
  <form id="login" class="form-horizontal m-t-20" method="post" action="Javascript:Login()">

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

    <div class="form-group text-center row m-t-20">
      <div class="col-12">
        <button type="submit" id="btn_login" class="btn btn-danger btn-block waves-effect waves-light" type="submit">Log In</button>
      </div>
    </div>

    <div class="form-group m-t-10 mb-0 row">
      <div class="col-sm-5 m-t-20">
        <a href="<?= base_url() ?>registrasi" class="text-muted"><i class="mdi mdi-account-circle"></i> <small>Create an account ?</small></a>
      </div>
    </div>
  </form>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
  function Login() {
    $.ajax({
      url: "<?= base_url(); ?>auth/login",
      data: $('#login').serialize(),
      type: "post",
      dataType: "json",
      beforeSend: function() {
        $('#btn_login').attr('disabled');
        $("#btn_login").html('<i class="fa fa-spin fa-spinner"></i> Loading...');
      },
      success: function(respon) {
        if (respon.error) {
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

        } else {
          if (respon.status) {
            Swal.fire({
              icon: 'success',
              text: respon.msg,
              showConfirmButton: false,
              timer: 1500
            });
            setTimeout(function() {
              window.location = respon.link
            }, 500);
          } else {
            Swal.fire({
              icon: 'warning',
              text: respon.msg,
            });
          }
        }
      },
      complete: function() {
        $('#btn_login').removeAttr('disable');
        $('#btn_login').html('Log In');
      }
    })
  }
</script>
<?= $this->endSection(); ?>