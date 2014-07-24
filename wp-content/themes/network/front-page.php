<?php
// Template: Front Page

// This template makes heavy use of the Events Manager and Options Framework plugins and the recent-network-posts function (included in with this theme in recent-network-posts.php).
// Without Events Manager, the events module (module 3) will not appear.
// Without the recent-network-posts function, the network-wide posts (module 1 and module 2) will not appear

?>

<?php get_header(); ?>

<div id="content">

	<div id="inner-content">

		<section class="home-start">
		
			<article class="home-intro">
				<!-- Displays any content entered in the page used as the front page -->
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile; endif; ?>
			</article>
			

		</section>

		<section class="home-modules">

			<?php if ( is_multisite() ) { // Check to see if multisite is active. If not, display a recent posts and events module for this site. ?> 

			<?php $sites = wp_get_sites('offset=1'); // Set up variable that holds array of sites ?>

			<script type="text/javascript">
			jQuery(document).ready(function(){
			  jQuery('.news-list').bxSlider({
                slideWidth: 5000,
			    minSlides: 2,
			    maxSlides: 2,
			    slideMargin: 10,
			    pager: false
			  });
              var responsive_viewport = jQuery(window).width();
              if (responsive_viewport < 320) {
                  jQuery('.news-list').reloadSlider({
				    slideWidth: 5000,
				    minSlides: 1,
				    maxSlides: 1,
				    slideMargin: 10,
				    pager: false
                  });
              } 
			});
			</script>

			<?php 
			// Get the category from theme customization 
			$featuredcategory = get_cat_name(get_option("featured_category")); 
			$categoryid = get_option("featured_category");
			
			// If a category is selected, get the slug
			if(!empty($featuredcategory)) {
				$categoryslug = get_category( $categoryid );
				$featuredcatslug = '/' . $categoryslug->slug . '/';
			}

			// Get the header text from theme customization 
			$heading = get_option("post_heading"); 
			if(!empty($heading)) {
				$postheading = $heading;
			} elseif(!empty($featuredcategory)) {
				$postheading = $featuredcategory;
			}
			else {
				$postheading = 'Latest'; // Fallback header text. Change to whatever you'd like.
			}

			?>

			<?php
			if(function_exists( 'network_latest_posts' )) {

				$parameters = array(
				'title'         => $postheading,
				'title_link'    => '/news/', 
				'title_only'    => 'false',
				'auto_excerpt'  => 'true',
				'full_meta'		=> 'true',
				'category'         => $featuredcategory,
				'number_posts'     => 2,
				'wrapper_list_css' => 'news-list',
				'wrapper_block_css'=> 'module row news', //The wrapper class
				'instance'         => 'news-module', //The wrapper ID
				);
				// Execute
				$recent_posts = network_latest_posts($parameters);
			}
			?>

			<?php dynamic_sidebar( 'home-modules' ); ?>

			<script type="text/javascript">
			jQuery(document).ready(function(){
			  jQuery('.events-list').bxSlider({
                slideWidth: 5000,
			    minSlides: 4,
			    maxSlides: 4,
			    slideMargin: 10,
			    pager: false
			  });
              var responsive_viewport = jQuery(window).width();
              if (responsive_viewport < 320) {
                  jQuery('.events-list').reloadSlider({
				    slideWidth: 5000,
				    minSlides: 1,
				    maxSlides: 1,
				    slideMargin: 10,
				    pager: false
                  });
              } 
			});
			</script>

			<?php // Check to see if Events Manager is active. If not don't display this module.
			if ( is_plugin_active('events-manager/events-manager.php') ) { ?>
			<article id="events-module" class="module row events">
				<h2 class="module-heading"><a href="/events/">Events</a></h2>
				<ul class="events-list">
					<?php
					$events = EM_Events::output(array('limit'=>5, 
						'format'=>'<li>
						<h6 class="event-start">
    				        <time class="event-month" datetime="#M">#M</time>
    				        <time class="event-date" datetime="#j">#j</time>
    				        <time class="event-day" datetime="#D">#D</time>
    					</h6>
						<h3 class="post-title event-title">#_EVENTLINK</h3>
						</li>'));?>
					<?php echo $events; ?>
				</ul>
			</article>
			<?php } ?>
			<article id="sites-module" class="module row sites">
				<h2 class="module-heading"><a href="/sites/">Sites</a></h2>
				<ul class="sites-list">

				<?php
				foreach ($sites as $site) {
					$site_id = $site['blog_id'];
					$site_details = get_blog_details($site_id);

					if(function_exists('community_get_site_image')) {
						$header = community_get_site_image($site_id);
					} 
					?>
				
					<li id="site-<?php echo $site_id; ?>">
					    <a href="<?php echo $site_details->path; ?>" title="<?php echo $site_details->blogname; ?>" class="item-image <?php if(!$header) { echo 'no-image'; } ?>" style="background-image: url('<?php if($header) { echo $header; } ?>');"></a>
						<h3 class="item-title"><a href="<?php echo $site_details->path; ?>" title="<?php echo $site_details->blogname; ?>"><?php echo $site_details->blogname; ?></a></h3>
						<h6 class="meta item-modified"><span class="modified-title">Last updated</span> <time><?php echo date_i18n(get_option('date_format') ,strtotime($site_details->last_updated));?></time></h6>
					</li>
				
                <?php } ?>

					<li id="site-promo">
						<h3 class="post-title">Join the community</h3>
						<div class="promo-icons"><i></i><i></i><i></i><i></i></div>
						<a class="button" href="<?php echo wp_registration_url(); ?>" title="Create a site">Create a Site</a>
					</li>

				</ul>
			</article>
			

			<?php } else { // If multisite isn't enabled, show a recent posts module for the site ?>

			<article id="news-module" class="module row news">
				<h2 class="module-heading"><a href="/news/">News</a></h2>
				<ul class="news-list">
					<?php 
					// WP_Query arguments
					$recentargs = array (
						'post_type'              => 'post',
						'ignore_sticky_posts'    => false,
					);

					// The Query
					$recentposts = new WP_Query($recentargs);
					?>
					<?php while ($recentposts->have_posts()) : $recentposts->the_post(); ?>
					<li>
						<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<p class="post-excerpt"><?php the_excerpt(); ?>
						<span class="meta post-date"><?php the_date(); ?><?php// echo date_i18n(get_option('date_format'),strtotime($date));?></span></p>
					</li>
					<?php endwhile; ?>
				</ul>
			</article>
			<?php // Check to see if Events Manager is active. If not don't display this module.
			if ( is_plugin_active('events-manager/events-manager.php') ) { ?>
			<article id="events-module" class="module row events">
				<h2 class="module-heading"><a href="/events/">Events</a></h2>
				<ul class="events-list">
					<?php
					$events = EM_Events::output(array('limit'=>5, 
						'format'=>'<li>
						<h6 class="event-start">
    				        <time class="event-month" datetime="#M">#M</time>
    				        <time class="event-date" datetime="#j">#j</time>
    				        <time class="event-day" datetime="#D">#D</time>
    					</h6>
						<h3 class="post-title event-title">#_EVENTLINK</h3>
						</li>'));?>
					<?php echo $events; ?>
				</ul>
			</article>
			<?php } ?>


			<?php } ?>

			<?php
			

			// $posts = get_posts('post_type=post');
			// echo "<pre>";
			// var_dump($news);
			// echo "</pre>";

			?>
		</section>

	</div>

</div>

<?php get_footer(); ?>