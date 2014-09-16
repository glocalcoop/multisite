<?php
	if(is_page('home')) { ?>

	<li id="site-<?php echo $site_id; ?>">
	    <a href="<?php echo $site_details->path; ?>" title="<?php echo $site_details->blogname; ?>" class="item-image <?php if(!$header) { echo 'no-image'; } ?>" style="background-image: url('<?php if($header) { echo $header; } ?>');"></a>
		<h3 class="item-title"><a href="<?php echo $site_details->path; ?>" title="<?php echo $site_details->blogname; ?>"><?php echo $site_details->blogname; ?></a></h3>
		<h6 class="meta item-modified"><span class="modified-title">Last updated</span> <time><?php echo date_i18n(get_option('date_format') ,strtotime($site_details->last_updated));?></time></h6>
	</li>

	<?php } else { ?>

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

	<?php }
?>