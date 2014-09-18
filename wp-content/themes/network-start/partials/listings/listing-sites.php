<?php if(is_page('home')) { ?>

	<article id="sites-module" class="module row sites">

		<h2 class="module-heading"><a href="/directory">Sites</a></h2>

		<ul class="sites-list">
			
			<?php get_template_part( 'partials/queries/query', 'sites' ); ?>

			<li id="promo-directory" class="directory-promo">
				<a title="Directory" href="/directory">
					<h3 class="post-title">Join the community</h3>
					<div class="promo-icons">
						<i class="icon"></i>
						<i class="icon"></i>
						<i class="icon"></i>
						<i class="icon"></i>
					</div>
				</a>
			</li>

		</ul>

	</article>

<?php } else { ?>

	<article role="article" class="<?php echo get_post_type( get_the_ID() ); ?>" id="<?php echo get_post_type( get_the_ID() ); ?>-<?php the_ID(); ?>" itemscope itemtype="http://schema.org/BlogPosting">

		<header class="<?php echo get_post_type( get_the_ID() ); ?>-header">

			<h1 class="<?php echo get_post_type( get_the_ID() ); ?>-title" itemprop="headline"><?php the_title(); ?></h1>

			<ul class="sort js-menu">
				<li data-sort="id" class="is-on">Most Recently Added</li>
				<li data-sort="slug">Alphabetically</li>
				<li data-sort="posts">Most Active</li>
			</ul>

			<ul class="toggle js-menu">
				<li data-view="masonry" class="view-grid is-on">Grid</li>
				<li data-view="vertical" class="view-list">List</li>
			</ul>

		</header>

		<section class="entry-content" itemprop="articleBody" rel="main">

			<ul class="sites-list view-grid" id="isotope">
				
				<?php get_template_part( 'partials/queries/query', 'sites' ); ?>

			</ul>
			
		</section>

		<section class="promo-directory">

		    <h4 class="subtitle">Join the directory</h4>
			<a class="button" href="/register" title="Register">Register</a>

		</section>

	</article>

<?php } ?>
