<?php  include('config.php'); ?>
<?php  include('includes/login_be.php'); ?>
<?php  include('includes/head_section.php'); ?>
	<title>Eurotrip - Blog | Login</title>
</head>
<body>
	<!-- Page Header-->
	<header class="masthead" style="background-image: url('static/images/login.jpg')">
		<div class="container position-relative px-4 px-lg-5">
			<div class="row gx-4 gx-lg-5 justify-content-center">
				<div class="col-md-10 col-lg-8 col-xl-7">
					<div class="page-heading">
						<h1>Login</h1>
					</div>
				</div>
			</div>
		</div>
	</header>
	<!-- Navbar -->
	<?php include( ROOT_PATH . '/includes/navbar.php'); ?>

	<div style="width: 40%; margin: 20px auto;">
		<form method="post" action="login.php" >
			<h2>Login</h2>
			<?php include(ROOT_PATH . '/includes/errors.php') ?>
			<input type="text" name="username" value="<?php echo $username; ?>" value="" placeholder="Username">
			<input type="password" name="password" placeholder="Password">
			<button type="submit" class="btn" name="login_btn">Login</button>
		</form>
	</div>
<!-- Footer -->
	<?php include( ROOT_PATH . '/includes/footer.php'); ?>
