<?php get_template_part( 'partials/header' ); ?>

<ul>
	<li>get sites</li>
	<li>get posts from sites</li>
	<li>set up array
		<ul>
			<li>site name</li>
			<li>site id</li>
			<li>site url</li>
			<li>site custom image</li>
			<li>post name</li>
			<li>post id</li>
			<li>post url</li>
			<li>post content</li>
			<li>post date</li>
			<li>post author</li>
			<li>post author link</li>
			<li>post category name</li>
			<li>post thumbnail</li>
		</ul>
	</li>		
	<li>sort array by posts</li>
</ul>


<?php

if(function_exists('display_network_posts')) { 
	display_network_posts();
}

if(function_exists('network_posts')) { 
	$get_posts = network_posts();
}

?>

<?php
echo '<pre>';
var_dump($get_posts);
// var_dump($network_posts);
// var_dump($post_detail['post_categories']);
// var_dump($network_content);
echo '</pre>';
?>

			
<?php get_template_part( 'partials/footer' ); ?>
