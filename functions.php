<?php
/*
* Generated By Orbisius Child Theme Creator - your favorite plugin for Child Theme creation :)
* https://wordpress.org/plugins/orbisius-child-theme-creator/
*
* Unlike style.css, the functions.php of a child theme does not override its counterpart from the parent.
* Instead, it is loaded in addition to the parent’s functions.php. (Specifically, it is loaded right before the parent theme's functions.php).
* Source: http://codex.wordpress.org/Child_Themes#Using_functions.php
*
* Be sure not to define functions, that already exist in the parent theme!
* A common pattern is to prefix function names with the (child) theme name.
* Also if the parent theme supports pluggable functions you can use function_exists( 'put_the_function_name_here' ) checks.
*/

/**
 * Loads parent and child themes' style.css
 */
function orbisius_ct_andromeda_child_theme_enqueue_styles() {
    $parent_style = 'orbisius_ct_andromeda_parent_style';
    $parent_base_dir = 'twentyseventeen';

    wp_enqueue_style( $parent_style,
        get_template_directory_uri() . '/style.css',
        array(),
        wp_get_theme( $parent_base_dir ) ? wp_get_theme( $parent_base_dir )->get('Version') : ''
    );

    wp_enqueue_style( $parent_style . '_child_style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}

add_action( 'wp_enqueue_scripts', 'orbisius_ct_andromeda_child_theme_enqueue_styles' );

// register custom navs
function register_my_menus() {
  register_nav_menus(
    array(
      'main-nav' => __( 'Main Nav' ),
      'footer-nav-left' => __( 'Footer Nav' ),
      'footer-nav-middle' => __( 'Footer Nav Middle' ),
      'footer-nav-right' => __( 'Footer Nav Right' )
    )
  );
}
add_action( 'init', 'register_my_menus' );

/**
*Set up function to desplay social nav
*/
function theme_setup() {
    register_nav_menus(array(
        'social' => esc_html__('Social Menu', 'textdomain')
    ));
}

function theme_social_menu() {
    if (has_nav_menu('social')) {
        wp_nav_menu(
            array(
                'theme_location' => 'social',
                'container' => 'div',
                'container_class' => 'theme-social-menu',
                'depth' => 1, // No need to allow sub-menu for social icons
                'menu_class' => 'menu-social',
                'fallback_cb' => false, // No fallback setting
                'link_before' => '<span class="screen-reader-text">', // Hide the social links text
                'link_after' => '</span>', // Hide the social links text
                'items_wrap' => '<ul class="%2$s">%3$s</ul>',
            )
        );
    }
}

function theme_scripts() {
    wp_enqueue_style('font-awesome', get_stylesheet_directory_uri() . '/fontawesome/css/fontawesome.css');
}

add_action('wp_enqueue_scripts', 'theme_scripts');

add_action('after_setup_theme', 'theme_setup');
/**
*Enqueue bootrap
*/
function reg_scripts() {
    wp_enqueue_style( 'bootstrapstyle', get_stylesheet_directory_uri() . '/css/bootstrap.min.css' );
}
add_action('wp_enqueue_scripts', 'reg_scripts');

/**
*Enqueue Goolge Fonts
*/

// Enqueue the fonts
  function add_fonts_to_theme(){
    wp_enqueue_style("adding-google-fonts", all_google_fonts());
   }
    add_action("wp_enqueue_scripts","add_fonts_to_theme");

    // Choose the fonts
    function all_google_fonts() {
      $fonts = array(
        "EB+Garamond:400,700",
        "Roboto:400,700",
      );
      $fonts_collection = add_query_arg(array(
        "family"=>urlencode(implode("|",$fonts)),
        "subset"=>"latin"
      ),'https://fonts.googleapis.com/css');
    return $fonts_collection;
  }

//enqueues our locally supplied font awesome stylesheet
function enqueue_our_required_stylesheets(){
	wp_enqueue_style('font-awesome', get_stylesheet_directory_uri() . '/fontawesome/css/fontawesome.css');
  }
     add_action('wp_enqueue_scripts','enqueue_our_required_stylesheets');
