<?php get_template_part( 'partials/header' ); ?>

	<section id="page-<?php global $post; echo $post->post_name; ?>" class="content-<?php global $post; echo $post->post_name; ?>" role="main">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<?php get_template_part( 'partials/content', 'page' ); ?>

		<?php endwhile; ?>

		<?php else : ?>

			<?php get_template_part( 'partials/content', '404' ); ?>

		<?php endif; ?>

		<?php if(is_page('news')) { ?>

			<?php get_template_part( 'partials/listing', 'posts' ); ?>

		<?php } ?>

	</section>

	<?php get_template_part( 'partials/sidebar' ); ?>
			
<?php get_template_part( 'partials/footer' ); ?>
