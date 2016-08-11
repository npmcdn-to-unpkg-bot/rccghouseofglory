<?php

if ( ! class_exists( 'Timber' ) ) {
	add_action( 'admin_notices', function() {
			echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
		} );
	return;
}

Timber::$dirname = array('templates', 'views');

class RccgSite extends TimberSite {

	function __construct() {
		add_theme_support( 'post-formats' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
		add_theme_support( 'widgets' );
		add_theme_support( 'title-tag' );
		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus( array(
			'primary' => __( 'Primary Menu', 'rccg' ),
			'quick-links'  => __( 'Quick Links Menu', 'rccg' ),
		) );

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		add_filter( 'timber_context', array( $this, 'add_to_context' ) );
		add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		add_action( 'wp_enqueue_scripts',array( $this, 'register_scripts' ));
		add_action( 'widgets_init', array( $this, 'widgets_init' ) );
		// add_action( 'pre_get_posts', array( $this, 'my_home_query') );

		parent::__construct();
	}

	function register_post_types() {
		//this is where you can register custom post types
	}

	function register_taxonomies() {
		//this is where you can register custom taxonomies
	}

	public function register_scripts()
	{
		// wp_enqueue_style( 'underscore-starter-theme-style', get_stylesheet_uri() );
		//
		// wp_enqueue_script( 'underscore-starter-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
		//
		// wp_enqueue_script( 'underscore-starter-theme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
		//
		// if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		// 	wp_enqueue_script( 'comment-reply' );
		// }
	}


	public function widgets_init()
	{
		if (function_exists('register_sidebar')) {

			register_sidebar(array(
				'name' => 'sidebar',
				'id'   => 'sidebar',
				'description'   => 'This is a widgetized area.',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>'
			));

		}
	}

	function add_to_context( $context ) {
		$context['foo'] = 'bar';
		$context['stuff'] = 'I am a value set in your functions.php file';
		$context['notes'] = 'These values are available everytime you call Timber::get_context();';
		$context['menu'] = new TimberMenu('primary');
		$context['sidebar'] = Timber::get_sidebar('sidebar.php');
		 $context['pagination'] = Timber::get_pagination();
		$context['site'] = $this;
		return $context;
	}

	function myfoo( $text ) {
		$text .= ' bar!';
		return $text;
	}

	function add_to_twig( $twig ) {
		/* this is where you can add your own fuctions to twig */
		$twig->addExtension( new Twig_Extension_StringLoader() );
		$twig->addFilter('myfoo', new Twig_SimpleFilter('myfoo', array($this, 'myfoo')));
		return $twig;
	}

	function my_home_query( $query ) {
		 if ( $query->is_main_query() && !is_admin() ) {
		   $query->set( 'post_type', array( 'movie', 'post' ));
		 }
   	}


}

new RccgSite();
