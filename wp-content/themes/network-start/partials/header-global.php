<header class="header-global">

	<div class="inner-header">
		
		<?php  // Get the site info for the main site
		$blog_details = get_blog_details(1);
		?>

		<p class="domain-title"><a href="<?php echo $blog_details->siteurl; ?>" rel="nofollow"><?php echo $blog_details->blogname; ?></a></p>


		<nav role="navigation" class="nav-global">
			<ul class="nav-anchors js-anchors">
            	<li><a href="#menu-main-navigation" class="anchor-menu" title="menu"><?php echo $blog_details->blogname; ?></a></li>
            	<li><a href="#search-global" class="anchor-search" title="search"></a></li>
            </ul>
			<div class="search-form" id="search-global">
			    <?php get_search_form(); ?>
			</div>
			<?php
			// Network-wide navigation
			if(function_exists('glocal_network_navigation')) {
				$global_nav = glocal_network_navigation();
				echo $global_nav;
			}
			?>
		</nav>

	</div>

</header>