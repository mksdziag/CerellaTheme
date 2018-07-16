<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cerella
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php
			cerella_posted_on();
			cerella_posted_by();
			?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php cerella_post_thumbnail(); ?>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
		<div class="read-more-wrapper">
			<a href="<?php the_permalink(); ?>" class="btn btn--outline">Read More</a>
			<a href="<?php the_permalink(); ?>" class="btn btn--outline" target="_blank" ><i class="fas fa-external-link-alt"></i></a>
		</div>
	</div><!-- .entry-summary -->

	<!-- <footer class="entry-footer">
		<?php cerella_entry_footer(); ?>
	</footer>.entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
