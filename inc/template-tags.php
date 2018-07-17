<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package cerella
 */

if ( ! function_exists( 'cerella_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function cerella_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( '%s', 'post date', 'cerella' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . '<i class="far fa-clock"></i>' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'cerella_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function cerella_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( '%s', 'post author', 'cerella' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . '<i class="fas fa-pen-fancy"></i> ' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'cerella_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function cerella_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */

			if (! is_single( )) {	
				$categories_list = get_the_category_list( esc_html__( ', ', 'cerella' ) );
				if ( $categories_list ) {
					/* translators: 1: list of categories. */
					printf( '<span class="cat-links">' . '<i class="far fa-folder-open"></i>' . esc_html__( ' %1$s', 'cerella' ) . '</span>', $categories_list ); // WPCS: XSS OK.
				}
			}
				
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ' ', 'list item separator', 'cerella' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . '<i class="fas fa-tags"></i> '. esc_html__( '%1$s', 'cerella' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( '<span class="screen-reader-text"> on %s</span>', 'cerella' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'cerella' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'cerella_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function cerella_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
			the_post_thumbnail( 'post-thumbnail', array(
				'alt'  => the_title_attribute( array(
				'echo' => false,
				) ),
			) );
			?>
			<div class="thumbnail-link__overlay">
				<span class="thumbnail-link__text">Read More <i class="fas fa-link"></i></span>	
			</div>
		</a>
		
		<?php
		endif; // End is_singular().
	}
endif;


// ceralla categories for displaying categories in single post view
if ( ! function_exists( 'cerella_post_categories' ) ) :
	/**
	 * Prints HTML with meta information for the current categories.
	 */
	function cerella_post_categories() {
		$categories_list = get_the_category_list( esc_html__( '|', 'cerella' ) );
				if ( $categories_list ) {
					/* translators: 1: list of categories. */
					printf( '<span class="cat-links">' . '<i class="far fa-folder-open"></i>' . esc_html__( ' %1$s', 'cerella' ) . '</span>', $categories_list ); // WPCS: XSS OK.
				}
	}
endif;


// ceralla categories for displaying categories in single post view
if ( ! function_exists( 'cerella_related_posts' ) ) :
	/**
	 * Prints HTML posts in the same category as current post..
	 */
	function cerella_related_posts() {
		$mainPostCategory = get_the_category( );
		$mainPostCategoryID = $mainPostCategory[0] -> cat_ID;
			
		$the_query = new WP_Query( array(
			'posts_per_page' => 4,
			'ignore_sticky_posts' => true,
			'cat' => $mainPostCategoryID,
			'post__not_in' => array(get_the_ID()), 
		)); ?>
	
		<section class="related-posts">
			<h3 class="related-posts__title">Related Posts</h3>
			<ul class="related-posts__list">
				<?php 
				while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					
					<li class="related-posts__item">
					
					
							<?php cerella_post_thumbnail(); ?>
					
						<div class="related-posts__content-wrapper">

							<header class="related-posts__item-header">
								<h3 class="related-posts__item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							</header>

							<footer class="related-posts__item-footer">
									<?php 
										cerella_posted_on();
										cerella_posted_by();
										?>
							</footer>

						</div>

					</li>

				<?php endwhile; 
				wp_reset_postdata(); 
				
				?>
			
			</ul> <!-- .related-posts__list -->
		</section> <!-- .related-posts -->

	<? 
	}
endif;