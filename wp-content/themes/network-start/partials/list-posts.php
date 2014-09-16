<li>
	<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	<p class="post-excerpt"><?php the_excerpt(); ?>
	<span class="meta post-date"><?php the_date(); ?><?php// echo date_i18n(get_option('date_format'),strtotime($date));?></span></p>
</li>