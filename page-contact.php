<?php
/**
 * Template Name: Contact page
 *
 * This is the template that displays full width page without sidebar
 *
 * @package activello
 */

get_header(); ?>

	<div id="primary" class="content-area contact-page">
		<h1 class="page-header-title">Contact</h1>

		<main id="main" class="site-main <?php echo "page-".$paged;?>" role="main">				

			<div class="article-container">

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="blog-item-wrap">
						<div class="post-inner-content contact-content">
							<form class="form-horizontal contact-form" role="form" method="post" action="index.php">
								<div class="form-group">
									<div class="col-sm-10 col-sm-push-1">
										<input type="text" class="form-control" id="name" name="name" placeholder="Name" value="">
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-10 col-sm-push-1">
										<input type="email" class="form-control" id="email" name="email" placeholder="Email" value="">
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-10 col-sm-push-1">
										<textarea class="form-control" rows="4" name="message" placeholder="Message"></textarea>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-10 col-sm-offset-1">
										<input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary">
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-10 col-sm-offset-1">
										<! Will be used to display an alert to the user>
									</div>
								</div>
							</form>



				   		</div>
					</div>
				</article>
			</div>						

		</main><!-- #main -->

		<!-- Thank you message modal -->
		<div class="modal fade" id="contact-confirm-modal">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-body">
		      	<h1>Thanks for your message!</h1>
		        <h2>I'll get back to you soon.</h2>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>