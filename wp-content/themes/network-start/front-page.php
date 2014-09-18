<?php
// Template: Front Page

// This template makes heavy use of the Events Manager and the recent-network-posts function (included in with this theme in recent-network-posts.php).
// Without Events Manager, the events module (module 3) will not appear.
// Without the recent-network-posts function, the network-wide posts (module 1 and module 2) will not appear

?>

<?php get_template_part( 'partials/header' ); ?>

	<section class="home-start">
	
		<article class="home-intro">
			<!-- Displays any content entered in the page used as the front page -->
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<?php get_template_part( 'partials/content-post', 'body' ); ?>

			<?php endwhile; endif; ?>
		</article>
		
	</section>

	<section class="home-modules">

		<?php // Recent Posts

		get_template_part( 'partials/listings/listing', 'posts' ); ?>


		<?php // Recent Events

		if ( is_plugin_active('events-manager/events-manager.php') ) { ?>

			<?php get_template_part( 'partials/listings/listing', 'events' ); ?>

		<?php } ?>


		<?php // Recent Sites/Blogs

		if(is_multisite()) { ?>

			<?php get_template_part( 'partials/listings/listing', 'sites' ); ?>

		<?php } ?>


		<?php // Widgets

		dynamic_sidebar( 'home-modules' ); ?>


	<?php
	

	// $posts = get_posts('post_type=post');
	// echo "<pre>";
	// var_dump($news);
	// echo "</pre>";

		?>
	</section>

<?php get_template_part( 'partials/footer' ); ?>
