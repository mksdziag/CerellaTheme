<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cerella
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-on-index'); ?>>
<?php cerella_post_thumbnail(); ?>
  <div class="entry-wrapper">
		<header class="entry-header">
			<?php
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				endif; ?>

			
		</header><!-- .entry-header -->


		<div class="entry-content">
			<?php
				if(is_home()){
					the_excerpt(); ?>
					<div class="entry-read-more">
						<a href="<?php the_permalink(); ?>" class="btn btn--outline">Read More</a>
						<a href="<?php the_permalink(); ?>" class="btn btn--outline" target="_blank" ><i class="fas fa-external-link-alt"></i></a>
					</div>

				<?php
				} else {
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'cerella' ),
					array(
						'span' => array(
							'class' => array(),
						),
						)
					),
					get_the_title()
			) );
		}
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cerella' ),
				'after'  => '</div>',
			) );
			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer"> <?php
		if ( 'post' === get_post_type() ) :
			?>
				<div class="entry-meta">
					<?php
					cerella_posted_on();
					cerella_posted_by();
					?>
				</div><!-- .entry-meta -->
			<?php endif; ?>
			<?php cerella_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</div> <!-- .entry-wrapper -->
</article><!-- #post-<?php the_ID(); ?> -->
