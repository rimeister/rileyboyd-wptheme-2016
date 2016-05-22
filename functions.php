<?php
/**
 * activello functions and definitions
 *
 * @package activello
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 697; /* pixels */
}

/**
 * Set the content width for full width pages with no sidebar.
 */
function activello_content_width() {
  if ( is_page_template( 'page-fullwidth.php' ) ) {
    global $content_width;
    $content_width = 1008; /* pixels */
  }
}
add_action( 'template_redirect', 'activello_content_width' );

if ( ! function_exists( 'activello_main_content_bootstrap_classes' ) ) :
/**
 * Add Bootstrap classes to the main-content-area wrapper.
 */
function activello_main_content_bootstrap_classes() {
	if ( is_page_template( 'page-fullwidth.php' ) ) {
		return 'col-sm-12 col-md-12';
	}
	return 'col-sm-12 col-md-8';
}
endif; // activello_main_content_bootstrap_classes

if ( ! function_exists( 'activello_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function activello_setup() {

  /*
   * Make theme available for translation.
   * Translations can be filed in the /languages/ directory.
   */
  load_theme_textdomain( 'activello', get_template_directory() . '/languages' );

  // Add default posts and comments RSS feed links to head.
  add_theme_support( 'automatic-feed-links' );

  /**
   * Enable support for Post Thumbnails on posts and pages.
   *
   * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
   */
  add_theme_support( 'post-thumbnails' );

  add_image_size( 'activello-featured', 1170, 550, true );
  add_image_size( 'activello-slider', 1920, 550, true );
  add_image_size( 'activello-thumbnail', 330, 220, true );
  add_image_size( 'activello-medium', 640, 480, true );

  // This theme uses wp_nav_menu() in one location.
  register_nav_menus( array(
    'primary'      => esc_html__( 'Primary Menu', 'activello' )
  ) );

  // Enable support for Post Formats.
  add_theme_support( 'post-formats', array(
		'video',
		'audio',
	) );

  // Setup the WordPress core custom background feature.
  add_theme_support( 'custom-background', apply_filters( 'activello_custom_background_args', array(
    'default-color' => 'FFFFFF',
    'default-image' => '',
  ) ) );

  // Enable support for HTML5 markup.
  add_theme_support( 'html5', array(
    'comment-list',
    'search-form',
    'comment-form',
    'gallery',
    'caption',
  ) );

  /*
   * Let WordPress manage the document title.
   * By adding theme support, we declare that this theme does not use a
   * hard-coded <title> tag in the document head, and expect WordPress to
   * provide it for us.
   */
  add_theme_support( 'title-tag' );

}
endif; // activello_setup
add_action( 'after_setup_theme', 'activello_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function activello_widgets_init() {
  register_sidebar( array(
    'name'          => esc_html__( 'Sidebar', 'activello' ),
    'id'            => 'sidebar-1',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ));

  register_widget( 'activello_social_widget' );
  register_widget( 'activello_recent_posts' );
  register_widget( 'activello_categories' );
}
add_action( 'widgets_init', 'activello_widgets_init' );


/* --------------------------------------------------------------
       Theme Widgets
-------------------------------------------------------------- */
require_once(get_template_directory() . '/inc/widgets/widget-categories.php');
require_once(get_template_directory() . '/inc/widgets/widget-social.php');
require_once(get_template_directory() . '/inc/widgets/widget-recent-posts.php');

/**
 * This function removes inline styles set by WordPress gallery.
 */
function activello_remove_gallery_css( $css ) {
  return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}

add_filter( 'gallery_style', 'activello_remove_gallery_css' );

/**
 * Enqueue scripts and styles.
 */
function activello_scripts() {

  // Add Bootstrap default CSS
  wp_enqueue_style( 'activello-bootstrap', get_template_directory_uri() . '/inc/css/bootstrap.min.css' );

  // Add Font Awesome stylesheet
  wp_enqueue_style( 'activello-icons', get_template_directory_uri().'/inc/css/font-awesome.min.css' );

  // Add Google Fonts
  wp_enqueue_style( 'activello-fonts', '//fonts.googleapis.com/css?family=Lora:400,400italic,700,700italic|Montserrat:400,700|Maven+Pro:400,700');

  // Add slider CSS only if is front page ans slider is enabled
  if( ( is_home() || is_front_page() ) && get_theme_mod('activello_featured_hide') == 1 ) {
    wp_enqueue_style( 'flexslider-css', get_template_directory_uri().'/inc/css/flexslider.css' );
  }

  // Add main theme stylesheet
  wp_enqueue_style( 'activello-style', get_stylesheet_uri() );

  // Add Modernizr for better HTML5 and CSS3 support
  wp_enqueue_script('activello-modernizr', get_template_directory_uri().'/inc/js/modernizr.min.js', array('jquery') );

  // Add Bootstrap default JS
  wp_enqueue_script('activello-bootstrapjs', get_template_directory_uri().'/inc/js/bootstrap.min.js', array('jquery') );

  // Add slider JS only if is front page ans slider is enabled
  if( ( is_home() || is_front_page() ) && get_theme_mod('activello_featured_hide') == 1 ) {
    wp_register_script( 'flexslider-js', get_template_directory_uri() . '/inc/js/flexslider.min.js', array('jquery'), '20140222', true );
  }

  // Main theme related functions
  wp_enqueue_script( 'activello-functions', get_template_directory_uri() . '/inc/js/functions.min.js', array('jquery') );

  // This one is for accessibility
  wp_enqueue_script( 'activello-skip-link-focus-fix', get_template_directory_uri() . '/inc/js/skip-link-focus-fix.js', array(), '20140222', true );

  // Threaded comments
  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
}
add_action( 'wp_enqueue_scripts', 'activello_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load custom nav walker
 */
require get_template_directory() . '/inc/navwalker.php';

/**
 * Load custom metabox
 */
require get_template_directory() . '/inc/metaboxes.php';

/**
 * Social Nav Menu
 */
require get_template_directory() . '/inc/socialnav.php';

/* Globals */
global $site_layout, $header_show;
$site_layout = array('pull-right' =>  esc_html__('Left Sidebar','activello'), 'side-right' => esc_html__('Right Sidebar','activello'), 'no-sidebar' => esc_html__('No Sidebar','activello'),'full-width' => esc_html__('Full Width', 'activello'));
$header_show = array(
                        'logo-only' => __('Logo Only', 'activello'),
                        'logo-text' => __('Logo + Tagline', 'activello'),
                        'title-only' => __('Title Only', 'activello'),
                        'title-text' => __('Title + Tagline', 'activello')
                      );

/* Get Single Post Category */
function activello_get_single_category($post_id){

    if( !$post_id )
        return '';

    $post_categories = wp_get_post_categories( $post_id );

    if( !empty( $post_categories ) ){
        return wp_list_categories('echo=0&title_li=&show_count=0&include='.$post_categories[0]);
    }
    return '';
}

if ( ! function_exists( 'activello_woo_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function activello_woo_setup() {
	/*
	 * Enable support for WooCemmerce.
	*/
	add_theme_support( 'woocommerce' );

}
endif; // activello_woo_setup
add_action( 'after_setup_theme', 'activello_woo_setup' );

/*
 * Function to modify search template for header
 */
function activello_header_search_filter($form){
    $form = '<form action="'.esc_url( home_url( "/" ) ).'" method="get"><input type="text" name="s" value="'.get_search_query().'" placeholder="'. esc_attr_x( __('Search', 'activello'), 'search placeholder', 'activello' ).'"><button type="submit" class="header-search-icon" name="submit" id="searchsubmit" value="'. esc_attr_x( 'Search', 'submit button', 'activello' ).'"><i class="fa fa-search"></i></button></form>';
    return $form;    
}

/* Modify Gallery html */


add_filter('post_gallery', 'my_post_gallery', 10, 2);
function my_post_gallery($output, $attr) {
    global $post;

    if (isset($attr['orderby'])) {
        $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
        if (!$attr['orderby'])
            unset($attr['orderby']);
    }

    extract(shortcode_atts(array(
        'order' => 'ASC',
        'orderby' => 'menu_order ID',
        'id' => $post->ID,
        'itemtag' => 'dl',
        'icontag' => 'dt',
        'captiontag' => 'dd',
        'columns' => 3,
        'size' => 'thumbnail',
        'include' => '',
        'exclude' => ''
    ), $attr));

    $id = intval($id);
    if ('RAND' == $order) $orderby = 'none';

    if (!empty($include)) {
        $include = preg_replace('/[^0-9,]+/', '', $include);
        $_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

        $attachments = array();
        foreach ($_attachments as $key => $val) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    }

    if (empty($attachments)) return '';

    // Here's your actual output, you may customize it to your need

    $output = "<div id=\"gallery\" style=\"display:none;\">\n";

    // Now you loop through each attachment
    foreach ($attachments as $id => $attachment) {
      // Fetch the thumbnail (or full image, it's up to you)
      // $img = wp_get_attachment_image_src($id, 'medium');
      // $img = wp_get_attachment_image_src($id, 'my-custom-image-size');
      $imgThumb = wp_get_attachment_image_src($id, 'medium');
      $imgFull = wp_get_attachment_image_src($id, 'full');

      //$output .= "<img src=\"{$img[0]}\" width=\"{$img[1]}\" height=\"{$img[2]}\" alt=\"\" />\n";



//      $output .= "<img alt=\"Image Title\" src=\"{$imgThumb[0]}\" data-image=\""."\" data-description=\"Image Description\">";
        $output .= "<img alt=\"Image Title\" src=\"{$imgThumb[0]}\" data-image=\"{$imgFull[0]}\" data-description=\"Image Description\">";
//      $output .= "<img src=\"{$imgThumb[0]}\">";




    }

    $output .= "</div>\n";

    return $output;
}
