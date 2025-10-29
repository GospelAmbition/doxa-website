<?php
/**
 * Gospel Ambition Theme Functions
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

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
    // Get theme version from style.css
    $theme_version = wp_get_theme()->get('Version');

    // Enqueue theme stylesheet
    wp_enqueue_style('gospel-ambition-style', get_stylesheet_uri(), array(), $theme_version);

    // Enqueue Google Fonts
    wp_enqueue_style('gospel-ambition-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap', array(), null);

    // Enqueue theme JavaScript
    wp_enqueue_script('gospel-ambition-script', get_template_directory_uri() . '/js/theme.js', array('jquery'), $theme_version, true);


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
    // Only run for page post type
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
