<?= $this->extend('layout/master_user') ?>



<?= $this->section('content') ?>

<div class="container-fluid">
  <div class="card mt-4">
    <div class="card-body">
      <div class="mb-4">
        <form id="s_kat" method="post" action="Javascript:Search()">
          <div class="row">
            <div class="col-lg-3">
              <select class="form-control" name="keyword" id="keyword">
                <option value="">- Pilih Kategori -</option>
                <?php
                foreach ($kategori as $value) {
                ?>
                  <option value="<?= $value['id_kategori'] ?>"><?= $value['kategori'] ?></option>
                <?php
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </form>
      </div>
      <div class="row" id="t_buku">

      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
  $(document).ready(function() {
    Search();
  })

  function Search() {
    $.ajax({
      url: "<?= base_url(); ?>user/getBuku",
      data: $("#s_kat").serialize(),
      type: "post",
      dataType: "json",
      success: function(respon) {
        $('#t_buku').html(respon.status);
      },
    })
  }
</script>
<?= $this->endSection() ?>