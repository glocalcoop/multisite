<?php get_template_part( 'partials/header' ); ?>

	<section id="page-<?php global $post; echo $post->post_name; ?>" class="content-<?php global $post; echo $post->post_name; ?>" role="main">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<?php get_template_part( 'partials/content', 'page' ); ?>

		<?php endwhile; endif; ?>

		<?php get_template_part( 'partials/listings/listing', 'posts' ); ?>

	</section>

	<?php get_template_part( 'partials/sidebar' ); ?>

<?php get_template_part( 'partials/footer' ); ?>
