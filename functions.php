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
/*
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
*/
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
      $imgFull = wp_get_attachment_image_src($id, 'large');

      //$output .= "<img src=\"{$img[0]}\" width=\"{$img[1]}\" height=\"{$img[2]}\" alt=\"\" />\n";



//      $output .= "<img alt=\"Image Title\" src=\"{$imgThumb[0]}\" data-image=\""."\" data-description=\"Image Description\">";
        $output .= "<img alt=\"\" src=\"{$imgThumb[0]}\" data-image=\"{$imgFull[0]}\" data-description=\"Image Description\">";
//      $output .= "<img src=\"{$imgThumb[0]}\">";




    }

    $output .= "</div>\n";

    return $output;
}

// Breadcrumbs
function custom_breadcrumbs() {
       
    // Settings
    $separator          = '&raquo;';
    $breadcrums_id      = 'breadcrumbs';
    $breadcrums_class   = 'breadcrumbs';
    $home_title         = 'Home';
      
    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy    = 'product_cat';
       
    // Get the query & post information
    global $post,$wp_query;
       
    // Do not display on the homepage
    if ( !is_front_page() ) {
       
        // Build the breadcrums
        echo '<ul id="' . $breadcrums_id . '" class="' . $breadcrums_class . '">';
           
        // Home page
        echo '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a></li>';
        echo '<li class="separator separator-home"> ' . $separator . ' </li>';
           
        if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {
            echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . post_type_archive_title($prefix, false) . '</strong></li>';
              
        } else if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {
              
            // If post is a custom post type
            $post_type = get_post_type();
              
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                  
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
              
                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
              
            }
              
            $custom_tax_name = get_queried_object()->name;
            echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . $custom_tax_name . '</strong></li>';
              
        } else if ( is_single() ) {
              
            // If post is a custom post type
            $post_type = get_post_type();
              
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                  
                $post_type_object = get_post_type_object($post_type);
                //$post_type_archive = get_post_type_archive_link($post_type);
              
                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . get_site_url() . '/' . strtolower($post_type_object->labels->name) .'" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
              
            }
              
           /*// Get post category info
            $category = get_the_category();
             
            if(!empty($category)) {
              
                // Get last category post is in
                $last_category = end(array_values($category));
                  
                // Get parent any categories and create array
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
                $cat_parents = explode(',',$get_cat_parents);
                  
                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                foreach($cat_parents as $parents) {

                    $cat_display .= '<li class="item-cat">'.$parents.'</li>';
                    $cat_display .= '<li class="separator"> ' . $separator . ' </li>';

                }
             
            }*/

            if($post_type == 'post') {
              $siteUri = get_site_url();
              echo '<li class="item-cat"><a class="bread-cat" href="'.$siteUri.'/blog/" title="Blog">Blog</a></li>';
              echo '<li class="separator"> ' . $separator . ' </li>';              
            }
              
            // If it's a custom post type within a custom taxonomy
            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
            if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {
                   
                $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
                $cat_id         = $taxonomy_terms[0]->term_id;
                $cat_nicename   = $taxonomy_terms[0]->slug;
                $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                $cat_name       = $taxonomy_terms[0]->name;
               
            }
              
            // Check if the post is in a category
            if(!empty($last_category)) {
                echo $cat_display;
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
                  
            // Else if post is in a custom taxonomy
            } else if(!empty($cat_id)) {
                  
                echo '<li class="item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
            } else {
                  
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
                  
            }
              
        } else if ( is_category() ) {
               
            // Category page
            echo '<li class="item-current item-cat"><strong class="bread-current bread-cat">' . single_cat_title('', false) . '</strong></li>';
               
        } else if ( is_page() ) {
               
            // Standard page
            if( $post->post_parent ){
                   
                // If child page, get parents 
                $anc = get_post_ancestors( $post->ID );
                   
                // Get parents in the right order
                $anc = array_reverse($anc);
                   
                // Parent page loop
                foreach ( $anc as $ancestor ) {
                    $parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
                    $parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
                }
                   
                // Display parent pages
                echo $parents;
                   
                // Current page
                echo '<li class="item-current item-' . $post->ID . '"><strong title="' . get_the_title() . '"> ' . get_the_title() . '</strong></li>';
                   
            } else {
                   
                // Just display current page if not parents
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</strong></li>';
                   
            }
               
        } else if ( is_tag() ) {
               
            // Tag page
               
            // Get tag information
            $term_id        = get_query_var('tag_id');
            $taxonomy       = 'post_tag';
            $args           = 'include=' . $term_id;
            $terms          = get_terms( $taxonomy, $args );
            $get_term_id    = $terms[0]->term_id;
            $get_term_slug  = $terms[0]->slug;
            $get_term_name  = $terms[0]->name;
               
            // Display the tag name
            echo '<li class="item-current item-tag-' . $get_term_id . ' item-tag-' . $get_term_slug . '"><strong class="bread-current bread-tag-' . $get_term_id . ' bread-tag-' . $get_term_slug . '">' . $get_term_name . '</strong></li>';
           
        } elseif ( is_day() ) {
               
            // Day archive
               
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
               
            // Month link
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('m') . '"> ' . $separator . ' </li>';
               
            // Day display
            echo '<li class="item-current item-' . get_the_time('j') . '"><strong class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</strong></li>';
               
        } else if ( is_month() ) {
               
            // Month Archive
               
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
               
            // Month display
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><strong class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</strong></li>';
               
        } else if ( is_year() ) {
               
            // Display year archive
            echo '<li class="item-current item-current-' . get_the_time('Y') . '"><strong class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</strong></li>';
               
        } else if ( is_author() ) {
               
            // Auhor archive
               
            // Get the author information
            global $author;
            $userdata = get_userdata( $author );
               
            // Display author name
            echo '<li class="item-current item-current-' . $userdata->user_nicename . '"><strong class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . 'Author: ' . $userdata->display_name . '</strong></li>';
           
        } else if ( get_query_var('paged') ) {
               
            // Paginated archives
            echo '<li class="item-current item-current-' . get_query_var('paged') . '"><strong class="bread-current bread-current-' . get_query_var('paged') . '" title="Page ' . get_query_var('paged') . '">'.__('Page') . ' ' . get_query_var('paged') . '</strong></li>';
               
        } else if ( is_search() ) {
           
            // Search results page
            echo '<li class="item-current item-current-' . get_search_query() . '"><strong class="bread-current bread-current-' . get_search_query() . '" title="Search results for: ' . get_search_query() . '">Search results for: ' . get_search_query() . '</strong></li>';
           
        } elseif ( is_404() ) {
               
            // 404 page
            echo '<li>' . 'Error 404' . '</li>';

        } elseif ( is_home()) {
            echo '<li class="item-current"><strong title="articles">Articles</strong></li>';
        }
       
        echo '</ul>';
           
    }
       
}

# Cinemagraph custom fields
if(function_exists("register_field_group"))
{
  register_field_group(array (
    'id' => 'acf_cinemagraph-featured-image',
    'title' => 'Cinemagraph Featured Image',
    'fields' => array (
      array (
        'key' => 'field_580d619774e87',
        'label' => 'Cinemagraph MP4',
        'name' => 'cinemagraph_mp4',
        'type' => 'file',
        'instructions' => 'Upload an MP4 file for the cinemagraph that will appear in place of the featured image',
        'save_format' => 'url',
        'library' => 'all',
      ),
      array (
        'key' => 'field_580d621674e88',
        'label' => 'Cinemagraph OGG',
        'name' => 'cinemagraph_ogg',
        'type' => 'file',
        'instructions' => 'Upload an OGG file for the cinemagraph that will appear in place of the featured image',
        'save_format' => 'url',
        'library' => 'all',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'post',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'normal',
      'layout' => 'no_box',
      'hide_on_screen' => array (
      ),
    ),
    'menu_order' => 0,
  ));
}

