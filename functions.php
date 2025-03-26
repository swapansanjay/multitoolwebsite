<?php
/**
 * Unit Converters Child Theme Functions
 */

// Enqueue parent theme styles
function unit_converters_child_enqueue_styles() {
    wp_enqueue_style('astra-theme-css', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get('Version'));
    wp_enqueue_style('unit-converters-child-style', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), wp_get_theme()->get('Version'));
}
add_action('wp_enqueue_scripts', 'unit_converters_child_enqueue_styles');

// Enqueue custom scripts
function unit_converters_child_enqueue_scripts() {
    wp_enqueue_script('bootstrap-bundle', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', array('jquery'), '5.3.0', true);
    wp_enqueue_script('font-awesome', 'https://kit.fontawesome.com/your-font-awesome-kit.js', array(), '6.0.0', true);
    wp_enqueue_script('unit-converters-main', get_stylesheet_directory_uri() . '/js/main.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'unit_converters_child_enqueue_scripts');

// Register Custom Post Type for Tools
function register_tool_post_type() {
    $labels = array(
        'name' => 'Tools',
        'singular_name' => 'Tool',
        'menu_name' => 'Tools',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Tool',
        'edit_item' => 'Edit Tool',
        'new_item' => 'New Tool',
        'view_item' => 'View Tool',
        'search_items' => 'Search Tools',
        'not_found' => 'No tools found',
        'not_found_in_trash' => 'No tools found in Trash',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-calculator',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'rewrite' => array('slug' => 'tools'),
    );

    register_post_type('tool', $args);

    // Register Tool Categories
    register_taxonomy('tool_category', 'tool', array(
        'label' => 'Tool Categories',
        'hierarchical' => true,
        'rewrite' => array('slug' => 'tool-category'),
    ));
}
add_action('init', 'register_tool_post_type');

// Add custom meta boxes for tool settings
function add_tool_meta_boxes() {
    add_meta_box(
        'tool_settings',
        'Tool Settings',
        'tool_settings_callback',
        'tool',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_tool_meta_boxes');

// Tool settings meta box callback
function tool_settings_callback($post) {
    wp_nonce_field('tool_settings_nonce', 'tool_settings_nonce');
    
    $tool_url = get_post_meta($post->ID, '_tool_url', true);
    $tool_category = get_post_meta($post->ID, '_tool_category', true);
    ?>
    <p>
        <label for="tool_url">Tool URL:</label>
        <input type="text" id="tool_url" name="tool_url" value="<?php echo esc_attr($tool_url); ?>" class="widefat">
    </p>
    <p>
        <label for="tool_category">Tool Category:</label>
        <select id="tool_category" name="tool_category" class="widefat">
            <option value="">Select Category</option>
            <option value="length" <?php selected($tool_category, 'length'); ?>>Length</option>
            <option value="weight" <?php selected($tool_category, 'weight'); ?>>Weight</option>
            <option value="temperature" <?php selected($tool_category, 'temperature'); ?>>Temperature</option>
            <option value="area" <?php selected($tool_category, 'area'); ?>>Area</option>
            <option value="volume" <?php selected($tool_category, 'volume'); ?>>Volume</option>
            <option value="speed" <?php selected($tool_category, 'speed'); ?>>Speed</option>
            <option value="digital" <?php selected($tool_category, 'digital'); ?>>Digital</option>
            <option value="engineering" <?php selected($tool_category, 'engineering'); ?>>Engineering</option>
            <option value="text" <?php selected($tool_category, 'text'); ?>>Text</option>
            <option value="time" <?php selected($tool_category, 'time'); ?>>Time</option>
        </select>
    </p>
    <?php
}

// Save tool meta box data
function save_tool_meta_box_data($post_id) {
    if (!isset($_POST['tool_settings_nonce'])) {
        return;
    }

    if (!wp_verify_nonce($_POST['tool_settings_nonce'], 'tool_settings_nonce')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $tool_url = sanitize_text_field($_POST['tool_url']);
    $tool_category = sanitize_text_field($_POST['tool_category']);

    update_post_meta($post_id, '_tool_url', $tool_url);
    update_post_meta($post_id, '_tool_category', $tool_category);
}
add_action('save_post', 'save_tool_meta_box_data');

// Add custom shortcode for tool display
function tool_shortcode($atts) {
    $atts = shortcode_atts(array(
        'category' => '',
        'count' => -1
    ), $atts);

    $args = array(
        'post_type' => 'tool',
        'posts_per_page' => $atts['count'],
        'meta_query' => array(
            array(
                'key' => '_tool_category',
                'value' => $atts['category']
            )
        )
    );

    $query = new WP_Query($args);
    $output = '';

    if ($query->have_posts()) {
        $output .= '<div class="row">';
        while ($query->have_posts()) {
            $query->the_post();
            $tool_url = get_post_meta(get_the_ID(), '_tool_url', true);
            $output .= sprintf(
                '<div class="col-md-4 mb-4">
                    <div class="tool-card">
                        <div class="card-body">
                            <h5 class="card-title">%s</h5>
                            <p class="card-text">%s</p>
                            <a href="%s" class="btn btn-primary">Use Tool</a>
                        </div>
                    </div>
                </div>',
                get_the_title(),
                get_the_excerpt(),
                esc_url($tool_url)
            );
        }
        $output .= '</div>';
    }

    wp_reset_postdata();
    return $output;
}
add_shortcode('tools', 'tool_shortcode'); 