<?php
/**
 * Template Name: Photos page
 *
 * This is the template that displays full width page without sidebar
 *
 * @package activello
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<h1 class="page-header-title">Photos</h1>

		<?php if ( function_exists('yoast_breadcrumb') ) {
		  yoast_breadcrumb('<p id="breadcrumbs">','</p>');
		} ?>

        <?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>

		<main id="main" class="site-main <?php echo "page-".$paged;?>" role="main">				

			<div class="article-container">
				<?php

					$args = array(
					    'posts_per_page' => 2,
					    'order' => 'DESC',
					     'post_type' => 'photos' 
					);

					$pp = new WP_Query( $args );

					if($pp->have_posts()) :
					    while($pp->have_posts()) : $pp->the_post();
					?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="blog-item-wrap">
							<div class="post-inner-content">
								<header class="entry-header page-header">
									<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

									<?php if ( 'photos' == get_post_type() ) : ?>
									<div class="entry-meta">
										<?php activello_posted_on(); ?>

										<?php
											edit_post_link(
												sprintf(
													/* translators: %s: Name of current post */
													esc_html__( 'Edit %s', 'activello' ),
													the_title( '<span class="screen-reader-text">"', '"</span>', false )
												),
												'<span class="edit-link">',
												'</span>'
											);
										?>

									</div><!-- .entry-meta -->
									<?php endif; ?>
								</header><!-- .entry-header -->
								<?php 
							       if ( has_post_thumbnail() ) {  // check if the post has a Post Thumbnail assigned to it.
							    ?>
							       	<a href="<?php echo get_permalink() ?>">
							       	<?php
							          the_post_thumbnail(); //display the thumbnail
							        ?>
							    	</a>

							    <?php } ?>
							    <?php
							       the_excerpt(); // displays the excerpt

						       ?>

								<div class="read-more">
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php esc_html_e( 'See Photos', 'activello' ); ?></a>
								</div>		

					   		</div>
						</div>

				<?php
					endwhile;
					    wp_reset_postdata(); // always always remember to reset postdata when using a custom query, very important
					else:
				?>

					<h2>I haven't posted any photo albums yet. Sorry about that!</h2>
					<p><a href="/">Back to the home page</a>.</p>

				<?php
					endif;
				?>
			</div>						

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>