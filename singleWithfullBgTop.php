<?php
/*
* Template Name: Post with thumbnail Bg
* Template Post Type: post
 */
get_header(); 

while ( have_posts() ) :
  the_post();
?>

  <div class="full-size-thumbnail__holder"><img class="full-size-thumbnail__image" src="<?php the_post_thumbnail_url() ?>" alt="article featured image"></div>
<div class="wrapper">
	<div id="primary" class="content-area">
		<main id="main" class="site-main site-main--single">

		<?php
			get_template_part( 'template-parts/content-no-thumbnail', get_post_type() );

			the_post_navigation(array(
				'prev_text'   => '<span>Previous:</span> %title',
				'next_text'   => '<span>Next:</span> %title'
			));

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;


			endwhile;

      cerella_related_posts() ?>
				
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();?>
</div><!-- .wrapper -->
<?php
get_footer();