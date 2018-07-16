<?php
/*
*
Template Name: Full-Width

*/
get_header(); 
?>

<div class="wrapper">
  <div id="primary" class="no-sidebar content-area">
    <main id="main" class="no-sidebar site-main">

    <?php
    while ( have_posts() ) :
      the_post();

      get_template_part( 'template-parts/content', 'page' );

      // // If comments are open or we have at least one comment, load up the comment template.
      // if ( comments_open() || get_comments_number() ) :
      //   comments_template();
      // endif;

    endwhile; // End of the loop.
    ?>

    </main><!-- #main -->
  </div><!-- #primary -->
</div><!-- .wrapper -->

<?php
get_footer();
