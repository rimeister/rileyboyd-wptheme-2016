<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package activello
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<h1 class="page-header-title">Blog</h1>
        
        <?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>

		<main id="main" class="site-main <?php echo "page-".$paged;?>" role="main">

		<?php if ( have_posts() ) : ?>

			<div class="article-container">
			
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', '' ); ?>

			<?php endwhile; ?>
			
			</div>
			
			<div class="pagination-wrapper">

				<?php 

					the_posts_pagination(
						array(
							'mid_size' => '2',
							'prev_text' => '<i class="fa fa-long-arrow-left" aria-hidden="true"></i>&nbsp;Previous',
							'next_text' => 'Next&nbsp;<i class="fa fa-long-arrow-right" aria-hidden="true"></i>',
							'screen_reader_text' => 'Numbered Pagination'
						)
					); 

				?>

			</div>

		<?php else : ?>

			<h2>I haven't written any blog posts yet.</h2>
			<p><a href="/">Back to the home page</a>.</p>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>