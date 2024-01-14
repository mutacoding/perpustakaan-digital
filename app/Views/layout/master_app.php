<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<title>E-Library</title>
	<meta content="Admin Dashboard" name="description" />
	<meta content="Mannatthemes" name="author" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<link rel="shortcut icon" href="/assets/images/favicon.ico">

	<link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="/assets/css/admin-icons.css" rel="stylesheet" type="text/css">
	<link href="/assets/css/admin-style.css" rel="stylesheet" type="text/css">

	<?= $this->renderSection("style"); ?>

</head>


<body class="fixed-left">

	<!-- Begin page -->
	<div id="wrapper">

		<!-- ========== Left Sidebar Start ========== -->
		<div class="left side-menu">
			<button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
				<i class="ion-close"></i>
			</button>

			<!-- LOGO -->
			<div class="topbar-left">
				<div class="text-center">
					<a href="<?= base_url(); ?>" class="logo"><img src="/gambar/library-logo.png" class="my-1" style="width: 200px; height: 70px; object-fit: cover;"></a>
					<!-- <a href="index.html" class="logo"><img src="/assets/images/logo.png" height="24" alt="logo"></a> -->
				</div>
			</div>

			<div class="sidebar-inner slimscrollleft">

				<div id="sidebar-menu">
					<ul>
						<li>
							<a href="<?= base_url(); ?>admin/" class="waves-effect active"><i class="mdi mdi-airplay"></i><span> Dashboard </span>
							</a>
						</li>

						<li class="menu-title">Main</li>

						<li class="has_sub">
							<a href="javascript:void(0);" class="waves-effect"><i class="fa fa-book"></i> <span> Data buku </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
							<ul class="list-unstyled">
								<li><a href="<?= base_url(); ?>admin/buku">Daftar Buku</a></li>
								<li><a href="<?= base_url(); ?>admin/kategori">Kategori Buku</a></li>
							</ul>
						</li>

						<li class="has_sub">
							<a href="javascript:void(0);" class="waves-effect"><i class="fa fa-user"></i> <span> Data Pengguna </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
							<ul class="list-unstyled">
								<li><a href="<?= base_url(); ?>admin/mahasiswa">Data Mahasiswa</a></li>
								<li><a href="<?= base_url(); ?>admin/dosen">Data Dosen</a></li>
							</ul>
						</li>

						<li>
							<a href="<?= base_url(); ?>admin/prodi" class="waves-effect"><i class="fa fa-graduation-cap"></i><span> Program Studi </span></a>
						</li>

					</ul>
				</div>
				<div class="clearfix"></div>
			</div> <!-- end sidebarinner -->
		</div>
		<!-- Left Sidebar End -->

		<!-- Start right Content here -->

		<div class="content-page">
			<!-- Start content -->
			<div class="content">

				<!-- Top Bar Start -->
				<div class="topbar">

					<nav class="navbar-custom">

						<ul class="list-inline float-right mb-0">

							<li class="list-inline-item dropdown notification-list hide-phone">
								<span class="nav-link dropdown-toggle arrow-none waves-effect text-white">
									<?= session()->get('nama'); ?>
								</span>
							</li>

							<li class="list-inline-item dropdown notification-list">
								<a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
									<img src="/gambar/<?= session()->get('foto'); ?>" alt="user" class="rounded-circle">
								</a>
								<div class="dropdown-menu dropdown-menu-right profile-dropdown ">
									<div class="dropdown-item noti-title">
										<h5>Welcome</h5>
									</div>
									<a class="dropdown-item" href="<?= base_url() ?>admin/profil/<?= session()->get('id_user') ?>"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> Profile</a>
									<div class="dropdown-divider"></div>
									<span class="dropdown-item" style="cursor: pointer;" onclick="logout()"><i class="mdi mdi-logout m-r-5 text-muted"></i> Logout</span>
								</div>
							</li>

						</ul>

						<ul class="list-inline menu-left mb-0">
							<li class="float-left">
								<button class="button-menu-mobile open-left waves-light waves-effect">
									<i class="mdi mdi-menu"></i>
								</button>
							</li>
						</ul>

						<div class="clearfix"></div>

					</nav>

				</div>
				<!-- Top Bar End -->

				<div class="page-content-wrapper ">

					<div class="container-fluid">
						<!-- Start : content -->
						<div>
							<?= $this->renderSection("content"); ?>
						</div>
						<!-- End : content -->
					</div><!-- container -->

				</div> <!-- Page content Wrapper -->

			</div> <!-- content -->

			<footer class="footer">
				© 2023 E-Library by Nisa Istifarra.
			</footer>

		</div>
		<!-- End Right content here -->

	</div>
	<!-- END wrapper -->

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
							window.location = respon.link;
						}, 500)
					}
				}
			})
		}
	</script>

	<?= $this->renderSection("script"); ?>

</body>

</html>