<div class="main-promo">
  <div class="main-promo__inner wrapper">

  <?php 
    $the_query = new WP_Query( array(
        'posts_per_page' => 1,
        'ignore_sticky_posts' => true
    )); 
    
    if ( $the_query->have_posts() ) :
    while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

    <div class="main-promo__primary-item">
      
      <div class="main-promo__item-thumbnail">
        <?php cerella_post_thumbnail(); ?>
        <footer class="main-promo__item-footer">
          <?php 
            cerella_posted_on();
            cerella_posted_by();
            ?>
        </footer>
      </div>
      <header class="main-promo__primary-item-header">
        <h3 class="main-promo__primary-item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
      </header>

      <div class="main-promo__primary-item-excerpt">
        <?php the_excerpt(); ?>
      </div>



      <?php endwhile; 
      wp_reset_postdata(); 
      
      else : ?>
        <p><?php __('No posts yet..:('); ?></p>
        <?php endif; ?>
        
    </div> <!-- .main-promo__primary-item -->

  
    <div class="main-promo__secondary-items">

      <?php 
        $the_secondary_query = new WP_Query( array(
          'posts_per_page'      => 2,
          'ignore_sticky_posts' => true,
          'offset'              => 1,
        )); 
        
        if ( $the_secondary_query->have_posts() ) :
          while ( $the_secondary_query->have_posts() ) : $the_secondary_query->the_post(); ?>

      <div class="main-promo__secondary-item">
        
        <div class="main-promo__item-thumbnail">
          <?php cerella_post_thumbnail(); ?>
          <footer class="main-promo__item-footer">
            <?php 
              cerella_posted_on();
              cerella_posted_by(); ?>
          </footer>
        </div>

          
        <header class="main-promo__secondary-item-header">
          <h3 class="main-promo__secondary-item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        </header>
        
        
      </div><!--main-promo__secondary-item -->

      <?php 
      endwhile; 
      wp_reset_postdata(); 
      
      else : ?>
        <p><?php __('No posts yet..:'); ?></p>
      <?php 
      endif; ?>

    </div> <!--main-promo__secondary-items -->
  </div> <!-- .wrapper -->
</div> <!-- .main-promo -->