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

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

</head>


<body>

  <!-- Navigation Bar-->
  <header id="topnav">
    <div class="topbar-main">
      <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center">
          <!-- Logo container-->
          <div class="logo">
            <!-- Image Logo -->
            <a href="<?= base_url(); ?>" class="logo">
              <img src="/gambar/library-logo.png" class="my-1" style="width: 200px; height: 60px; object-fit: cover;">
              <!-- <img src="/assets/images/logo-sm.png" alt="" height="16" class="logo-small"> -->
            </a>

          </div>
          <!-- End Logo container-->

          <div class="menu-extras topbar-custom">

            <ul class="list-inline float-right mb-0">

              <li class="list-inline-item dropdown notification-list hide-phone">
                <span class="nav-link dropdown-toggle arrow-none waves-effect text-black">
                  <?= session()->get('nama'); ?>
                </span>
              </li>

              <!-- User-->
              <li class="list-inline-item dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                  <img src="/gambar/<?= session()->get('foto'); ?>" alt="user" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                  <!-- item-->
                  <div class="dropdown-item noti-title">
                    <h5>Welcome</h5>
                  </div>
                  <a class="dropdown-item" href="<?= base_url() ?>user/profil/<?= session()->get('id_user') ?>"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> Profile</a>
                  <div class="dropdown-divider"></div>
                  <span class="dropdown-item pointer" style="cursor: pointer;" onclick="logout()"><i class="mdi mdi-logout m-r-5 text-muted"></i> Logout</span>
                </div>
              </li>

              <li class="menu-item list-inline-item">
                <!-- Mobile menu toggle-->
                <a class="navbar-toggle nav-link">
                  <div class="lines">
                    <span></span>
                    <span></span>
                    <span></span>
                  </div>
                </a>
                <!-- End mobile menu toggle-->
              </li>

            </ul>
          </div>
          <!-- end menu-extras -->

        </div>

        <div class="clearfix"></div>

      </div> <!-- end container -->
    </div>
    <!-- end topbar-main -->

    <!-- MENU Start -->
    <div class="navbar-custom">
      <div class="container-fluid">
        <div id="navigation">
          <!-- Navigation Menu-->
          <ul class="navigation-menu">

            <li class="has-submenu">
              <a href="<?= base_url(); ?>user">Homepage</a>
            </li>

            <li class="has-submenu">
              <a href="<?= base_url(); ?>user/book">Daftar Buku</a>
            </li>

          </ul>
          <!-- End navigation menu -->
        </div> <!-- end #navigation -->
      </div> <!-- end container -->
    </div> <!-- end navbar-custom -->
  </header>
  <!-- End Navigation Bar-->


  <div class="wrapper">

    <!-- Page-Title -->
    <?= $this->renderSection('content'); ?>
    <!-- end page title end breadcrumb -->

  </div>
  <!-- end wrapper -->


  <!-- Footer -->
  <footer class="footer">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          © 2023 E-Library by Nisa Istifarra.
        </div>
      </div>
    </div>
  </footer>
  <!-- End Footer -->


  <!-- jQuery  -->
  <script src="/assets/js/jquery.min.js"></script>
  <script src="/assets/js/popper.min.js"></script>
  <script src="/assets/js/bootstrap.min.js"></script>
  <script src="/assets/js/modernizr.min.js"></script>
  <script src="/assets/js/detect.js"></script>
  <script src="/assets/js/fastclick.js"></script>
  <script src="/assets/js/jquery.slimscroll.js"></script>
  <script src="/assets/js/jquery.blockUI.js"></script>
  <script src="/assets/js/waves.js"></script>
  <script src="/assets/js/jquery.nicescroll.js"></script>
  <script src="/assets/js/jquery.scrollTo.min.js"></script>

  <!-- App js -->
  <script src="/assets/js/app.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    function logout() {
      $.ajax({
        type: 'GET',
        url: '<?= base_url() ?>auth/logout', // Sesuaikan dengan rute Anda
        success: function(respon) {
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
          }
        }
      })
    }
  </script>

  <?= $this->renderSection('script'); ?>

</body>

</html>