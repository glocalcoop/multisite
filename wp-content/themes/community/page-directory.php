<?php get_header(); ?>

<div id="content">

	<div id="inner-content">

		<div id="main">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> itemscope itemtype="http://schema.org/BlogPosting">

				<header class="article-header">

					<ul class="toggle js-menu">
						<li data-view="masonry" class="view-grid is-on">Grid</li>
						<li data-view="vertical" class="view-list">List</li>
					</ul>

					<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>

				</header>

				<section class="entry-content" itemprop="articleBody" rel="main">

				    <h4 class="subtitle">Sites</h4>

					<ul class="sites-list view-grid" id="isotope">
						<?php
						$sites = wp_get_sites('offset=1');

						foreach ($sites as $site) {
							$site_id = $site['blog_id'];
							$site_details = get_blog_details($site_id);
							$site_options = get_blog_option($site_id, 'theme_mods_community-group');
							$site_image = $site_options['community_site_image'];
							$site_path = $site_details->path;
							$site_slug = str_replace('/','',$site_path);

							// Find Network pages that are associated with this site
							$args = array (
								'post_type'         => 'network',
								'meta_query'        => array(
									array(
										'key'       => 'community_network_sites',
										'value'     => $site_id,
										'compare'   => '=',
									),
								),
							);
							$network_query = new WP_Query( $args );
							
							?>
							<?php
							if(function_exists('community_get_site_image')) {
								$header = community_get_site_image($site_id);
							} ?>

							<li class="isomote id-<?php echo $site_id; ?> site-<?php echo $site_slug; ?> network-<?php foreach($network_query as $post){ echo $post->post_name;} ?>  ">
								<a href="<?php echo $site_details->siteurl; ?>" class="item-image <?php if(!$header) { echo 'no-image'; } ?>" style="background-image: url('<?php if($header) { echo $header; } ?>');"></a>
								<h3 class="item-title"><a href="<?php echo $site_details->siteurl; ?>"><?php echo $site_details->blogname; ?></a></h3>
								<h6 class="meta item-network"><?php foreach($network_query as $post){ echo $post->post_title;} ?></h6>
								<h6 class="meta item-location"></h6>
								<h6 class="meta item-topic"></h6>
							</li>

						<?php } ?>

					</ul>
					
				</section>

				<section class="promo-directory">

				    <h4 class="subtitle">Join the directory</h4>
					<a class="button" href="/register" title="Register">Register</a>

				</section>

				<?php comments_template(); ?>

			</article>


			<?php endwhile; else : ?>

					<article id="post-not-found" class="hentry clearfix">
						<header class="article-header">
							<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
						</header>
						<section class="entry-content">
							<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
						</section>
						<footer class="article-footer">
                            <p><?php _e( 'This is the error message in the page.php template.', 'bonestheme' ); ?></p>
						</footer>
					</article>

			<?php endif; ?>

		</div>

			

	</div>

</div>

<script>
$(document).ready(function() {

  var $container = $('#isotope');
  
  // init Isotope
  $container.isotope({
    itemSelector: '.isomote',
    layoutMode: 'masonry',
    masonry: {columnWidth: 285, gutter: 20}
  });

  // filter
  $('.filter').on( 'click', 'li', function() {
    var filterValue = $(this).attr('data-filter');
    $container.isotope({ filter: filterValue });
  });

  // change view
  $('.toggle').on('click', 'li', function() {
    if ($(this).hasClass('view-grid')) {
        $('#isotope').removeClass('view-list').addClass('view-grid');
    }
    else if($(this).hasClass('view-list')) {
        $('#isotope').removeClass('view-grid').addClass('view-list');
    }
    var viewValue = $(this).attr('data-view');
    $container.isotope({ layoutMode: viewValue });
  });

  // change is-on class
  $('.js-menu').each(function(i, focus) {
    var $focus = $(focus);
    $focus.on('click', 'li', function() {
      $focus.find('.is-on').removeClass('is-on');
      $(this).addClass('is-on');
    });
  });


});

</script>




<?php get_footer(); ?>