<?php  include('config.php'); ?>
<?php  include('includes/public_functions.php'); ?>
<?php 
	if (isset($_GET['post-slug'])) {
		$post = getPost($_GET['post-slug']);
	}
	$topics = getAllTopics();

	$roles = ['Admin','Author'];	
?>
<?php include('includes/head_section.php'); ?>
<title> <?php echo $post['title'] ?> | LifeBlog</title>
</head>
<body>
	<!-- Navbar -->
		<?php include( ROOT_PATH . '/includes/navbar.php'); ?>
	
		<!-- post sidebar -->
		<div class="post-sidebar">
			<div class="card">
				<div class="card-header">
					<h2>Topics</h2>
				</div>
				<div class="card-content">
					<?php foreach ($topics as $topic): ?>
						<a 
							href="<?php echo BASE_URL . 'filtered_posts.php?topic=' . $topic['id'] ?>">
							<?php echo $topic['name']; ?>
						</a> 
					<?php endforeach ?>
				</div>

<!-- Page Header-->
<header class="masthead" style="background-image: url('static/images/post.jpg')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="post-heading">
							<h1 class="post-title"><?php echo $post['title']; ?></h1>
							<p class="post-meta">Posted by <?php echo $roles[$post['user_id'] -1]  ?>
								on 
								<?php echo date("F j, Y ", strtotime($post["created_at"])); ?>
                        	</p>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Post Content-->
        <article class="mb-4">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
					<img class="img-fluid" src="<?php echo BASE_URL . '/static/images/' . $post['image']; ?>" alt="..." /></a>
                        <P><?php echo html_entity_decode($post['body']); ?></P>
                    </div>
                </div>
            </div>
        </article>

<?php include( ROOT_PATH . '/includes/footer.php'); ?>