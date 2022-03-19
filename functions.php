<?php
//////////////////////
// scale up images
//////////////////////
function image_crop_dimensions($default, $orig_w, $orig_h, $new_w, $new_h, $crop){
    if ( !$crop ) return null; // let the wordpress default function handle this

    $aspect_ratio = $orig_w / $orig_h;
    $size_ratio = max($new_w / $orig_w, $new_h / $orig_h);

    $crop_w = round($new_w / $size_ratio);
    $crop_h = round($new_h / $size_ratio);

    $s_x = floor( ($orig_w - $crop_w) / 2 );
    $s_y = floor( ($orig_h - $crop_h) / 2 );

    return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h );
}
add_filter('image_resize_dimensions', 'image_crop_dimensions', 10, 6);


/**
 * Sets the directories (inside your theme) to find .twig files
 */
Timber::$dirname = array( 'src', 'templates', 'views' );

/**
 * By default, Timber does NOT autoescape values. Want to enable Twig's autoescape?
 * No prob! Just set this value to true
 */
//Timber::$autoescape = false;

class StarterSite extends Timber\Site {
	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'theme_supports' ) );
		add_filter( 'timber/twig', array( $this, 'add_to_twig' ) );
		// add_action( 'init', array( $this, 'register_post_types' ) );
		// add_action( 'init', array( $this, 'register_taxonomies' ) );
		add_filter( 'timber/context', array( $this, 'add_to_context' ) );
		$this->add_routes();
		parent::__construct();
    }

    public function add_to_context( $context ) {
		$context['categories'] = Timber::get_terms('category');
		$context['menu']  = new Timber\Menu();
		$context['site']  = $this;
        $context['GOOGLE_MAPS_KEY'] = '' ;
        return $context;
	}

	public function add_to_twig( $twig ) {
		$twig->addFunction( new Timber\Twig_Function( 'get_permalink_by_slug', function($slug) {
			return get_permalink( get_page_by_path($slug) );
		} ) );
		return $twig;
	}

    public function theme_supports() {
        add_theme_support( 'align-wide' );
        add_theme_support( 'wp-block-styles' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'editor-font-sizes', fontSizes());
    }

}
new StarterSite();


// Routes::map('publications', function($params) {
// 	Routes::load('archive-publications.php', $params);
// });


function my_myme_types($mime_types){
    $mime_types['svg'] = 'image/svg+xml'; //Adding svg extension
    return $mime_types;
}
add_filter('upload_mimes', 'my_myme_types', 1, 1);








function menu_support() {
    register_nav_menus();
}
add_action( 'init', 'menu_support' );




/*
--global--font-size-base: 16px;
--global--font-size-xs: 1rem;
--global--font-size-sm: 1.125rem;
--global--font-size-md: 1.25rem;
--global--font-size-lg: 1.5rem;
--global--font-size-xl: 2rem;
--global--font-size-xxl: 3rem;
--global--font-size-xxxl: 4rem;
*/

function fontSizes() {
    $ret = array(
        array(
            'name'      => esc_html__( 'Small' ),
            'shortName' => esc_html_x( 'S', 'Font size' ),
            'size'      => 13,
            'slug'      => 'small',
        ),
        array(
            'name'      => esc_html__( 'Base' ),
            'shortName' => esc_html_x( 'B', 'Font size' ),
            'size'      => 16,
            'slug'      => 'normal',
        ),
        array(
            'name'      => esc_html__( 'Medium' ),
            'shortName' => esc_html_x( 'M', 'Font size' ),
            'size'      => 20,
            'slug'      => 'medium',
        ),
        array(
            'name'      => esc_html__( 'Large' ),
            'shortName' => esc_html_x( 'L', 'Font size' ),
            'size'      => 24,
            'slug'      => 'large',
        ),
        array(
            'name'      => esc_html__( 'Extra large' ),
            'shortName' => esc_html_x( 'XL', 'Font size' ),
            'size'      => 32,
            'slug'      => 'extra-large',
        ),
        array(
            'name'      => esc_html__( 'Huge (H1)' ),
            'shortName' => esc_html_x( 'XXL', 'Font size' ),
            'size'      => 48,
            'slug'      => 'huge',
        ),
        array(
            'name'      => esc_html__( 'Gigantic' ),
            'shortName' => esc_html_x( 'XXL', 'Font size' ),
            'size'      => 64,
            'slug'      => 'gigantic',
        ),
    );
    
    return $ret;
}

