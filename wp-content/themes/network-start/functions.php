<?php
/*
Author: Pea, Glocal
URL: htp://glocal.coop
*/

/************* FUNCTION TO CHECK IF PLUGINS ARE ACTIVE ***************/
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

/************* INCLUDE NEEDED FILES ***************/

/*
1. library/bones.php
	- head cleanup (remove rsd, uri links, junk css, ect)
	- enqueueing scripts & styles
	- theme support functions
	- custom menu output & fallbacks
	- related post function
	- page-navi function
	- removing <p> from around images
	- customizing the post excerpt
	- custom google+ integration
	- adding custom fields to user profiles
*/
require_once( 'library/bones.php' ); // if you remove this, bones will break
/*
2. library/custom-post-type.php
	- an example custom post type
	- example custom taxonomy (like categories)
	- example custom taxonomy (like tags)
*/
// require_once( 'library/custom-post-type.php' ); // you can disable this if you like
/*
3. library/admin.php
	- removing some default WordPress dashboard widgets
	- an example custom dashboard widget
	- adding custom login css
	- changing text in footer of admin
*/
// require_once( 'library/admin.php' ); // this comes turned off by default
/*
4. library/translation/translation.php
	- adding support for other languages
*/
// require_once( 'library/translation/translation.php' ); // this comes turned off by default

require_once( 'library/recent-network-posts.php' ); // Required to display recent posts


/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'bones-thumb-600', 600, 150, true );
add_image_size( 'bones-thumb-300', 300, 100, true );
add_image_size( 'bones-thumb-150', 150, 150, true );
/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image,
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'Primary', 'glocal-network' ),
		'description' => __( 'First (primary) sidebar.', 'glocal-network' ),
		'before_widget' => '<div id="%1$s" class="widget primary %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'id' => 'home-modules',
		'name' => __( 'Homepage Modules', 'glocal-network' ),
		'description' => __( 'Modules for the Homepage', 'glocal-network' ),
		'before_widget' => '<article id="%1$s" class="module row events %2$s">',
		'after_widget' => '</article>',
		'before_title' => '<h2 class="module-heading">',
		'after_title' => '</h2>',
	));

	/*

	To call the sidebar in your template, you can just copy
	the sidebar.php file and rename it to your sidebar's name.
	So using the above example, it would be:
	sidebar-sidebar2.php

	*/
} // don't remove this bracket!

/*********************
MENUS & NAVIGATION
*********************/

// wp menus
add_theme_support( 'menus' );

// registering wp3+ menus
register_nav_menus(
	array(
		'secondary-nav' => __( 'The Secondary Menu', 'glocal-network' ),   // secondary nav in header
		'utility-nav' => __( 'The Utility Menu', 'glocal-network' ),   // utility nav in header
	)
);

// the secondary menu
function bones_secondary_nav() {
	// display the wp3 menu if available
	wp_nav_menu(array(
		'container' => false,                           // remove nav container
		'container_class' => 'menu clearfix',           // class of container (should you choose to use it)
		'menu' => __( 'The Secondary Menu', 'glocal-network' ),  // nav name
		'menu_class' => 'nav second-nav clearfix',         // adding custom nav class
		'theme_location' => 'second-nav',                 // where it's located in the theme
		'before' => '',                                 // before the menu
		'after' => '',                                  // after the menu
		'link_before' => '',                            // before each link
		'link_after' => '',                             // after each link
		'depth' => 0                                  // limit the depth of the nav
	));
} /* end bones secondary nav */

// the utility menu
function bones_utility_nav() {
	// display the wp3 menu if available
	wp_nav_menu(array(
		'container' => false,                           // remove nav container
		'container_class' => 'menu clearfix',           // class of container (should you choose to use it)
		'menu' => __( 'Utility Menu', 'glocal-network' ),  // nav name
		'menu_class' => 'nav utility-nav clearfix',         // adding custom nav class
		'theme_location' => 'utility-nav',                 // where it's located in the theme
		'before' => '',                                 // before the menu
		'after' => '',                                  // after the menu
		'link_before' => '',                            // before each link
		'link_after' => '',                             // after each link
		'depth' => 0                                  // limit the depth of the nav
	));
} /* end bones secondary nav */


/*************************
ADD THEME SUPPORT
*************************/

if ( ! function_exists('glocal_network_theme_features') ) {

// Register Theme Features
function glocal_network_theme_features()  {

	// Add theme support for Post Formats
	$formats = array( 'gallery', 'image', 'video', 'link', 'aside', );
	add_theme_support( 'post-formats', $formats );	

	// Add theme support for Semantic Markup
	$markup = array( 'search-form', );
	add_theme_support( 'html5', $markup );	

	// Add custom header (which may not be used in the header)
	add_theme_support( 'custom-header' );

	// Add theme support for Translation
	load_theme_textdomain( 'glocal-network', get_template_directory() . '/library/language' );	
}

// Hook into the 'after_setup_theme' action
add_action( 'after_setup_theme', 'glocal_network_theme_features' );

}

/**************************************
ENQUEUE AND REGISTER SCRIPTS AND STYLES
***************************************/


function glocal_network_scripts_and_styles() {

	// deregister WP jquery
	wp_deregister_script( 'jquery' );
	wp_deregister_script( 'jquery-ui-draggable' );

	// Hosted jquery
	wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', array(), '', true );

	// Responsive Slider Script
	wp_register_script( 'responsive-slider-script', get_template_directory_uri() . '/library/boxslider/jquery.bxslider.min.js', array(), '', true );

	// Responsive Slider Styles
	wp_register_style( 'responsive-slider-stylesheet', get_template_directory_uri() . '/library/boxslider/jquery.bxslider.css');

	// Isotype Script
	wp_register_script( 'isotope-script', get_template_directory_uri() . '/library/js/isotope.pkgd.min.js', array(), '', true );


   // enqueue styles and scripts
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'responsive-slider-script' );
    wp_enqueue_script( 'isotope-script' );

    wp_enqueue_style( 'responsive-slider-stylesheet' );

}

if ( !is_admin() ) add_action( 'wp_enqueue_scripts', 'glocal_network_scripts_and_styles' );



/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<header class="comment-author vcard">
				<?php
				/*
					this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
					echo get_avatar($comment,$size='32',$default='<path_to_url>' );
				*/
				?>
				<?php // custom gravatar call ?>
				<?php
					// create variable
					$bgauthemail = get_comment_author_email();
				?>
				<img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=32" class="load-gravatar avatar avatar-48 photo" height="32" width="32" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
				<?php // end custom gravatar call ?>
				<?php printf(__( '<cite class="fn">%s</cite>', 'glocal-network' ), get_comment_author_link()) ?>
				<time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'glocal-network' )); ?> </a></time>
				<?php edit_comment_link(__( '(Edit)', 'glocal-network' ),'  ','') ?>
			</header>
			<?php if ($comment->comment_approved == '0') : ?>
				<div class="alert alert-info">
					<p><?php _e( 'Your comment is awaiting moderation.', 'glocal-network' ) ?></p>
				</div>
			<?php endif; ?>
			<section class="comment_content clearfix">
				<?php comment_text() ?>
			</section>
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</article>
	<?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!

/************* SEARCH FORM LAYOUT *****************/

// Search Form
function bones_wpsearch($form) {
	$form = '<form role="search" class="search reveal" method="get" id="searchform" action="' . home_url( '/' ) . '" >
	<label class="screen-reader-text" for="s">' . __( 'Search for:', 'glocal-network' ) . '</label>
	<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . esc_attr__( 'Search', 'glocal-network' ) . '" />
	<button type="submit" id="searchsubmit"></button>
	</form>';
	return $form;
} // don't remove this bracket!


/***************************
THEME CUSTOMIZATION FUNCTION
***************************/

/**
 * NARGA Category Drop Down List Class
 *
 * modified dropdown-pages from wp-includes/class-wp-customize-control.php
 *
 * @since NARGA v1.0
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	class WP_Customize_Dropdown_Categories_Control extends WP_Customize_Control {
	    public $type = 'dropdown-categories';	
	 
	    public function render_content() {
	        $dropdown = wp_dropdown_categories( 
	            array( 
	                'name'             => '_customize-dropdown-categories-' . $this->id,
	                'echo'             => 0,
	                'hide_empty'       => false,
	                'show_option_none' => '&mdash; ' . __('Select', 'glocal-network') . ' &mdash;',
	                'hide_if_empty'    => false,
	                'selected'         => $this->value(),
	            )
	        );
	 
	        $dropdown = str_replace('<select', '<select ' . $this->get_link(), $dropdown );
	 
	        printf( 
	            '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
	            $this->label,
	            $dropdown
	        );
	    }
	}
}

function glocal_network_customize_register( $wp_customize ) {

	if(function_exists('glocal_network_home_category')) {
		$postcategory = glocal_network_home_category();
	}
	// Section
	// Homepage - Post Categories
	$wp_customize->add_section( 'glocal_network_homepage' , array(
	    'title'      => __( 'Homepage', 'glocal-network' ),
	    'priority'   => 30,
	) );

	// Setting
	$wp_customize->add_setting('options_featured_category', array(
        'default'        => '',
        'type'           => 'option',
        'capability'     => 'manage_options',
    ) );

	// Control
    $wp_customize->add_control( new WP_Customize_Dropdown_Categories_Control( $wp_customize, 'glocal_network_featured_category', array( 
        'label'    => __('Homepage Post Category', 'glocal-network'),
        'section'  => 'glocal_network_homepage',
        'type'     => 'dropdown-categories',
        'settings' => 'options_featured_category',
        'priority' => 1,
    ) ) );


	// Homepage Post Heading
    $wp_customize->add_setting('options_post_heading', array(
        'default'        => $postcategory,
        'capability'     => 'manage_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('featured_category_post_heading', array(
        'label'      => __('Homepage Posts Heading', 'glocal-network'),
        'section'    => 'glocal_network_homepage',
        'settings'   => 'options_post_heading',
        'type' => 'text',
    ));
 

	// Look & Feel - To be implemented later


}
add_action( 'customize_register', 'glocal_network_customize_register' );


// Return the category name selected in theme customization
function glocal_network_glocal_network_home_category() {
	$homecategory = get_option("glocal_network_options");
	$homeheading = get_option("post_heading");
	if (!empty($homecategory)) {
	    foreach ($homecategory as $key => $option)
	        $options[$key] = $option;
	    	$categoryname = get_cat_name($option);
	}
	return $categoryname;
	return $homeheading;
}

/************* Add Slug to Body Class *****************/

// Add specific CSS class by filter
add_filter('body_class','glocal_network_class_names');
function glocal_network_class_names($classes) {
	// add 'class-name' to the $classes array
	global $post; 
	$post_slug_class = $post->post_name; 
	$classes[] = $post_slug_class . ' page-' . $post_slug_class;
	// return the $classes array
	return $classes;
}

/************* Custom Excerpt *****************/

function get_excerpt_by_id($post_id, $length='55', $trailer=' ...') {
	$the_post = get_post($post_id); //Gets post ID
	$the_excerpt = $the_post->post_content; //Gets post_content to be used as a basis for the excerpt
	$excerpt_length = $length; //Sets excerpt length by word count
	$the_excerpt = strip_tags(strip_shortcodes($the_excerpt)); //Strips tags and images
	$words = explode(' ', $the_excerpt, $excerpt_length + 1);

	if(count($words) > $excerpt_length) :
		array_pop($words);
		$trailer = '<a href="' . get_permalink($post_id) . '">' . $trailer . '</a>';
		array_push($words, $trailer);
		$the_excerpt = implode(' ', $words);
	endif;
	// $the_excerpt = '<p>' . $the_excerpt . '</p>';
	return $the_excerpt;
}

// Hack to fix title on static homepage
add_filter( 'wp_title', 'glocal_network_hack_wp_title_for_home' );

function glocal_network_hack_wp_title_for_home( $title ) {
  if( empty( $title ) && ( is_home() || is_front_page() ) ) {
    return __( 'Home', 'glocal-network' ) . ' | ';
  }
  return $title;
}

// Remove unused menus
add_action( 'after_setup_theme', 'remove_theme_customization_glocal_network', 20); 

function remove_theme_customization_glocal_network() {

	unregister_nav_menu( 'secondary-nav' );
	unregister_nav_menu( 'utility-nav' );
	unregister_nav_menu( 'footer-links' );

}

/************* Return the header entered in theme customization *****************/

function glocal_network_home_header() {
	$homeheading = get_option("post_heading", "Lastest");
	return $homeheading;
}

/************* Get Global Navigation from Site 1 *****************/

function glocal_network_navigation($mainsite = 1) { //main site id defaulted to 1

	//store the current blog_id being viewed
	global $blog_id;
	$current_blog_id = $blog_id;

	//switch to the main blog which will usually have an id of 1
	switch_to_blog($mainsite);

	//output the WordPress navigation menu
	$glocal_network_nav = bones_main_nav();

	//switch back to the current blog being viewed
	switch_to_blog($current_blog_id);

	return $glocal_network_nav;
}

/************* Get Custom Header Images from Other Sites *****************/

function glocal_network_get_site_image($siteid = 1) {
	//store the current blog_id being viewed
	global $blog_id;
	$current_blog_id = $blog_id;

	//switch to the site for which you want image
	switch_to_blog($siteid);

	$site_image = get_custom_header();

	//switch back to the current blog being viewed
	switch_to_blog($current_blog_id);

	return $site_image->thumbnail_url;
}

/************* Get Recent Posts for All Network Sites *****************/

// TODOs:
	// Add Sorting
	// Add arguments
	// Write function to render posts
	// Write shortcode to display render posts
	// Move to plugin

function network_posts($sortorder = 'date', $postcategory = '') {

	$sites = wp_get_sites(); // TODO: Add argument to exclude main site (site 1)

	foreach ($sites as $site) { // Loop through network sites

		$site_id = $site['blog_id']; // Variable to hold site ID

		$sitedetails = get_blog_details($site_id);
 
		if(function_exists('glocal_network_get_site_image')) { // Function gets network-wide custom headers
			$site_header = glocal_network_get_site_image($site_id);
		}

		$network_content['site-' . $site_id] = array(
			'blog_id' => $site_id,  // Put site ID into array
			'blogname' => $sitedetails->blogname,  // Put site name into array
			'siteurl' => $sitedetails->siteurl,  // Put site URL into array
			'site_header' => $site_header,  // Put site custom header into array
		);
	    
	    // Begin switch
		switch_to_blog( $site_id ); 

			$recent_posts = wp_get_recent_posts(); // TODO: Enable limiting to specific categor(ies)

			foreach( $recent_posts as $recent ) {

				$network_content['site-' . $site_id]['posts'][$recent['guid']] = array(
					'ID' => $recent['ID'], // Integer value
					'post_title' => $recent['post_title'], // Put post title into array
					'permalink' => get_permalink( $recent['ID'] ), // Put post permalink (URL) into array
					'post_content' => $recent['post_content'], // Put post content into array
					'post_date' => $recent['post_date'], // Put post date into array
					'post_author' => get_the_author_meta( 'display_name', $recent['post_author'] ), // Put post author into array
					);

				if(wp_get_attachment_url( get_post_thumbnail_id( $recent['ID'] ) )) {
					$network_content['site-' . $site_id]['posts'][$recent['guid']]['post_thumbnail'] = wp_get_attachment_url( get_post_thumbnail_id( $recent['ID'] ) ); // Put post_thumbnail into array
				} else {
					$network_content['site-' . $site_id]['posts'][$recent['guid']]['post_thumbnail'] = ''; // If not thumbnail, empty value instead of false
				}
				
				// TODO: Get link to author profile

				$post_categories = wp_get_post_categories( $recent['ID'] );

				foreach($post_categories as $c) {
					$cat = get_category( $c );

					$network_content['site-' . $site_id]['posts'][$recent['guid']]['post_categories'][$cat->slug] = array(
						'term_id' => $cat->term_id, // Put category ID into array
						'name' => $cat->name, // Put category name into array
						'slug' => $cat->slug, // Put category slug into array
						);
				}
			}

		restore_current_blog();
		// End switch

		// Make array of posts

		foreach ($network_content as $site => $site_detail) {
			
			foreach ($site_detail['posts'] as $post => $post_detail) {
				
				foreach ($post_detail as $key => $value) { // Loop through posts

					$post_date = $post_detail['post_date'];

					$network_posts[$post_date] = array(
						'post_id' => $post_detail['ID'], // Put post ID into array
						'post_title' => $post_detail['post_title'], // Put post title into array
						'post_date' => $post_detail['post_date'], // Put post date into array
						'post_author' => $post_detail['post_author'], // Put post author into array
						'post_content' => $post_detail['post_content'], // Put post content into array
						'permalink' => $post_detail['permalink'], // Put post permalink (URL) into array
						'post_thumbnail' => $post_detail['post_thumbnail'], // Put post thumbnail into array
						'blog_id' => $site,
						'blogname' => $site_detail['blogname'],
						'siteurl' => $site_detail['siteurl'],
						'site_header' => $site_detail['site_header'],
					);

					foreach ($post_detail['post_categories'] as $cats => $cat_detail) {
						
						foreach ($cat_detail as $catkey => $catvalue) { // Loop through post categories

							$network_posts[$post_date]['post_categories'][$cat_detail['term_id']] = array(
								'term_id' => $cat_detail['term_id'], // Put post category ID into array
								'name' => $cat_detail['name'], // Put post category name into array
								'slug' => $cat_detail['slug'], // Put post category slud into array
							);

						}
					}

				}
			}

		}
		
	}

	if($sortorder == 'date') {
		arsort($network_posts);
	}
	
	return $network_posts;
	// return $network_content;

}

/************* Render Recent Posts for All Network Sites *****************/

function display_network_posts() {

	$network_posts = network_posts();

	foreach($network_posts as $post) {
		$post_id = $post['post_id'];
		$post_title = $post['post_title'];
		$post_author = $post['post_author'];
		$post_content = $post['post_content'];
		$blog_id = $post['blog_id'];
		$blogname = $post['blogname'];
		$siteurl = $post['siteurl'];
		$site_header = $post['site_header'];
		$site_details = "<a href='" . $siteurl . "'>" . $blogname . "</a>";
		$post_excerpt = get_excerpt_by_id($post_id);

		echo '<article id="site-id-post-id" class="site-id-post-id post" role="article">';
		echo '	<header class="post-header" role="header">';
		echo '		<h2 class="post-title" itemprop="headline">' . $post['post_title'] . '</h2>';
		echo '		<div class="post-meta post-author">' . $post['post_author'] . '</div>';
		echo '	</header>';
		echo '	<div class="post-content" itemprop="articleBody">' . $post_excerpt . '</div>';
		echo '	<footer class="post-footer">';
		echo '		<div class="post-meta post-date"><time>' . date_i18n( get_option( 'date_format' ), $post['post_date'] ) . '</time></div>';
		echo '		<div class="post-meta post-tags">';

		foreach ($post['post_categories'] as $cats => $cat_detail) {

			foreach ($cat_detail as $catkey => $catvalue) {

				echo $cat_detail['term_id'];

			}

			// echo '<pre>';
			// var_dump($post['post_categories']);
			// echo '</pre>';

		}


		echo '      </div>';
		echo '	</footer>';
		echo '</article>';

	}

}

?>
