<?php include('config.php'); ?>
<?php include('includes/public_functions.php'); ?>
<?php include('includes/head_section.php'); ?>
<?php 
	// Get posts under a particular topic
	if (isset($_GET['topic'])) {
		$topic_id = $_GET['topic'];
		$posts = getPublishedPostsByTopic($topic_id);
	}

	$roles = ['Admin','Author'];	
?>
	<title>Euroblog | Home </title>
</head>
<body>
<!-- Navbar -->
	<?php include( ROOT_PATH . '/includes/navbar.php'); ?>
	<!-- Page Header-->
	<header class="masthead" style="background-image: url('static/images/filteredpost.jpg')">
		<div class="container position-relative px-4 px-lg-5">
			<div class="row gx-4 gx-lg-5 justify-content-center">
				<div class="col-md-10 col-lg-8 col-xl-7">
					<div class="page-heading">
						<h1><?php echo getTopicNameById($topic_id); ?></h1>
					</div>
				</div>
			</div>
		</div>
	</header>
	<!-- Main Content-->
	<div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <?php foreach ($posts as $post): ?>
                    <!-- Post preview-->
                    <div class="post-preview">
                        <a href="single_post.php?post-slug=<?php echo $post['slug']; ?>">
                            <h2 class="post-title"><?php echo $post['title'] ?></h2>
                            <h3 class="post-subtitle"><?php echo html_entity_decode(substr($post['body'],0,200)) . '...' ?></h3>
                        </a>
                        <p class="post-meta">Posted by <?php echo $roles[$post['user_id'] -1]  ?>
                            on 
                            <?php echo date("F j, Y ", strtotime($post["created_at"])); ?> Category:
                            <?php if (isset($post['topic']['name'])): ?>
                            <a href="<?php echo BASE_URL . '/filtered_posts.php?topic=' . $post['topic']['id'] ?>" class="btn category"><?php echo $post['topic']['name'] ?></a>
                            <?php endif ?>
                        </p>
                    </div>
                    <!-- Divider-->
                    <hr class="my-4" />
                    <?php endforeach ?>
                </div>
            </div>
        </div>
	<!-- Footer -->
	<?php include( ROOT_PATH . '/includes/footer.php'); ?>
