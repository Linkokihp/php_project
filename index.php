<?php require_once('config.php') ?>
<?php require_once( ROOT_PATH . '/includes/public_functions.php') ?>
<?php require_once( ROOT_PATH . '/includes/login_be.php') ?>
<!-- Retrieve all posts from database  -->
<?php $posts = getPublishedPosts(); ?>
<?php require_once(ROOT_PATH . '/includes/head_section.php') ?>
<?php 
	$roles = ['Admin','Author'];			
?>
	<title>Eurotrip - Blog | Home</title>
</head>
<body>
		<!-- navbar -->
		<?php include(ROOT_PATH . '/includes/navbar.php') ?>

        <!-- banner -->
        <?php include(ROOT_PATH . '/includes/banner.php') ?>

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
<!-- footer -->
<?php include(ROOT_PATH . '/includes/footer.php') ?>
