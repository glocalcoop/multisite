<?php if ( is_multisite() ) { // If it's a multisite install (default) ?>

	<?php get_template_part( 'partials/queries/query', 'posts' ); ?>

<?php } else { ?>

	<?php get_template_part( 'partials/queries/query-posts', 'singlesite' ); ?>

<?php } ?>