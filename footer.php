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

	<div id="footer-area">
		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="site-info container">
				<div class="row">
					<?php if( !get_theme_mod('footer_social') ) activello_social_icons(); ?>
						<p>All content is &copy; 2016 Riley Boyd.</p>
					</div>
				</div>
			</div><!-- .site-info -->
			<div class="scroll-to-top"><i class="fa fa-angle-up"></i></div><!-- .scroll-to-top -->
		</footer><!-- #colophon -->
	</div>
</div><!-- #page -->

<!-- JS Plugins -->
<script type="text/javascript" src="<?php echo get_template_directory_uri()?>/js/jquery-2.2.4.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri()?>/js/unitegallery.min.js"></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri()?>/themes/default/ug-theme-default.js'></script> 

<!-- My Scripts -->
<script type="text/javascript" src="<?php echo get_template_directory_uri()?>/js/scripts.js"></script>


<?php wp_footer(); ?>

</body>
</html>