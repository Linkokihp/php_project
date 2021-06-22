<?php include('config.php'); ?>
<?php include('includes/login_be.php'); ?>
<?php include('includes/head_section.php'); ?>
<?php
	if (isset($_SESSION['logoutmessage'])) {
		echo '<script type="text/javascript">alert("' . $_SESSION['logoutmessage'] . '");</script>';
		unset($_SESSION['logoutmessage']);
	}
?>
	<title>Eurotrip - Blog | Login</title>
</head>
<body>
	<!-- Page Header-->
	<header class="masthead" style="background-image: url('static/images/login.jpg')">
		<div class="container position-relative px-4 px-lg-5">
			<div class="row gx-4 gx-lg-5 justify-content-center">
			</div>
		</div>
	</header>
	<!-- Navbar -->
	<?php include( ROOT_PATH . '/includes/navbar.php'); ?>

	<div style="width: 40%; margin: 20px auto; self-align: center;">
		<form method="post" action="login.php" >
			<h2>Login</h2>
			<input type="text" name="username" value="<?php echo $username; ?>" value="" placeholder="Username">
			<input type="password" name="password" placeholder="Password">
			<button type="submit" class="btn btn btn-dark" name="login_btn">Login</button>
			<!-- Remind Passowrd -->
			<div id="formFooter">
      			<a class="underlineHover" href="#">Forgot Password?</a>
    		</div>
		</form>
		<?php include(ROOT_PATH . '/includes/errors.php') ?>
	</div>
<!-- Footer -->
<?php include( ROOT_PATH . '/includes/footer.php'); ?>
