<?php 

// Posts query for single site installs

$recentargs = array (
	'post_type'              => 'post',
	'ignore_sticky_posts'    => false,
);

// The Query
$recentposts = new WP_Query($recentargs);
$posts = get_posts('post_type=post');

// echo "<pre>";
// var_dump($recentposts);
// echo "</pre>";

?>
<?php while ($recentposts->have_posts()) : $recentposts->the_post(); ?>

	<?php get_template_part( 'partials/list', 'posts' ); ?>

<?php endwhile; ?>
