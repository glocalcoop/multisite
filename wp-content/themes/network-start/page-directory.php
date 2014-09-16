<?php get_template_part( 'partials/header' ); ?>

	<div id="main">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<?php get_template_part( 'partials/listings/listing', 'sites' ); ?>


		<?php endwhile; else : ?>

			<?php get_template_part( 'partials/content', '404' ); ?>

		<?php endif; ?>

		<?php get_template_part( 'sidebar' ); ?>
		
	</div>

	<?php get_template_part( 'partials/script-isotope', 'directory' ); ?>

</script>

<?php get_template_part( 'partials/footer' ); ?>
