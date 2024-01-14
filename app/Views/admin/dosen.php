<?= $this->extend("layout/master_app"); ?>

<?= $this->section("style"); ?>
<!-- DataTables -->
<link href="/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<?= $this->endSection(); ?>

<?= $this->section("content"); ?>
<div class="card mt-4">
  <div class="card-header">
    <span>Data Dosen</span>
  </div>
  <div class="card-body">
    <table id="tabel_dosen" class="table table-bordered" style="width: 100%;">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Nama</th>
          <th scope="col">Email</th>
          <th scope="col">Jenis Kelamin</th>
          <th scope="col">Status</th>
          <th scope="col">Program Studi</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section("script") ?>
<!-- Required datatable js -->
<script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    var table = $('#tabel_dosen').DataTable({
      "ajax": {
        "url": '<?= base_url("user/getAllDosen") ?>',
        "type": "POST",
        "dataType": "json",
        async: "true"
      }
    });
  });
</script>
<?= $this->endSection(); ?>