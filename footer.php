<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package activello
 */
?>
				</div><!-- close .*-inner (main-content or sidebar, depending if sidebar is used) -->
			</div><!-- close .row -->
		</div><!-- close .container -->
	</div><!-- close .site-content -->

		</div>
	</div>

	<div id="footer-area">
		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="site-info">
					<?php if( !get_theme_mod('footer_social') ) activello_social_icons(); ?>
						<p>All content is &copy; 2016 Riley Boyd, except where otherwise noted.</p>
			</div><!-- .site-info -->
			<div class="scroll-to-top"><i class="fa fa-angle-up"></i></div><!-- .scroll-to-top -->
		</footer><!-- #colophon -->
	</div>
</div><!-- #page -->

<!-- JS Plugins -->
<script type="text/javascript" src="<?php echo get_template_directory_uri()?>/dev/js/jquery-2.2.4.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri()?>/dev/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri()?>/dev/js/modernizr.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri()?>/dev/js/flexslider.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri()?>/dev/js/functions.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri()?>/dev/js/skip-link-focus-fix.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri()?>/dev/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri()?>/dev/js/unitegallery.min.js"></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri()?>/dev/css/unite-gallery/themes/tiles/ug-theme-tiles.js'></script> 
<script type="text/javascript" src="<?php echo get_template_directory_uri()?>/dev/js/scripts.js"></script>


<?php wp_footer(); ?>

</body>
</html>