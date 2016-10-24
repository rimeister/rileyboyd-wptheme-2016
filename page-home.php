<?php
/**
 * Template Name: Home page
 *
 * This is the template that displays full width page without sidebar
 *
 * @package activello
 */

get_header(); ?>

	<div id="primary" class="content-area">
        <?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>

		<main id="main" class="site-main <?php echo "page-".$paged;?>" role="main">

		<?php
			$args = array(
			    'posts_per_page' => 3,
			    'order' => 'DESC'
			);

			$rp = new WP_Query( $args );

			if($rp->have_posts()) :
		?>

			<div class="article-container">
				<h3>Latest Blog Posts</h3>
				<?php
				    while($rp->have_posts()) : $rp->the_post();
				?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="blog-item-wrap">
							<div class="post-inner-content">
								<header class="entry-header page-header">
									<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

									<?php if ( 'post' == get_post_type() ) : ?>
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
					            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >

					                    <?php 

					                    $cinemagraphMp4 = get_field('cinemagraph_mp4');
					                    $cinemagraphOgg = get_field('cinemagraph_ogg');

					                    if ( isset($cinemagraphMp4) || isset($cinemagraphOgg) ) {

											echo '<video width="1170" height="500" autoplay loop class="featured-cinemagraph">';

											if ( isset($cinemagraphMp4) ) {
												echo '<source src="' . $cinemagraphMp4 . '" type="video/mp4">';
											}

											if ( isset($cinemagraphOgg) ) {
												echo  '<source src="' . $cinemagraphOgg . '" type="video/mp4">';							
											}

											echo '</video>';                    
										} else {
					                    	the_post_thumbnail( 'activello-featured', array( 'class' => 'single-featured' )); 
					                    }

					                    ?>
					            </a>

							    <?php } ?>
							    <?php
							       the_excerpt(); // displays the excerpt
						       ?>

								<div class="read-more">
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php esc_html_e( 'Read More', 'activello' ); ?></a>
								</div>		

					   		</div>
						</div>

				<?php
					endwhile;
				?>
			</div>			

			<div class="go-to-blog-wrapper">
				<a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" class="go-to-blog"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> Go To Blog</a>
			</div>

			<?php
				wp_reset_postdata(); // always always remember to reset postdata when using a custom query, very important
				endif;			
			?>			

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>