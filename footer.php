<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package cerella
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="site-footer__wrapper wrapper">
			<div class="site-footer__info">
				<h3 class="site-footer__site-title"><?php bloginfo(); ?></h3>
				<p class="site-footer__site-desc"><?php bloginfo('description'); ?></p>
			</div><!--.site-footer__info -->
			
			<div class="footer-recent-posts">
				<h3 class="footer-recent-posts__title footer-section-title">Recent Posts</h3>
					<?php 
			
						$the_query = new WP_Query( array(
								'posts_per_page' => 4,
						)); 
					?>

				<?php if ( $the_query->have_posts() ) : ?>
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<h4 class="footer-recent-posts__post-title"><a href="	<?php the_permalink(); ?>"><?php 
					if( strlen(get_the_title()) > 35) {
						echo substr(get_the_title(),0,35) . '...';
					} else {
						the_title();
					}
					?></a></h4>
			
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>

					<?php else : ?>
						<p><?php __('No News'); ?></p>
					<?php endif; ?>
			</div><!--.footer-recent-posts -->
			<div class="footer-menu__wrapper">
				<h3 class="footer-section-title">Useful Links</h3>
				<nav id="footer-navigation" class="footer-menu useful-links">
							<?php
							wp_nav_menu( array(
								'theme_location' => 'menu-2',
								'menu_id'        => 'footer-menu',
								) );
								?>
					</nav><!-- #footer-navigation -->
			</div><!-- .footer-menu-wrapper -->
				
			<div class="footer-search">
				<h3 class="footer-section-title">Search</h3>
					<?php echo get_search_form() ?>
			</div> <!--.footer-search -->
		</div><!--.site-footer__wrapper-->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
