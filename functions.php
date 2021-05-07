<?php
/**
 * davocate1 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package davocate1
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'davocate1_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function davocate1_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on davocate1, use a find and replace
		 * to change 'davocate1' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'davocate1', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'davocate1' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'davocate1_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'davocate1_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function davocate1_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'davocate1_content_width', 640 );
}
add_action( 'after_setup_theme', 'davocate1_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function davocate1_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'davocate1' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'davocate1' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'davocate1_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function davocate1_scripts() {

	wp_enqueue_style( 'davocate1-style', get_template_directory_uri() . '/assets/dist/css/main.css', array(), _S_VERSION );
	wp_enqueue_script( 'davocate1-main-js', get_template_directory_uri() . '/assets/dist/js/main.bundle.js', array(), _S_VERSION );

	wp_style_add_data( 'davocate1-style', 'rtl', 'replace' );

	wp_enqueue_script( 'davocate1-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'davocate1_scripts' );

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/* DOCTORS */
function create_doctor_type() {
	$args = array(
		'public' => true,
		'label'  => 'Doctors',
		'menu_icon' => get_template_directory_uri() . '/assets/images/icons/user-md.svg',
		'has_archive' => true,
	);
	register_post_type( 'doctor', $args );
}
add_action( 'init', 'create_doctor_type' );

function remove_default_editor() {
	remove_post_type_support( 'doctor', 'editor' );
}
add_action( 'init', 'remove_default_editor', 99);

add_action( 'wp_print_styles', 'wps_deregister_styles', 100 );
function wps_deregister_styles() {
    wp_dequeue_style( 'wp-block-library' );
}

function remove_header_info() {
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'start_post_rel_link');
	remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'adjacent_posts_rel_link');
	remove_action( 'wp_head', '_wp_render_title_tag', 1 );
	remove_action( 'wp_head', 'noindex', 1);

	remove_action('wp_head', 'print_emoji_detection_script', 7);

	
}
add_action('init', 'remove_header_info');