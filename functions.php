<?php
/**
 * Ordinary functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Ordinary
 */

if ( ! function_exists( 'ordinary_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function ordinary_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Ordinary, use a find and replace
         * to change 'ordinary' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'ordinary', get_template_directory() . '/languages' );

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
        register_nav_menus( array(
            'menu-1' => esc_html__( 'Primary', 'ordinary' ),
        ) );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'ordinary_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ) ) );

        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support( 'custom-logo', array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        ) );

        add_theme_support('post-formats', array(
            'aside',
            'gallery',
            'link',
            'image',
            'quote',
            'status',
            'video',
            'audio',
            'chat',
        ) );

        add_theme_support( 'editor-styles' );
        add_editor_style( 'gutenberg/style-editor.css' );
    }
endif;
add_action( 'after_setup_theme', 'ordinary_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ordinary_content_width() {
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters( 'ordinary_content_width', 640 );
}
add_action( 'after_setup_theme', 'ordinary_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ordinary_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'ordinary' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here.', 'ordinary' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'ordinary_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ordinary_scripts() {
    wp_enqueue_style( 'ordinary-style', get_stylesheet_uri() );

    wp_enqueue_script( 'ordinary-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

    /*wp_enqueue_style('ordinaryblocks-style', get_template_directory_uri() . '/css/blocks.css' );*/

    wp_enqueue_script( 'ordinary-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'ordinary_scripts' );

function ordinary_get_first_link() {
    if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches ) )
        return false;

    return esc_url_raw( $matches[1] );
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
    require get_template_directory() . '/inc/jetpack.php';
}

/*
add_filter( 'shortcode_atts_audio', 'ordinary_fix_audio_shortcode_atts', 10, 4);

function ordinary_fix_audio_shortcode_atts( $out, $pairs, $atts, $shortcode) {
    $out['style'] = 'width:100px;';
    return $out;
} */


function ordinary_fix_audio_shortcode_html_output( $html, $atts, $audio, $post_id, $library) {
    $html = '<div class="audio-container">' . $html . '</div>';
    return $html;
}

add_filter( 'wp_audio_shortcode', 'ordinary_fix_audio_shortcode_html_output', 10, 5);

function ordinary_use_minified_stylesheet_in_production( $stylesheet, $stylesheet_dir ) {
    if ( ! defined( 'WP_DEBUG' ) || ( defined( 'WP_DEBUG' ) && ! WP_DEBUG ) ) {
        $stylesheet = $stylesheet_dir . '/style.min.css';
    }

    return $stylesheet;
}

add_filter( 'stylesheet_uri', 'ordinary_use_minified_stylesheet_in_production', 10, 2);
