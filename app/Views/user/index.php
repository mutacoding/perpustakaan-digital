<?= $this->extend('layout/master_user') ?>

<?= $this->section('content') ?>
<section class="my-2">
  <div class="row">
    <div class="col-xl-9">
      <div class="card">
        <div class="card-header">
          <h5 class="header-title">Buku Terbaru</h5>
        </div>
        <div class="card-body">
          <div class="row">
            <?php
            foreach ($buku as $value) {
            ?>
              <div class="col-xl-2">
                <a href="<?= base_url() ?>user/title/<?= $value['id_buku']; ?>">
                  <div class="card shadow-lg">
                    <img src="/gambar/<?= $value['cover_buku'] ?>" class="card-img-top" alt="..." style="width: auto; height:180px">
                    <div class="card-body" style="padding: 0px 4px;">
                      <div class="border-bottom border-dark">
                        <p class="card-title text-truncate" style="font-size: 13px; color: black; font-weight: 500; margin: 0; padding: 0;"><?= $value['judul']; ?></p>
                        <p class="card-title text-truncate" style="font-size: 13px; color: black; margin: 0; padding: 0;"><?= $value['penulis']; ?></p>
                      </div>
                      <div class="d-flex justify-content-between align-items-center py-2">
                        <span style="font-size: 10px;">New update</span>
                        <span style="color: black; font-size: 10px;"><i class="fa fa-eye"></i> <?= $value['view']; ?></span>
                      </div>
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
    </div>
    <div class="col-xl-3">
      <div class="card mb-3" style="max-width: 540px;">
        <div class="card-header">
          <i class="fa fa-eye"></i> <span>Paling sering dilihat</span>
        </div>
        <?php
        foreach ($view as $value) {
        ?>
          <div class="card mb-3 shadow-lg p-2" style="max-width: 540px;">
            <a href="<?= base_url() ?>user/title/<?= $value['id_buku']; ?>">
              <div class="row no-gutters">
                <div class="col-md-3">
                  <img src="/gambar/<?= $value['cover_buku'] ?>" style="width: 90px; height: 100px;">
                </div>
                <div class="col-md-9">
                  <div class="card-body">
                    <div class="ml-1">
                      <h6 class="card-title m-0 p-0"><?= $value['judul']; ?></h6>
                      <p class="card-text m-0 p-0"><?= $value['penulis']; ?></p>
                      <p class="card-text m-0 p-0"><small class="text-muted"><i class="fa fa-eye"></i> <span><?= $value['view']; ?></span></small></p>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
        <?php
        }
        ?>
      </div>

      <div class="card">
        <div class="card-header">
          <h5 class="header-title">Contact us</h5>
        </div>
        <div class="card-body">
          <form id="send_contact" method="post" action="Javascript:Contact();">
            <input type="hidden" name="en_email" id="en_email" value="<?= session()->get('email'); ?>">
            <div class="form-group">
              <label for="en_pesan">Saran dan Komentar</label>
              <textarea class="form-control" id="en_pesan" name="en_pesan" rows="3"></textarea>
              <small class="text-danger error-pesan"></small>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary" id="btn_send">kirim</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
  function Contact() {
    $.ajax({
      url: "<?= base_url(); ?>contact/pesan",
      data: $("#send_contact").serialize(),
      type: "post",
      dataType: "json",
      beforeSend: function() {
        $('#btn_send').attr('disabled');
        $("#btn_send").html('<i class="fa fa-spin fa-spinner"></i> Loading...');
      },
      success: function(respon) {
        if (respon.error) {
          if (respon.error.en_pesan) {
            $('#en_pesan').addClass('is-invalid');
            $('.error-pesan').html(respon.error.en_pesan);
          } else {
            $('#en_pesan').removeClass('is-invalid');
            $('.error-pesan').html('');
          }

        } else {
          if (respon.status) {
            Swal.fire({
              icon: 'success',
              text: respon.msg,
              showConfirmButton: false,
              timer: 1500
            });
          } else {
            Swal.fire({
              icon: 'warning',
              text: respon.msg,
            });
          }
        }
      },
      complete: function() {
        $('#btn_send').removeAttr('disable');
        $('#btn_send').html('Kirim');
      }
    })
  }
</script>
<?= $this->endSection() ?>