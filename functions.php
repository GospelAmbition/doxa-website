<?php
 /**
 * Gospel Ambition Theme Functions
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

function coming_soon_redirect() {
    $url = $_SERVER['REQUEST_URI'];
    if ( !is_admin() && !str_contains($url, 'admin') && !is_page( 'coming-soon' ) && !is_user_logged_in() ) {
        wp_redirect( home_url( '/coming-soon' ) );
        exit;
    }
}
add_action( 'template_redirect', 'coming_soon_redirect' );

/**
 * Theme Setup
 */
function gospel_ambition_setup() {
    // Add theme support for various features
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    // Add custom image sizes
    add_image_size('hero-image', 1200, 600, true);
    add_image_size('post-thumbnail', 400, 250, true);

    // Register navigation menus
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'gospel-ambition'),
        'secondary' => esc_html__('Secondary Menu', 'gospel-ambition'),
        'footer' => esc_html__('Footer Menu', 'gospel-ambition'),
    ));

    // Add support for custom logo
    add_theme_support('custom-logo', array(
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ));
}
add_action('after_setup_theme', 'gospel_ambition_setup');

/**
 * Enqueue scripts and styles
 */
function gospel_ambition_scripts() {
    // Enqueue theme stylesheet
    wp_enqueue_style('bebas-neue-font', get_template_directory_uri() . '/assets/fonts/BebasNeue/stylesheet.css', array(), filemtime(get_template_directory() . '/assets/fonts/BebasNeue/stylesheet.css'));
    wp_enqueue_style('brandon-grotesque-font', get_template_directory_uri() . '/assets/fonts/Brandon_Grotesque/stylesheet.css', array(), filemtime(get_template_directory() . '/assets/fonts/Brandon_Grotesque/stylesheet.css'));
    wp_enqueue_style('poppins-font', get_template_directory_uri() . '/assets/fonts/Poppins/stylesheet.css', array(), filemtime(get_template_directory() . '/assets/fonts/Poppins/stylesheet.css'));
    wp_enqueue_style('gospel-ambition-style', get_template_directory_uri() . '/assets/dist/style.css', array(), filemtime(get_template_directory() . '/assets/dist/style.css'));

    // Enqueue Google Fonts
    wp_enqueue_style('gospel-ambition-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap', array(), null);

    // Enqueue theme JavaScript
    wp_enqueue_script('gospel-ambition-script', get_template_directory_uri() . '/js/theme.js', array(), filemtime(get_template_directory() . '/js/theme.js'), true);

    // unenqueue jquery
    wp_dequeue_script('jquery');
    if ( is_page('research') || is_page('pray') || is_page('adopt') ) {
        wp_enqueue_script('uupgs-script', get_template_directory_uri() . '/assets/dist/main2.js', array(), filemtime(get_template_directory() . '/assets/dist/main2.js'), true);
        wp_localize_script('uupgs-script', 'uupgsData', array(
            'images_url' => trailingslashit( get_template_directory_uri() ) . 'assets/images',
            'icons_url' => trailingslashit( get_template_directory_uri() ) . 'assets/icons',
            'translations' => [
                'click_twice' => 'Click again to interact with map'
            ],
        ));
    }

}
add_action('wp_enqueue_scripts', 'gospel_ambition_scripts');

/**
 * Register widget areas
 */
function gospel_ambition_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'gospel-ambition'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'gospel-ambition'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer Widgets', 'gospel-ambition'),
        'id'            => 'footer-widgets',
        'description'   => esc_html__('Add widgets to the footer area.', 'gospel-ambition'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'gospel_ambition_widgets_init');

/**
 * Custom excerpt length
 */
function gospel_ambition_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'gospel_ambition_excerpt_length');

/**
 * Custom excerpt more text
 */
function gospel_ambition_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'gospel_ambition_excerpt_more');



/**
 * Custom pagination
 */
function gospel_ambition_pagination() {
    global $wp_query;

    $big = 999999999;

    echo paginate_links(array(
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
        'prev_text' => '&laquo; Previous',
        'next_text' => 'Next &raquo;',
        'type' => 'list',
        'end_size' => 3,
        'mid_size' => 3
    ));
}

/**
 * Remove unnecessary WordPress features for performance
 */
function gospel_ambition_cleanup() {
    // Remove WordPress emoji scripts
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');

    // Remove WordPress generator meta tag
    remove_action('wp_head', 'wp_generator');

    // Remove RSD link
    remove_action('wp_head', 'rsd_link');

    // Remove Windows Live Writer
    remove_action('wp_head', 'wlwmanifest_link');

    // Remove feed links
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'feed_links', 2);
}
add_action('init', 'gospel_ambition_cleanup');

/**
 * Disable comments entirely
 */
function gospel_ambition_disable_comments() {
    // Disable comments for all post types
    $post_types = get_post_types();
    foreach ($post_types as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
}
add_action('admin_init', 'gospel_ambition_disable_comments');

// Close comments on all posts
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);

// Remove comments page in menu
function gospel_ambition_remove_comments_page() {
    remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'gospel_ambition_remove_comments_page');

// Remove comments links from admin bar
function gospel_ambition_remove_comments_admin_bar() {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
}
add_action('init', 'gospel_ambition_remove_comments_admin_bar');

/**
 * Add Custom Page Order Meta Box
 */
function add_page_order_meta_box() {
    add_meta_box(
        'page-order',
        'Page Order',
        'page_order_meta_box_callback',
        'page',
        'side',
        'high'
    );
}
add_action('add_meta_boxes', 'add_page_order_meta_box');

/**
 * Page Order Meta Box Callback
 */
function page_order_meta_box_callback($post) {
    wp_nonce_field('save_page_order', 'page_order_nonce');
    $order = $post->menu_order;

    // Use 10 as default for new pages
    if ($order == 0 && $post->post_status == 'auto-draft') {
        $order = 10;
    }
    ?>
    <p>
        <label for="page_order" style="font-weight: bold;">Order:</label><br>
        <input type="number" id="page_order" name="page_order" value="<?php echo esc_attr($order); ?>" min="0" style="width: 100%;" />
    </p>
    <p style="font-size: 12px; color: #666;">
        Lower numbers appear first in the sidebar menu. Default is 10. Pages with the same order are sorted alphabetically.
    </p>
    <?php
}

/**
 * Save Page Order Meta Box Data
 */
function save_page_order($post_id) {
    // Only run for page post type
    if (get_post_type($post_id) !== 'page') {
        return;
    }

    // Verify nonce
    if (!isset($_POST['page_order_nonce']) || !wp_verify_nonce($_POST['page_order_nonce'], 'save_page_order')) {
        return;
    }

    // Skip autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check user permissions
    if (!current_user_can('edit_page', $post_id)) {
        return;
    }

    // Save the order
    if (isset($_POST['page_order'])) {
        $order = intval($_POST['page_order']);

        // Prevent infinite loop by removing the action before updating
        remove_action('save_post', 'save_page_order');

        // Update menu_order
        wp_update_post(array(
            'ID' => $post_id,
            'menu_order' => $order
        ));

        // Re-add the action after updating
        add_action('save_post', 'save_page_order');
    }
}
add_action('save_post', 'save_page_order');

/**
 * Set default menu_order for new pages
 */
function set_default_page_order($post_id, $post, $update) {
    // Only for new pages (not updates)
    if ($update || $post->post_type !== 'page') {
        return;
    }

    // If menu_order is 0 (default), set it to 10
    if ($post->menu_order == 0) {
        remove_action('wp_insert_post', 'set_default_page_order', 10);

        wp_update_post(array(
            'ID' => $post_id,
            'menu_order' => 10
        ));

        add_action('wp_insert_post', 'set_default_page_order', 10, 3);
    }
}
add_action('wp_insert_post', 'set_default_page_order', 10, 3);

/**
 * Add Custom CSS Meta Box for Pages
 */
function add_page_custom_css_meta_box() {
    add_meta_box(
        'page-custom-css',
        'Custom CSS',
        'page_custom_css_meta_box_callback',
        'page',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'add_page_custom_css_meta_box');

/**
 * Custom CSS Meta Box Callback
 */
function page_custom_css_meta_box_callback($post) {
    wp_nonce_field('save_page_custom_css', 'page_custom_css_nonce');
    $custom_css = get_post_meta($post->ID, '_page_custom_css', true);
    ?>
    <p>
        <label for="page_custom_css" style="font-weight: bold;">Add custom CSS for this page:</label>
    </p>
    <textarea
        id="page_custom_css"
        name="page_custom_css"
        rows="10"
        style="width: 100%; font-family: 'Courier New', monospace; font-size: 12px;"
        placeholder="/* Enter your custom CSS here */&#10;.my-custom-class {&#10;    color: #bd1218;&#10;    font-size: 18px;&#10;}"
    ><?php echo esc_textarea($custom_css); ?></textarea>
    <p style="margin-top: 10px; font-size: 12px; color: #666;">
        <strong>Note:</strong> This CSS will only apply to this specific page. Don't include &lt;style&gt; tags.
    </p>
    <?php
}

/**
 * Save Custom CSS Meta Box Data
 */
function save_page_custom_css($post_id) {
    // Only runJan 17, 2026 for page post type
    if (get_post_type($post_id) !== 'page') {
        return;
    }

    // Verify nonce
    if (!isset($_POST['page_custom_css_nonce']) || !wp_verify_nonce($_POST['page_custom_css_nonce'], 'save_page_custom_css')) {
        return;
    }

    // Skip autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check user permissions
    if (!current_user_can('edit_page', $post_id)) {
        return;
    }

    // Save the custom CSS
    if (isset($_POST['page_custom_css'])) {
        $custom_css = wp_strip_all_tags($_POST['page_custom_css']);
        update_post_meta($post_id, '_page_custom_css', $custom_css);
    } else {
        delete_post_meta($post_id, '_page_custom_css');
    }
}
add_action('save_post', 'save_page_custom_css');

/**
 * Output Custom CSS in Page Head
 */
function output_page_custom_css() {
    // Only on single pages
    if (!is_page()) {
        return;
    }

    global $post;
    $custom_css = get_post_meta($post->ID, '_page_custom_css', true);

    if (!empty($custom_css)) {
        echo '<style type="text/css" id="page-custom-css-' . $post->ID . '">' . "\n";
        echo '/* Custom CSS for page: ' . get_the_title($post->ID) . ' */' . "\n";
        echo $custom_css . "\n";
        echo '</style>' . "\n";
    }
}
add_action('wp_head', 'output_page_custom_css');

function custom_uupgs_rewrite_rules() {
    add_rewrite_rule(
        '^research/([^/]+)/?$',
        'index.php?pagename=research&uupg_slug=$matches[1]',
        'top'
    );
}
add_action('init', 'custom_uupgs_rewrite_rules');

function custom_adoption_form_rewrite_rules() {
    add_rewrite_rule(
        '^adopt/([^/]+)/?$',
        'index.php?pagename=adopt&uupg_slug=$matches[1]',
        'top'
    );
}
add_action('init', 'custom_adoption_form_rewrite_rules');

// Register the query variable
function custom_uupgs_query_vars($vars) {
    $vars[] = 'uupg_slug';
    return $vars;
}
add_filter('query_vars', 'custom_uupgs_query_vars');

function custom_uupgs_template($template) {
    $uupg_slug = get_query_var('uupg_slug');

    if ($uupg_slug && is_page('research')) {
        $custom_template = locate_template('template-uupg-detail.php');
        if ($custom_template) {
            return $custom_template;
        }
    }

    return $template;
}
add_filter('template_include', 'custom_uupgs_template');

function custom_adoption_form_template($template) {
    $uupg_slug = get_query_var('uupg_slug');

    if ($uupg_slug && is_page('adopt')) {
        $custom_template = locate_template('template-adoption-form.php');
        if ($custom_template) {
            return $custom_template;
        }
    }

    return $template;
}
add_filter('template_include', 'custom_adoption_form_template');

function get_uupg_by_slug( $slug ) {
    $api_url = 'https://uupg.doxa.life/wp-json/dt-public/disciple-tools-people-groups-api/v1/detail/' . urlencode($slug);
    //$api_url = 'http://uupg.doxa.test/wp-json/dt-public/disciple-tools-people-groups-api/v1/detail/' . urlencode($slug);

    $response = wp_remote_get($api_url);

    if (is_wp_error($response)) {
        return [
            'api_url' => $api_url,
            'response' => $response,
        ];
    }
    $data = json_decode($response['body'], true);
    return $data;
}

function get_uupg_by_post_id( $post_id ) {
    $site_url = get_site_url();


    $site_parts = explode('://', $site_url);
    $site_domain = $site_parts[1];
    $protocol = $site_parts[0];
    $api_url = $protocol . '://' . 'uupg.' . $site_domain . '/wp-json/dt-public/disciple-tools-people-groups-api/v1/';
    $api_url = $api_url . 'detail/' . $post_id;

    $response = wp_remote_get($api_url);
    if (is_wp_error($response)) {
        return [
            'api_url' => $api_url,
            'response' => $response,
        ];
    }
    $data = json_decode($response['body'], true);

    return $data;
}

function doxa_get_wagf_regions() {
    return [
        [
            'value' => 'africa',
            'label' => __( 'Africa', 'doxa-website' )
        ],
        [
            'value' => 'asia',
            'label' => __( 'Asia', 'doxa-website' )
        ],
        [
            'value' => 'europe',
            'label' => __( 'Europe', 'doxa-website' )
        ],
        [
            'value' => 'latin_america_&_caribbean',
            'label' => __( 'Latin America & Caribbean', 'doxa-website' )
        ],
        [
            'value' => 'middle_east',
            'label' => __( 'Middle East', 'doxa-website' )
        ],
        [
            'value' => 'na',
            'label' => __( 'N/A', 'doxa-website' )
        ],
        [
            'value' => 'north_america_&_non-spanish_caribbean',
            'label' => __( 'North America & Non-Spanish Caribbean', 'doxa-website' )
        ],
        [
            'value' => 'oceania',
            'label' => __( 'Oceania', 'doxa-website' )
        ]
    ];
}

function doxa_get_wagf_blocks() {
    return [
        [
            'value' =>  'andean',
            'label' =>  __( 'Andean', 'doxa-website' )
        ],
        [
            'value' =>  'brazil',
            'label' =>  __( 'Brazil', 'doxa-website' )
        ],
        [
            'value' =>  'central_africa',
            'label' =>  __( 'Central Africa', 'doxa-website' )
        ],
        [
            'value' =>  'central_america',
            'label' =>  __( 'Central America', 'doxa-website' )
        ],
        [
            'value' =>  'central_asia',
            'label' =>  __( 'Central Asia', 'doxa-website' )
        ],
        [
            'value' =>  'central_europe',
            'label' =>  __( 'Central Europe', 'doxa-website' )
        ],
        [
            'value' =>  'east_africa',
            'label' =>  __( 'East Africa', 'doxa-website' )
        ],
        [
            'value' =>  'east_europe',
            'label' =>  __( 'East Europe', 'doxa-website' )
        ],
        [
            'value' =>  'islands_of_east_africa',
            'label' =>  __( 'Islands of East Africa', 'doxa-website' )
        ],
        [
            'value' =>  'mexico_&_latin_america',
            'label' =>  __( 'Mexico & Latin America', 'doxa-website' )
        ],
        [
            'value' =>  'middle_east',
            'label' =>  __( 'Middle East', 'doxa-website' )
        ],
        [
            'value' =>  'na',
            'label' =>  __( 'N/A', 'doxa-website' )
        ],
        [
            'value' =>  'non-spanish_caribbean',
            'label' =>  __( 'Non-Spanish Caribbean', 'doxa-website' )
        ],
        [
            'value' =>  'north_asia',
            'label' =>  __( 'North Asia', 'doxa-website' )
        ],
        [
            'value' =>  'north_east_asia',
            'label' =>  __( 'North East Asia', 'doxa-website' )
        ],
        [
            'value' =>  'north_europe',
            'label' =>  __( 'North Europe', 'doxa-website' )
        ],
        [
            'value' =>  'oceania',
            'label' =>  __( 'Oceania', 'doxa-website' )
        ],
        [
            'value' =>  'south_asia',
            'label' =>  __( 'South Asia', 'doxa-website' )
        ],
        [
            'value' =>  'south_cone',
            'label' =>  __( 'South Cone', 'doxa-website' )
        ],
        [
            'value' =>  'south_east_asia',
            'label' =>  __( 'South East Asia', 'doxa-website' )
        ],
        [
            'value' =>  'south_europe',
            'label' =>  __( 'South Europe', 'doxa-website' )
        ],
        [
            'value' =>  'southern_africa',
            'label' =>  __( 'Southern Africa', 'doxa-website' )
        ],
        [
            'value' =>  'the_balkans',
            'label' =>  __( 'The Balkans', 'doxa-website' )
        ],
        [
            'value' =>  'west_africa',
            'label' =>  __( 'West Africa', 'doxa-website' )
        ],
        [
            'value' =>  'west_europe',
            'label' =>  __( 'West Europe', 'doxa-website' )
        ]
    ];
}

function doxa_get_countries() {
    $countries = [
        [
            "value" => "VAT",
            "label" => "Vatican City"
        ],
        [
            "value" => "MAC",
            "label" => "Macao"
        ],
        [
            "value" => "HKG",
            "label" => "Hong Kong"
        ],
        [
            "value" => "KEN",
            "label" => "Kenya"
        ],
        [
            "value" => "CAN",
            "label" => "Canada"
        ],
        [
            "value" => "DEU",
            "label" => "Germany"
        ],
        [
            "value" => "USA",
            "label" => "the United States"
        ],
        [
            "value" => "SPM",
            "label" => "Saint Pierre and Miquelon"
        ],
        [
            "value" => "ESH",
            "label" => "Western Sahara"
        ],
        [
            "value" => "FLK",
            "label" => "Falkland Islands (Islas Malvinas)"
        ],
        [
            "value" => "ZAF",
            "label" => "South Africa"
        ],
        [
            "value" => "GIN",
            "label" => "Guinea"
        ],
        [
            "value" => "ESP",
            "label" => "Spain"
        ],
        [
            "value" => "MMR",
            "label" => "Myanmar"
        ],
        [
            "value" => "BGD",
            "label" => "Bangladesh"
        ],
        [
            "value" => "MOZ",
            "label" => "Mozambique"
        ],
        [
            "value" => "MUS",
            "label" => "Mauritius"
        ],
        [
            "value" => "IND",
            "label" => "India"
        ],
        [
            "value" => "PSE",
            "label" => "Palestine"
        ],
        [
            "value" => "PAK",
            "label" => "Pakistan"
        ],
        [
            "value" => "GRC",
            "label" => "Greece"
        ],
        [
            "value" => "NPL",
            "label" => "Nepal"
        ],
        [
            "value" => "LKA",
            "label" => "Sri Lanka"
        ],
        [
            "value" => "FRA",
            "label" => "France"
        ],
        [
            "value" => "BRA",
            "label" => "Brazil"
        ],
        [
            "value" => "HUN",
            "label" => "Hungary"
        ],
        [
            "value" => "UGA",
            "label" => "Uganda"
        ],
        [
            "value" => "KOR",
            "label" => "South Korea"
        ],
        [
            "value" => "GBR",
            "label" => "the United Kingdom"
        ],
        [
            "value" => "LAO",
            "label" => "Laos"
        ],
        [
            "value" => "ERI",
            "label" => "Eritrea"
        ],
        [
            "value" => "EGY",
            "label" => "Egypt"
        ],
        [
            "value" => "MRT",
            "label" => "Mauritania"
        ],
        [
            "value" => "ISL",
            "label" => "Iceland"
        ],
        [
            "value" => "KAZ",
            "label" => "Kazakhstan"
        ],
        [
            "value" => "MAR",
            "label" => "Morocco"
        ],
        [
            "value" => "ETH",
            "label" => "Ethiopia"
        ],
        [
            "value" => "IRQ",
            "label" => "Iraq"
        ],
        [
            "value" => "OMN",
            "label" => "Oman"
        ],
        [
            "value" => "ITA",
            "label" => "Italy"
        ],
        [
            "value" => "JOR",
            "label" => "Jordan"
        ],
        [
            "value" => "MKD",
            "label" => "North Macedonia"
        ],
        [
            "value" => "TUR",
            "label" => "Turkiye"
        ],
        [
            "value" => "LBN",
            "label" => "Lebanon"
        ],
        [
            "value" => "JPN",
            "label" => "Japan"
        ],
        [
            "value" => "BHR",
            "label" => "Bahrain"
        ],
        [
            "value" => "AFG",
            "label" => "Afghanistan"
        ],
        [
            "value" => "SAU",
            "label" => "Saudi Arabia"
        ],
        [
            "value" => "IRN",
            "label" => "Iran"
        ],
        [
            "value" => "KGZ",
            "label" => "Kyrgyzstan"
        ],
        [
            "value" => "TJK",
            "label" => "Tajikistan"
        ],
        [
            "value" => "RUS",
            "label" => "the Russian Federation"
        ],
        [
            "value" => "MDG",
            "label" => "Madagascar"
        ],
        [
            "value" => "SSD",
            "label" => "South Sudan"
        ],
        [
            "value" => "THA",
            "label" => "Thailand"
        ],
        [
            "value" => "UZB",
            "label" => "Uzbekistan"
        ],
        [
            "value" => "ARM",
            "label" => "Armenia"
        ],
        [
            "value" => "MYS",
            "label" => "Malaysia"
        ],
        [
            "value" => "GEO",
            "label" => "Georgia"
        ],
        [
            "value" => "SEN",
            "label" => "Senegal"
        ],
        [
            "value" => "BTN",
            "label" => "Bhutan"
        ],
        [
            "value" => "ZMB",
            "label" => "Zambia"
        ],
        [
            "value" => "CYP",
            "label" => "Cyprus"
        ],
        [
            "value" => "ISR",
            "label" => "Israel"
        ],
        [
            "value" => "GMB",
            "label" => "The Gambia"
        ],
        [
            "value" => "PHL",
            "label" => "the Philippines"
        ],
        [
            "value" => "TTO",
            "label" => "Trinidad and Tobago"
        ],
        [
            "value" => "GLP",
            "label" => "Guadeloupe"
        ],
        [
            "value" => "TKM",
            "label" => "Turkmenistan"
        ],
        [
            "value" => "MTQ",
            "label" => "Martinique"
        ],
        [
            "value" => "MWI",
            "label" => "Malawi"
        ],
        [
            "value" => "CHN",
            "label" => "China"
        ],
        [
            "value" => "REU",
            "label" => "Reunion"
        ],
        [
            "value" => "NLD",
            "label" => "the Netherlands"
        ],
        [
            "value" => "SUR",
            "label" => "Suriname"
        ],
        [
            "value" => "ATG",
            "label" => "Antigua and Barbuda"
        ],
        [
            "value" => "BWA",
            "label" => "Botswana"
        ],
        [
            "value" => "DZA",
            "label" => "Algeria"
        ],
        [
            "value" => "YEM",
            "label" => "Yemen"
        ],
        [
            "value" => "HRV",
            "label" => "Croatia"
        ],
        [
            "value" => "GNB",
            "label" => "Guinea-Bissau"
        ],
        [
            "value" => "AZE",
            "label" => "Azerbaijan"
        ],
        [
            "value" => "QAT",
            "label" => "Qatar"
        ],
        [
            "value" => "BEL",
            "label" => "Belgium"
        ],
        [
            "value" => "ARE",
            "label" => "the United Arab Emirates"
        ],
        [
            "value" => "DJI",
            "label" => "Djibouti"
        ],
        [
            "value" => "GTM",
            "label" => "Guatemala"
        ],
        [
            "value" => "CHL",
            "label" => "Chile"
        ],
        [
            "value" => "GUY",
            "label" => "Guyana"
        ],
        [
            "value" => "GRD",
            "label" => "Grenada"
        ],
        [
            "value" => "ARG",
            "label" => "Argentina"
        ],
        [
            "value" => "VEN",
            "label" => "Venezuela"
        ],
        [
            "value" => "TCD",
            "label" => "Chad"
        ],
        [
            "value" => "LBY",
            "label" => "Libya"
        ],
        [
            "value" => "SYC",
            "label" => "Seychelles"
        ],
        [
            "value" => "TZA",
            "label" => "Tanzania"
        ],
        [
            "value" => "RWA",
            "label" => "Rwanda"
        ],
        [
            "value" => "BDI",
            "label" => "Burundi"
        ],
        [
            "value" => "DNK",
            "label" => "Denmark"
        ],
        [
            "value" => "ZWE",
            "label" => "Zimbabwe"
        ],
        [
            "value" => "NIC",
            "label" => "Nicaragua"
        ],
        [
            "value" => "GUF",
            "label" => "French Guiana"
        ],
        [
            "value" => "JAM",
            "label" => "Jamaica"
        ],
        [
            "value" => "PAN",
            "label" => "Panama"
        ],
        [
            "value" => "IDN",
            "label" => "Indonesia"
        ],
        [
            "value" => "KWT",
            "label" => "Kuwait"
        ],
        [
            "value" => "ROU",
            "label" => "Romania"
        ],
        [
            "value" => "BGR",
            "label" => "Bulgaria"
        ],
        [
            "value" => "BIH",
            "label" => "Bosnia and Herzegovina"
        ],
        [
            "value" => "SDN",
            "label" => "Sudan"
        ],
        [
            "value" => "FIN",
            "label" => "Finland"
        ],
        [
            "value" => "UKR",
            "label" => "Ukraine"
        ],
        [
            "value" => "VCT",
            "label" => "Saint Vincent and the Grenadines"
        ],
        [
            "value" => "BLZ",
            "label" => "Belize"
        ],
        [
            "value" => "LCA",
            "label" => "Saint Lucia"
        ],
        [
            "value" => "BRB",
            "label" => "Barbados"
        ],
        [
            "value" => "SOM",
            "label" => "Somalia"
        ],
        [
            "value" => "SVN",
            "label" => "Slovenia"
        ],
        [
            "value" => "COL",
            "label" => "Colombia"
        ],
        [
            "value" => "PER",
            "label" => "Peru"
        ],
        [
            "value" => "ECU",
            "label" => "Ecuador"
        ],
        [
            "value" => "TWN",
            "label" => "Taiwan"
        ],
        [
            "value" => "MLT",
            "label" => "Malta"
        ],
        [
            "value" => "SWE",
            "label" => "Sweden"
        ],
        [
            "value" => "AUT",
            "label" => "Austria"
        ],
        [
            "value" => "DMA",
            "label" => "Dominica"
        ],
        [
            "value" => "VNM",
            "label" => "Vietnam"
        ],
        [
            "value" => "MNG",
            "label" => "Mongolia"
        ],
        [
            "value" => "MDA",
            "label" => "Moldova"
        ],
        [
            "value" => "SGP",
            "label" => "Singapore"
        ],
        [
            "value" => "POL",
            "label" => "Poland"
        ],
        [
            "value" => "LVA",
            "label" => "Latvia"
        ],
        [
            "value" => "LTU",
            "label" => "Lithuania"
        ],
        [
            "value" => "NOR",
            "label" => "Norway"
        ],
        [
            "value" => "CZE",
            "label" => "the Czech Republic"
        ],
        [
            "value" => "PRY",
            "label" => "Paraguay"
        ],
        [
            "value" => "BOL",
            "label" => "Bolivia"
        ],
        [
            "value" => "CHE",
            "label" => "Switzerland"
        ],
        [
            "value" => "PRT",
            "label" => "Portugal"
        ],
        [
            "value" => "CUB",
            "label" => "Cuba"
        ],
        [
            "value" => "BHS",
            "label" => "The Bahamas"
        ],
        [
            "value" => "HTI",
            "label" => "Haiti"
        ],
        [
            "value" => "CUW",
            "label" => "Curaçao"
        ],
        [
            "value" => "DOM",
            "label" => "Dominican Republic"
        ],
        [
            "value" => "BLR",
            "label" => "Belarus"
        ],
        [
            "value" => "CRI",
            "label" => "Costa Rica"
        ],
        [
            "value" => "BRN",
            "label" => "Brunei"
        ],
        [
            "value" => "HND",
            "label" => "Honduras"
        ],
        [
            "value" => "MAF",
            "label" => "Saint Martin"
        ],
        [
            "value" => "IRL",
            "label" => "Ireland"
        ],
        [
            "value" => "BES",
            "label" => "Bonaire, Sint Eustatius, and Saba"
        ],
        [
            "value" => "MEX",
            "label" => "Mexico"
        ],
        [
            "value" => "KOS",
            "label" => "Kosovo"
        ],
        [
            "value" => "AUS",
            "label" => "Australia"
        ],
        [
            "value" => "PNG",
            "label" => "Papua New Guinea"
        ],
        [
            "value" => "ASM",
            "label" => "American Samoa"
        ],
        [
            "value" => "NGA",
            "label" => "Nigeria"
        ],
        [
            "value" => "BEN",
            "label" => "Benin"
        ],
        [
            "value" => "MLI",
            "label" => "Mali"
        ],
        [
            "value" => "AGO",
            "label" => "Angola"
        ],
        [
            "value" => "COD",
            "label" => "the Democratic Republic of the Congo"
        ],
        [
            "value" => "SLE",
            "label" => "Sierra Leone"
        ],
        [
            "value" => "TGO",
            "label" => "Togo"
        ],
        [
            "value" => "CMR",
            "label" => "Cameroon"
        ],
        [
            "value" => "SYR",
            "label" => "Syria"
        ],
        [
            "value" => "NER",
            "label" => "Niger"
        ],
        [
            "value" => "COG",
            "label" => "the Republic of the Congo"
        ],
        [
            "value" => "KHM",
            "label" => "Cambodia"
        ],
        [
            "value" => "GHA",
            "label" => "Ghana"
        ],
        [
            "value" => "MYT",
            "label" => "Mayotte"
        ],
        [
            "value" => "CAF",
            "label" => "Central African Republic"
        ],
        [
            "value" => "NFK",
            "label" => "Norfolk Island"
        ],
        [
            "value" => "MNP",
            "label" => "the Northern Mariana Islands"
        ],
        [
            "value" => "TLS",
            "label" => "Timor-Leste"
        ],
        [
            "value" => "GUM",
            "label" => "Guam"
        ],
        [
            "value" => "ALB",
            "label" => "Albania"
        ],
        [
            "value" => "NZL",
            "label" => "New Zealand"
        ],
        [
            "value" => "NCL",
            "label" => "New Caledonia"
        ],
        [
            "value" => "VUT",
            "label" => "Vanuatu"
        ],
        [
            "value" => "LBR",
            "label" => "Liberia"
        ],
        [
            "value" => "CIV",
            "label" => "Côte d’Ivoire"
        ],
        [
            "value" => "CXR",
            "label" => "Christmas Island"
        ],
        [
            "value" => "TUN",
            "label" => "Tunisia"
        ],
        [
            "value" => "BFA",
            "label" => "Burkina Faso"
        ],
        [
            "value" => "SLB",
            "label" => "the Solomon Islands"
        ],
        [
            "value" => "NAM",
            "label" => "Namibia"
        ],
        [
            "value" => "NRU",
            "label" => "Nauru"
        ],
        [
            "value" => "PYF",
            "label" => "French Polynesia"
        ],
        [
            "value" => "TCA",
            "label" => "the Turks and Caicos Islands"
        ],
        [
            "value" => "MSR",
            "label" => "Montserrat"
        ],
        [
            "value" => "ABW",
            "label" => "Aruba"
        ],
        [
            "value" => "SMR",
            "label" => "San Marino"
        ],
        [
            "value" => "LIE",
            "label" => "Liechtenstein"
        ],
        [
            "value" => "PRK",
            "label" => "North Korea"
        ],
        [
            "value" => "MNE",
            "label" => "Montenegro"
        ],
        [
            "value" => "GAB",
            "label" => "Gabon"
        ],
        [
            "value" => "GNQ",
            "label" => "Equatorial Guinea"
        ],
        [
            "value" => "COK",
            "label" => "Cook Islands"
        ],
        [
            "value" => "LSO",
            "label" => "Lesotho"
        ],
        [
            "value" => "CPV",
            "label" => "Cabo Verde"
        ],
        [
            "value" => "FJI",
            "label" => "Fiji"
        ],
        [
            "value" => "STP",
            "label" => "Sao Tome and Principe"
        ],
        [
            "value" => "SWZ",
            "label" => "Eswatini"
        ],
        [
            "value" => "TUV",
            "label" => "Tuvalu"
        ],
        [
            "value" => "PLW",
            "label" => "Palau"
        ],
        [
            "value" => "FSM",
            "label" => "the Federated States of Micronesia"
        ],
        [
            "value" => "BLM",
            "label" => "Saint Barthelemy"
        ],
        [
            "value" => "WSM",
            "label" => "Samoa"
        ],
        [
            "value" => "SXM",
            "label" => "Sint Maarten"
        ],
        [
            "value" => "WLF",
            "label" => "Wallis and Futuna"
        ],
        [
            "value" => "SLV",
            "label" => "El Salvador"
        ],
        [
            "value" => "EST",
            "label" => "Estonia"
        ],
        [
            "value" => "MHL",
            "label" => "the Marshall Islands"
        ],
        [
            "value" => "SVK",
            "label" => "Slovakia"
        ],
        [
            "value" => "VGB",
            "label" => "the British Virgin Islands"
        ],
        [
            "value" => "CYM",
            "label" => "Cayman Islands"
        ],
        [
            "value" => "PRI",
            "label" => "Puerto Rico"
        ],
        [
            "value" => "SRB",
            "label" => "Serbia"
        ],
        [
            "value" => "GIB",
            "label" => "Gibraltar"
        ],
        [
            "value" => "MCO",
            "label" => "Monaco"
        ],
        [
            "value" => "LUX",
            "label" => "Luxembourg"
        ],
        [
            "value" => "VIR",
            "label" => "the Virgin Islands"
        ],
        [
            "value" => "GGY",
            "label" => "Guernsey"
        ],
        [
            "value" => "JEY",
            "label" => "Jersey"
        ],
        [
            "value" => "COM",
            "label" => "Comoros"
        ],
        [
            "value" => "MDV",
            "label" => "the Maldives"
        ],
        [
            "value" => "KIR",
            "label" => "Kiribati"
        ],
        [
            "value" => "NIU",
            "label" => "Niue"
        ],
        [
            "value" => "CCK",
            "label" => "Cocos (Keeling) Islands"
        ],
        [
            "value" => "AIA",
            "label" => "Anguilla"
        ],
        [
            "value" => "SJM",
            "label" => "Svalbard"
        ],
        [
            "value" => "SHN",
            "label" => "Saint Helena, Ascension, and Tristan da Cunha"
        ],
        [
            "value" => "TKL",
            "label" => "Tokelau"
        ],
        [
            "value" => "BMU",
            "label" => "Bermuda"
        ],
        [
            "value" => "FRO",
            "label" => "Faroe Islands"
        ],
        [
            "value" => "TON",
            "label" => "Tonga"
        ],
        [
            "value" => "KNA",
            "label" => "Saint Kitts and Nevis"
        ],
        [
            "value" => "GRL",
            "label" => "Greenland"
        ],
        [
            "value" => "AND",
            "label" => "Andorra"
        ],
        [
            "value" => "IMN",
            "label" => "Isle of Man"
        ],
        [
            "value" => "PCN",
            "label" => "the Pitcairn Islands"
        ],
        [
            "value" => "URY",
            "label" => "Uruguay"
        ]
    ];

    usort($countries, function($a, $b) {
        return strcmp($a['label'], $b['label']);
    });

    return $countries;
}

/**
 * Load theme functions
 */
require_once get_template_directory() . '/functions/contact-rest-api.php';
require_once get_template_directory() . '/functions/adopt-rest-api.php';