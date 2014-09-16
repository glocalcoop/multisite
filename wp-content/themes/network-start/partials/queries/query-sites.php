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
	if(function_exists('glocal_network_get_site_image')) {
		$header = glocal_network_get_site_image($site_id);
	} ?>
	
	<li class="isomote id-<?php echo $site_id; ?> site-<?php echo $site_slug; ?> network-<?php foreach($network_query as $post){ echo $post->post_name;} ?>" data-id="<?php echo $site_id ?>" data-slug="<?php echo $site_slug ?>" data-posts="<?php echo $site_details->post_count; ?>">
		<a href="<?php echo $site_details->siteurl; ?>" class="item-image <?php if(!$header) { echo 'no-image'; } ?>" style="background-image: url('<?php if($header) { echo $header; } ?>');"></a>
		<h3 class="item-title"><a href="<?php echo $site_details->siteurl; ?>"><?php echo $site_details->blogname; ?></a></h3>
		<h6 class="meta item-network"><?php foreach($network_query as $post){ echo $post->post_title;} ?></h6>
		<h6 class="meta item-posts">
		<?php
			if($site_details->post_count) {
				echo $site_details->post_count . ' posts';
			}
		?>
		</h6>
		<h6 class="meta item-topic"></h6>
	</li>

<?php } ?>