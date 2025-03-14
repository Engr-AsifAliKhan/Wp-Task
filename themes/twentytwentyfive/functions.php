<?php
/**
 * Twenty Twenty-Five functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 * @since Twenty Twenty-Five 1.0
 */

// Adds theme support for post formats.
if ( ! function_exists( 'twentytwentyfive_post_format_setup' ) ) :
	/**
	 * Adds theme support for post formats.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_post_format_setup() {
		add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );
	}
endif;
add_action( 'after_setup_theme', 'twentytwentyfive_post_format_setup' );

// Enqueues editor-style.css in the editors.
if ( ! function_exists( 'twentytwentyfive_editor_style' ) ) :
	/**
	 * Enqueues editor-style.css in the editors.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_editor_style() {
		add_editor_style( get_parent_theme_file_uri( 'assets/css/editor-style.css' ) );
	}
endif;
add_action( 'after_setup_theme', 'twentytwentyfive_editor_style' );

// Enqueues style.css on the front.
if ( ! function_exists( 'twentytwentyfive_enqueue_styles' ) ) :
	/**
	 * Enqueues style.css on the front.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_enqueue_styles() {
		wp_enqueue_style(
			'twentytwentyfive-style',
			get_parent_theme_file_uri( 'style.css' ),
			array(),
			wp_get_theme()->get( 'Version' )
		);
	}
endif;
add_action( 'wp_enqueue_scripts', 'twentytwentyfive_enqueue_styles' );






// Registers custom block styles.
if ( ! function_exists( 'twentytwentyfive_block_styles' ) ) :
	/**
	 * Registers custom block styles.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_block_styles() {
		register_block_style(
			'core/list',
			array(
				'name'         => 'checkmark-list',
				'label'        => __( 'Checkmark', 'twentytwentyfive' ),
				'inline_style' => '
				ul.is-style-checkmark-list {
					list-style-type: "\2713";
				}

				ul.is-style-checkmark-list li {
					padding-inline-start: 1ch;
				}',
			)
		);
	}
endif;
add_action( 'init', 'twentytwentyfive_block_styles' );

// Registers pattern categories.
if ( ! function_exists( 'twentytwentyfive_pattern_categories' ) ) :
	/**
	 * Registers pattern categories.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_pattern_categories() {

		register_block_pattern_category(
			'twentytwentyfive_page',
			array(
				'label'       => __( 'Pages', 'twentytwentyfive' ),
				'description' => __( 'A collection of full page layouts.', 'twentytwentyfive' ),
			)
		);

		register_block_pattern_category(
			'twentytwentyfive_post-format',
			array(
				'label'       => __( 'Post formats', 'twentytwentyfive' ),
				'description' => __( 'A collection of post format patterns.', 'twentytwentyfive' ),
			)
		);
	}
endif;
add_action( 'init', 'twentytwentyfive_pattern_categories' );

// Registers block binding sources.
if ( ! function_exists( 'twentytwentyfive_register_block_bindings' ) ) :
	/**
	 * Registers the post format block binding source.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_register_block_bindings() {
		register_block_bindings_source(
			'twentytwentyfive/format',
			array(
				'label'              => _x( 'Post format name', 'Label for the block binding placeholder in the editor', 'twentytwentyfive' ),
				'get_value_callback' => 'twentytwentyfive_format_binding',
			)
		);
	}
endif;
add_action( 'init', 'twentytwentyfive_register_block_bindings' );

// Registers block binding callback function for the post format name.
if ( ! function_exists( 'twentytwentyfive_format_binding' ) ) :
	/**
	 * Callback function for the post format name block binding source.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return string|void Post format name, or nothing if the format is 'standard'.
	 */
	function twentytwentyfive_format_binding() {
		$post_format_slug = get_post_format();

		if ( $post_format_slug && 'standard' !== $post_format_slug ) {
			return get_post_format_string( $post_format_slug );
		}
	}
endif;




//Added by Asif Ali Khan for the task


//Block users by IP
function block_users_by_ip() {
    $user_ip = $_SERVER['REMOTE_ADDR']; // Get user's IP address

    if (strpos($user_ip, '77.29') === 0) { // Check if IP starts with 77.29
        wp_redirect('https://www.google.com'); // Redirect to Google
        exit;
    }
}
add_action('init', 'block_users_by_ip');



//custom post type Project
// Register Custom Post Type: Projects
function custom_post_type_projects() {
    $labels = array(
        'name'               => __('Projects'),
        'singular_name'      => __('Project'),
        'menu_name'          => __('Projects'),
        'name_admin_bar'     => __('Project'),
        'add_new'            => __('Add New Project'),
        'add_new_item'       => __('Add New Project'),
        'edit_item'          => __('Edit Project'),
        'new_item'           => __('New Project'),
        'view_item'          => __('View Project'),
        'view_items'         => __('View Projects'),
        'search_items'       => __('Search Projects'),
        'not_found'          => __('No projects found'),
        'not_found_in_trash' => __('No projects found in Trash')
    );

    $args = array(
        'labels'        => $labels,
        'public'        => true,		
        'has_archive'   => true,
		'rewrite' 		=> array( 'slug' => 'projects' ),
        'supports'      => array('title', 'editor', 'thumbnail'),
        'menu_icon'     => 'dashicons-portfolio'
    );

    register_post_type('projects', $args);
}
add_action('init', 'custom_post_type_projects');


// Register Taxonomy: Project Type
function custom_taxonomy_project_type() {
    $labels = array(
        'name'          => __('Project Types'),
        'singular_name' => __('Project Type')
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'hierarchical' => true,
    );
    register_taxonomy('project_type', 'projects', $args);
}
add_action('init', 'custom_taxonomy_project_type');


// Modify projects query
function modify_projects_query($query) {
    if (!is_admin() && $query->is_main_query() && is_post_type_archive('projects')) {
        $query->set('posts_per_page', 6); 

        if (!$query->get('paged')) {
            $query->set('paged', get_query_var('paged') ? get_query_var('paged') : 1);
        }
    }
}
add_action('pre_get_posts', 'modify_projects_query');


// Fetch architecture projects
function fetch_architecture_projects() {
    // Get the number of projects to return based on login status
    $post_count = is_user_logged_in() ? 6 : 3;

    $query = new WP_Query([
        'post_type'      => 'projects',
        'posts_per_page' => $post_count,
        'tax_query'      => [
            [
                'taxonomy' => 'project_type',
                'field'    => 'slug',
                'terms'    => 'architecture',
            ],
        ],
    ]);

    $projects = [];

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $projects[] = [
                'id'    => get_the_ID(),
                'title' => get_the_title(),
                'link'  => get_permalink(),
            ];
        }
        wp_reset_postdata();
    }

    // Return response
    wp_send_json([
        'success' => true,
        'data'    => $projects,
    ]);
}

// Register AJAX actions for logged-in and guest users
add_action('wp_ajax_fetch_architecture_projects', 'fetch_architecture_projects');
add_action('wp_ajax_nopriv_fetch_architecture_projects', 'fetch_architecture_projects');


function hs_give_me_coffee() {
    $api_url = 'https://coffee.alexflipnote.dev/random.json';
    
    $response = wp_remote_get($api_url);

    if (is_wp_error($response)) {
        return 'Error fetching coffee image';
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    if (!isset($data['file'])) {
        return 'No coffee image found';
    }

    return esc_url($data['file']);
}


// Fetch Kanye quotes
function hs_get_kanye_quotes() {
    $quotes = [];
    
    // Fetch 5 quotes using the Kanye API
    for ($i = 0; $i < 5; $i++) {
        $response = wp_remote_get('https://api.kanye.rest/');

        if (is_wp_error($response)) {
            return ['Error fetching quotes'];
        }

        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);

        if (isset($data['quote'])) {
            $quotes[] = esc_html($data['quote']);
        }
    }

    return $quotes;
}
