<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <title>E-Library | Halaman Login</title>
  <meta content="Admin Dashboard" name="description" />
  <meta content="Mannatthemes" name="author" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />

  <link rel="shortcut icon" href="assets/images/favicon.ico">

  <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="assets/css/admin-icons.css" rel="stylesheet" type="text/css">
  <link href="assets/css/admin-style.css" rel="stylesheet" type="text/css">

</head>


<body class="fixed-left">

  <!-- Begin page -->
  <div class="accountbg"></div>
  <div class="wrapper-page">

    <div class="card">
      <div class="card-body">

        <?= $this->renderSection('content'); ?>

      </div>
    </div>
  </div>

  <!-- jQuery  -->
  <script src="assets/js/jquery.min.js"></script>

  <!-- App js -->
  <script src="assets/js/app.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <?= $this->renderSection('script'); ?>

</body>

</html>