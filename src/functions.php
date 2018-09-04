<?php

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

function theme_styles() {

	wp_enqueue_style( 'bootstrap_css', get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'bootstrap-reboot_css', get_template_directory_uri() . '/css/bootstrap-reboot.min.css' );
	wp_enqueue_style( 'bootstrap-grid_css', get_template_directory_uri() . '/css/bootstrap-grid.min.css' );
	wp_enqueue_style( 'main_css', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'theme_css', get_template_directory_uri() . '/css/theme.css' );

}
add_action( 'wp_enqueue_scripts', 'theme_styles' );

function theme_js() {

	global $wp_scripts;

	wp_register_script( 'html5_shiv', 'https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js', '', '', false );
	wp_register_script( 'respond_js', 'https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js', '', '', false );

	$wp_scripts->add_data( 'html5_shiv', 'conditional', 'lt IE 9' );
	$wp_scripts->add_data( 'respond_js', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'tether_js', get_template_directory_uri() . '/js/tether.min.js', array('jquery'), '', true );
	wp_enqueue_script( 'bootstrap_js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '', true );
}
add_action( 'wp_enqueue_scripts', 'theme_js' );

add_theme_support( 'menus' );
add_theme_support( 'post-thumbnails' );

// Register Custom Navigation Walker
require_once('bs4navwalker.php');

function register_theme_menus() {
	register_nav_menus(
		array(
			'header-menu'	=> __( 'Header Menu' ),
			'footer_1'	=> __( 'Footer 1' )
		)
	);
}
add_action( 'init', 'register_theme_menus' );


add_filter('widget_text','execute_php',100);
function execute_php($html){
     if(strpos($html,"<"."?php")!==false){
          ob_start();
          eval("?".">".$html);
          $html=ob_get_contents();
          ob_end_clean();
     }
     return $html;
};

// -- Custom post types --

// Portolio Items
function cptui_register_my_cpts() {

	/**
	 * Post Type: Portfolio Items.
	 */

	$labels = array(
		"name" => __( "Portfolio Items", "" ),
		"singular_name" => __( "Portfolio", "" ),
		"menu_name" => __( "Portfolio Items", "" ),
		"all_items" => __( "All Items", "" ),
		"add_new" => __( "Add Item", "" ),
	);

	$args = array(
		"label" => __( "Portfolio Items", "" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "portfolio_items", "with_front" => true ),
		"query_var" => true,
		"menu_icon" => "dashicons-layout",
		"supports" => array( "title", "editor", "thumbnail", "custom-fields" ),
	);

	register_post_type( "portfolio_items", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );



function create_widget( $name, $id, $description ) {
	register_sidebar(array(
		'name' => __( $name ),	 
		'id' => $id, 
		'description' => __( $description ),
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
}

// custom login screen
function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
          background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png);
          height:40px;
          width:320px;
          background-size: 320px 125px;
          background-repeat: no-repeat;
          padding-bottom: 30px;
        }
        #login #wp-submit {
          background-color:#d19033 !important;
          text-shadow: none !important;
          border:none !important;
        }
        .login {
        	background-color:#191F2D;
        }
        #nav a {
        	color:#fff !important;
        }
      	#backtoblog a {
      		color:#fff !important;
      	}

    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );
add_filter( 'http_request_host_is_external', '__return_true' );


create_widget( 'Page Sidebar', 'page', 'Displays on the side of pages with a sidebar' );

?>
