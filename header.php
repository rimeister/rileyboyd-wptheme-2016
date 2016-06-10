<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package activello
 */
?><!doctype html>
	<!--[if !IE]>
	<html class="no-js non-ie" <?php language_attributes(); ?>> <![endif]-->
	<!--[if IE 7 ]>
	<html class="no-js ie7" <?php language_attributes(); ?>> <![endif]-->
	<!--[if IE 8 ]>
	<html class="no-js ie8" <?php language_attributes(); ?>> <![endif]-->
	<!--[if IE 9 ]>
	<html class="no-js ie9" <?php language_attributes(); ?>> <![endif]-->
	<!--[if gt IE 9]><!-->
<html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<!-- CSS Files -->
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri()?>/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri()?>/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri()?>/css/flexslider.css">
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri()?>/css/unite-gallery.css">
<link rel='stylesheet' href='<?php echo get_template_directory_uri()?>/css/unite-gallery/themes/default/ug-theme-default.css' type='text/css' />
<link rel="stylesheet" href="<?php echo get_template_directory_uri()?>/style.css" type="text/css" >

<?php include_once("template_files/favicon/favicon_links.php") ?> 
<?php include_once("template_files/analytics/analyticstracking.php") ?> 

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site container main-page-container">

		<div class="row">
			<div class="col-xs-12">

				<header id="masthead" class="site-header" role="banner">
					<nav class="navbar navbar-default" role="navigation">
						<div class="container">
							<div class="row">
								<div class="site-navigation-inner col-sm-12">

									<div class="navbar-header">
										<button type="button" class="btn navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
											<span class="sr-only"><?php _e( 'Toggle navigation', 'activello' ); ?></span>
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
										</button>
									</div>

									<div class="logo-wrapper">
										<a href="<?php echo get_site_url(); ?>">
											<img src="<?php echo get_template_directory_uri()?>/images/header/logo-sq.jpg" alt="Riley Boyd Logo" class="logo">
										</a>
									</div>

									<?php activello_header_menu(); // main navigation ?>

									<div class="nav-search"><?php 
			                            add_filter('get_search_form', 'activello_header_search_filter',10,3);
			                            echo get_search_form();
			                            remove_filter('get_search_form', 'activello_header_search_filter');?>							
									</div>
								</div>
							</div>
						</div>
					</nav><!-- .site-navigation -->

					<?php
					$show_logo = true;
					$show_title = false;
					$show_tagline = true;
					$logo = get_theme_mod('header_logo', '');
					$header_show = get_theme_mod('header_show', 'logo-text');

					if( $header_show == 'logo-only' ){
						$show_tagline = false;
					}
					elseif( $header_show == 'title-only' ){
						$show_tagline = $show_logo = false;
					}
					elseif( $header_show == 'title-text' ){
						$show_logo = false;
						$show_title = true;
					}?>

				</header><!-- #masthead -->


				<div id="content" class="site-content">

					<?php if (is_front_page()) { ?>


					<div class="container hero-container">

						<div class="row">

							<div class="hero col-sm-12">
								<div class="hero-text">
									<h1>My name is Riley.</h1>
									<h2>I have a curious mind, a creative spirit, and a love for adventure.</h2>
								</div>
								<img src="<?php echo get_template_directory_uri()?>/images/hero/hero-image-scot-highlands.jpg" alt="Picture of Riley in the Scottish Highlands">
								<!--<?php activello_featured_slider(); ?>-->
							</div>

						</div>

					</div>

					<?php

						}

					?>

					<div class="container main-content-area">

						<?php if( is_single() && has_category() ) : ?>
						<?php endif; ?>
			                        <?php
			                            global $post;
			                            if( is_singular() && get_post_meta($post->ID, 'site_layout', true) ){
			                                $layout_class = get_post_meta($post->ID, 'site_layout', true);
			                            }
			                            else{
			                                $layout_class = get_theme_mod( 'activello_sidebar_position' );
			                            }?>

						<div class="row">
							<div class="main-content-inner <?php echo activello_main_content_bootstrap_classes(); ?> <?php echo $layout_class; ?>">
