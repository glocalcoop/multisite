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

// $sites = wp_get_sites(); // TODO: Add argument to exclude main site (site 1)

// $network_content = array();

// foreach ($sites as $site) {
// 	$site_id = $site['blog_id']; // Variable to hold site ID

// 	$sitedetails = get_blog_details($site_id);

// 	if(function_exists('glocal_network_get_site_image')) { 
// 		$site_header = glocal_network_get_site_image($site_id);
// 	}

// 	$network_content['site-' . $site_id] = array(
// 		'blog_id' => $site_id,
// 		'blogname' => $sitedetails->blogname,
// 		'siteurl' => $sitedetails->siteurl,
// 		'site_header' => $site_header,
// 	);
    
//     // Begin switch
// 	switch_to_blog( $site_id ); 

// 		$recent_posts = wp_get_recent_posts(); // TODO: Enable limiting to specific categor(ies)

// 		foreach( $recent_posts as $recent ) {

// 			$network_content['site-' . $site_id]['posts'][$recent['guid']] = array(
// 				'ID' => $recent['ID'], // Integer value
// 				'post_title' => $recent['post_title'],
// 				'permalink' => get_permalink( $recent['ID'] ),
// 				'post_content' => $recent['post_content'],
// 				'post_date' => $recent['post_date'],
// 				'post_author' => get_the_author_meta( 'display_name', $recent['post_author'] ),
// 				);

// 			if(wp_get_attachment_url( get_post_thumbnail_id( $recent['ID'] ) )) {
// 				$network_content['site-' . $site_id]['posts'][$recent['guid']]['post_thumbnail'] = wp_get_attachment_url( get_post_thumbnail_id( $recent['ID'] ) ); // Put post_thumbnail into array
// 			} else {
// 				$network_content['site-' . $site_id]['posts'][$recent['guid']]['post_thumbnail'] = ''; // If not thumbnail, empty value instead of false
// 			}
			
// 			// TODO: Get link to author profile

// 			$post_categories = wp_get_post_categories( $recent['ID'] );				
// 			foreach($post_categories as $c){
// 				$cat = get_category( $c );

// 				$network_content['site-' . $site_id]['posts'][$recent['guid']]['post_categories'][$cat->slug] = array(
// 					'term_id' => $cat->term_id, // Put category ID into array
// 					'name' => $cat->name, // Put category name into array
// 					'slug' => $cat->slug, // Put category slug into array
// 					);
// 			}
// 		}

// 	restore_current_blog();
// 	// End switch

// 	// Make array of posts

// 	foreach ($network_content as $site => $site_detail) {
		
// 		foreach ($site_detail['posts'] as $post => $post_detail) {
			
// 			foreach ($post_detail as $key => $value) {

// 				$post_date = $post_detail['post_date'];

// 				$network_posts[$post_date] = array(
// 					'post_id' => $post_detail['ID'],
// 					'post_title' => $post_detail['post_title'],
// 					'post_date' => $post_detail['post_date'],
// 					'post_author' => $post_detail['post_author'],
// 					'post_content' => $post_detail['post_content'],
// 					'permalink' => $post_detail['permalink'],
// 					'post_thumbnail' => $post_detail['post_thumbnail'],
// 				);

// 				foreach ($post_detail['post_categories'] as $cats => $cat_detail) {
					
// 					foreach ($cat_detail as $catkey => $catvalue) {

// 						$network_posts[$post_date]['post_categories'] = array(
// 							'term_id' => $cat_detail['term_id'],
// 							'name' => $cat_detail['name'],
// 							'slug' => $cat_detail['slug'],
// 						);

// 					}
// 				}

// 			}
// 		}

// 	}
	
// }


?>

<?php

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
