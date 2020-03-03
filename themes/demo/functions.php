<?php
/**
 * Demo functions and definitions
 *
 * @package WordPress
 * @subpackage Demo
 * @since Demo 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Demo 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 660;
}

if ( ! function_exists( 'demo_setup' ) ) :

	function demo_setup() {

		/*
		* Make theme available for translation.
		* Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/demo
		* If you're building a theme based on demo, use a find and replace
		* to change 'demo' to the name of your theme in all the template files
		*/
		load_theme_textdomain( 'demo' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
		add_theme_support( 'title-tag' );

		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1200, 9999 );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus( array(
			'primary' => __( 'Primary Menu',      'demo' ),
			'social'  => __( 'Social Links Menu', 'demo' ),
		) );

		/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
		) );

		/*
		* Enable support for Post Formats.
		*
		* See: https://codex.wordpress.org/Post_Formats
		*/
		add_theme_support( 'post-formats', array(
			'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
		) );

		/*
		* Enable support for custom logo.
		*
		* @since Demo 1.5
		*/
		add_theme_support( 'custom-logo', array(
			'height'      => 248,
			'width'       => 248,
			'flex-height' => true,
		) );

		
	}
endif; // demo_setup

add_action( 'after_setup_theme', 'demo_setup' );

/**
 * Register widget area.
 *
 * @since Demo 1.0
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
function demo_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Widget Area', 'demo' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'demo' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}

add_action( 'widgets_init', 'demo_widgets_init' );


/**
 * Enqueue scripts and styles.
 *
 * @since Demo 1.0
 */
function demo_scripts() {
	
	// Load our main stylesheet.
	wp_enqueue_style( 'demo-style', get_stylesheet_uri() );
	wp_enqueue_style( 'demo-custom-style', get_template_directory_uri() . '/css/custom.css');

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'demo-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20141010' );
	}

}
add_action( 'wp_enqueue_scripts', 'demo_scripts' );



function demo_post_thumbnail(){

}


function demo_entry_meta(){
	
}



function my_plugin_function(){
	include(dirname(__FILE__)."/theme_options.php");
}

function my_plugin_menu() {
	add_theme_page('My Plugin Theme', 'Demo Theme', 'edit_theme_options', 'demo-theme-options', 'my_plugin_function');
}

add_action('admin_menu', 'my_plugin_menu');



function wpb_widgets_init() {

	include("widget_areas.php");
	foreach($widget_areas as $widget_id => $widget_title){
		register_sidebar( array(
			'name'          => $widget_title,
			'id'            => $widget_id,
			'before_widget' => '<div class="custom-widget-content '.$widget_id.'-content">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="custom-widget-title '.$widget_id.'-title">',
			'after_title'   => '</h2>',
		) );
	}

}
add_action( 'widgets_init', 'wpb_widgets_init' );


function mytheme_customize_register( $wp_customize ) {

    $wp_customize->add_section( 'demo_theme_company_section' , array(
        'title'      => __( 'Additional Site identity', 'demo_theme' ),
        'priority'   => 30,
    ));

    $wp_customize->add_setting( 'demo_theme_show_text', array(
		'default' => '1',
	));
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'demo_theme_show_text_control',
            array(
                'label'      => __( 'Show image and text', 'demo_theme' ),
                'section'    => 'demo_theme_company_section',
                'settings'   => 'demo_theme_show_text',
				'priority'   => 1,
				'type' => 'select',
				'choices' => [
					"1" => "Show logo and text",
					"2" => "Show logo only"
				]
            )
        )
    );

}
add_action( 'customize_register', 'mytheme_customize_register' );

$widget_list=scandir(dirname(__FILE__)."/widgets");
foreach($widget_list as $widget){
    if ($widget=="." || $widget==".."){
        continue;
    }
	list($name,$ext)=explode(".",$widget);
	if ($ext=="php"){
		require_once(dirname(__FILE__)."/widgets/$widget");
		$instance=new $name();
	}
}

function get_theme_values($theme_options){
    $theme_values=[];
    foreach($theme_options as $option=>$item){
        if (get_option($option) === false){
            add_option($option, $item["default"] , '', false);
        }
        $postvalue=$_POST[$option];
        if (array_key_exists($option,$_POST)){
            $result =update_option($option,$postvalue,false);
        }
        $theme_values[$option] = get_option($option,$item["default"]);
    }
    return $theme_values;
}

function enqueue_select2_jquery() {
    wp_register_style( 'select2css', '//cdnjs.cloudflare.com/ajax/libs/select2/3.4.8/select2.css', false, '1.0', 'all' );
    wp_register_script( 'select2', '//cdnjs.cloudflare.com/ajax/libs/select2/3.4.8/select2.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_style( 'select2css' );
    wp_enqueue_script( 'select2' );
}
//add_action( 'admin_enqueue_scripts', 'enqueue_select2_jquery' );