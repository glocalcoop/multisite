				</div>
				
			</main>

			<footer class="footer" role="contentinfo">

				<div class="inner-footer">

					<section class="global site-meta first">
						<h2 class="footer-logo"><a class="logo-main" href="<?php echo home_url(); ?>"><img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="<?php bloginfo('name'); ?>" class="logo-main" /><span class="tagline-NYCP"><?php bloginfo('description'); ?></span></a></h2>
					</section>
					
					<section class="widgets">
						<?php if ( is_active_sidebar( 'footer1' ) ) : ?>
							<?php dynamic_sidebar( 'footer1' ); ?>
						<?php endif; ?>
						<?php if ( is_active_sidebar( 'footer2' ) ) : ?>
							<?php dynamic_sidebar( 'footer2' ); ?>
						<?php endif; ?>
						<?php if ( is_active_sidebar( 'footer3' ) ) : ?>
							<?php dynamic_sidebar( 'footer3' ); ?>
						<?php endif; ?>
						<?php if ( is_active_sidebar( 'footer4' ) ) : ?>
							<?php dynamic_sidebar( 'footer4' ); ?>
						<?php endif; ?>
					</section>					

    				<nav class="footer-nav" role="navigation clearfix">
    					<?php bones_footer_links(); ?>
    				</nav>
   
    
				</div>
				
			</footer>


			<footer class="footer-slug">
			
			    <div class="inner-footer">
				    <h6 class="copyright">Copyleft <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?></h6>
			    </div>
			    
			</footer>


		</div> <!-- end #container -->

		<?php wp_footer(); ?>

	</body>

</html>
