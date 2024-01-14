<?php
$session = \Config\Services::session();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <title>Annex - Responsive Bootstrap 4 Admin Dashboard</title>
  <meta content="Admin Dashboard" name="description" />
  <meta content="Mannatthemes" name="author" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />

  <link rel="shortcut icon" href="/assets/images/favicon.ico">

  <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="/assets/css/user-icons.css" rel="stylesheet" type="text/css">
  <link href="/assets/css/user-style.css" rel="stylesheet" type="text/css">

</head>


<body>

  <div class="container-fluid">
    <div class="embed-responsive embed-responsive-21by9" style="height: 250vh;">
      <iframe class="embed-responsive-item" src="/document/<?= $buku['file_buku']; ?>"></iframe>
    </div>
  </div>

  <!-- jQuery  -->
  <script src="/assets/js/jquery.min.js"></script>
  <script src="/assets/js/popper.min.js"></script>
  <script src="/assets/js/bootstrap.min.js"></script>

  <!-- App js -->
  <script src="/assets/js/app.js"></script>

</body>

</html>