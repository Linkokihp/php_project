<?php include('../config.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/admin_functions.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/head_section.php'); ?>
<?php
  $session_laufzeit = 5*60;
  $localtime = time();

  if( isset($_SESSION['isloggedin'])){
    if($_SESSION['isloggedin'] != true || ($_SESSION['login_timestamp'] + $session_laufzeit) < $localtime) {
      $_SESSION['logoutmessage'] = "Your session has been expired! Please login again!";
      header('location: ../login.php');
      exit;
    };
  }	else{
    $_SESSION['logoutmessage'] = "Your session has been expired! Please login again!";
      header('location: ../login.php');
      exit;
  };
?>
<?php 
	// Get all admin users from DB
	$admins = getAdminUsers();
	$roles = ['Author']; //'Admin', 			
?>
<title>Manage Users - Euroblog</title>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="dashboard.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>EB</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>Euroblog</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="dashboard.php" class="dropdown-toggle" data-toggle="dropdown">
              <span><?php echo $_SESSION['user']['username'] ?></span> &nbsp; &nbsp;
            </a>
          </li>
          <li>
          <a href="<?php echo BASE_URL . '/logout.php'; ?>" class="btn btn-flat">Sign out</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <!-- Optionally, you can add icons to the links -->
        <li class="inactive">
          <a href="<?php echo BASE_URL . '/admin/create_post.php' ?>"><i class="fa fa-link"></i><span>Create Posts</span></a>
        </li>
        <li class="inactive">
          <?php if ($_SESSION['user']['username'] === 'admin'):?>
			    <a href="<?php echo BASE_URL . '/admin/posts.php' ?>"><i class="fa fa-link"></i><span>Manage Posts</span></a>
			    <?php endif ?>
        </li>
        <li class="inactive">
          <?php if ($_SESSION['user']['username'] === 'admin'):?>
			    <a href="<?php echo BASE_URL . '/admin/topics.php' ?>"><i class="fa fa-link"></i><span>Manage Topics</span></a>
			    <?php endif ?>
        </li>
        <li class="active">
        <a href="<?php echo BASE_URL . '/admin/users.php' ?>"><i class="fa fa-link"></i><span>Manage Users</span></a>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage/Create User
      </h1>
    </section>

	<br><br>

    <!-- Main content -->
	<div class="container content">
		<!-- Middle form - to create and edit  -->
		<div class="action">
			<form method="post" action="<?php echo BASE_URL . '/admin/users.php'; ?>" >

				<!-- validation errors for the form -->
				<?php include(ROOT_PATH . '/includes/errors.php') ?>

				<!-- if editing user, the id is required to identify that user -->
				<?php if ($isEditingUser === true): ?>
					<input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>">
				<?php endif ?>

				<input type="text" name="username" value="<?php echo $username; ?>" placeholder="Username">
				<input type="email" name="email" value="<?php echo $email ?>" placeholder="Email">
				<input type="password" name="password" placeholder="Password">
				<input type="password" name="passwordConfirmation" placeholder="Password confirmation">
				<select name="role">
					<option value="" selected disabled>Assign role</option>
					<?php foreach ($roles as $key => $role): ?>
						<option value="<?php echo $role; ?>"><?php echo $role; ?></option>
					<?php endforeach ?>
				</select>

				<!-- if editing user, display the update button instead of create button -->
				<?php if ($isEditingUser === true): ?> 
					<button type="submit" class="btn" name="update_admin">UPDATE</button>
				<?php else: ?>
					<button type="submit" class="btn" name="create_admin">Save User</button>
				<?php endif ?>
			</form>
		</div>
		<!-- // Middle form - to create and edit -->

		<!-- Display records from DB-->
		<div class="table-div">
			<!-- Display notification message -->
			<?php include(ROOT_PATH . '/includes/messages.php') ?>
			<!-- Admin -->
			<table class="table">
				<thead>
					<th>N</th>
					<th>Admin</th>
					<th>Role</th>
					<th colspan="2">Action</th>
				</thead>
				<tbody>
				<?php foreach ($admins as $key => $admin): ?>
					<?php if ($admin['role'] === 'Admin'):?>
					<tr>
						<td><?php echo $key + 1; ?></td>
						<td>
							<?php echo $admin['username']; ?>, &nbsp;
							<?php echo $admin['email']; ?>	
						</td>
						<td><?php echo $admin['role']; ?></td>
						<td>
							<?php if ($_SESSION['user']['username'] === 'admin'):?>
							<a class="fa fa-pencil btn edit"
								href="users.php?edit-admin=<?php echo $admin['id'] ?>">
							</a>
							<?php endif ?>
						</td>
					</tr>
					<?php endif ?>
				<?php endforeach ?>
				</tbody>
			</table>

			<!-- Author -->
			<table class="table">
				<thead>
					<th>N</th>
					<th>Author</th>
					<th>Role</th>
					<th colspan="2">Action</th>
				</thead>
				<tbody>
					<?php foreach ($admins as $key => $admin): ?>
						<?php if ($admin['role'] === 'Author'): ?>
						<tr>
							<td><?php echo $key; ?></td>
							<td>
								<?php echo $admin['username']; ?>, &nbsp;
								<?php echo $admin['email']; ?>	
							</td>
							<td><?php echo $admin['role']; ?></td>
							<td>
								<a class="fa fa-pencil btn edit"
									href="users.php?edit-admin=<?php echo $admin['id'] ?>">
								</a>
							</td>
							<td>
							<?php if ($_SESSION['user']['username'] === 'admin'):?>
								<a class="fa fa-trash btn delete" 
									href="users.php?delete-admin=<?php echo $admin['id'] ?>">
								</a>
								<?php endif ?>
							</td>
						</tr>
						<?php endif ?>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
		<!-- // Display records from DB -->
	</div>
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- Default to the left -->
    <strong>Copyright &copy; 2021 <a href="#">Phiko</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="pull-right-container">
                    <span class="label label-danger pull-right">70%</span>
                  </span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../static/js/adminlte.min.js"></script>
<script>CKEDITOR.replace('body');</script>
</body>
</html>