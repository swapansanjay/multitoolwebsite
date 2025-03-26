<?php
/**
 * Theme Customizer Settings
 */

function unit_converters_child_customize_register($wp_customize) {
    // Add section for social media links
    $wp_customize->add_section('social_media_section', array(
        'title' => __('Social Media Links', 'unit-converters-child'),
        'priority' => 30,
    ));

    // Add settings for social media links
    $social_platforms = array(
        'facebook' => __('Facebook URL', 'unit-converters-child'),
        'twitter' => __('Twitter URL', 'unit-converters-child'),
        'linkedin' => __('LinkedIn URL', 'unit-converters-child'),
        'github' => __('GitHub URL', 'unit-converters-child'),
    );

    foreach ($social_platforms as $platform => $label) {
        $wp_customize->add_setting('social_' . $platform, array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ));

        $wp_customize->add_control('social_' . $platform, array(
            'label' => $label,
            'section' => 'social_media_section',
            'type' => 'url',
        ));
    }

    // Add section for contact information
    $wp_customize->add_section('contact_section', array(
        'title' => __('Contact Information', 'unit-converters-child'),
        'priority' => 31,
    ));

    // Add setting for contact email
    $wp_customize->add_setting('contact_email', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_email',
    ));

    $wp_customize->add_control('contact_email', array(
        'label' => __('Contact Email', 'unit-converters-child'),
        'section' => 'contact_section',
        'type' => 'email',
    ));

    // Add section for theme colors
    $wp_customize->add_section('theme_colors_section', array(
        'title' => __('Theme Colors', 'unit-converters-child'),
        'priority' => 32,
    ));

    // Add setting for primary color
    $wp_customize->add_setting('primary_color', array(
        'default' => '#007bff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_color', array(
        'label' => __('Primary Color', 'unit-converters-child'),
        'section' => 'theme_colors_section',
    )));

    // Add setting for secondary color
    $wp_customize->add_setting('secondary_color', array(
        'default' => '#6c757d',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'secondary_color', array(
        'label' => __('Secondary Color', 'unit-converters-child'),
        'section' => 'theme_colors_section',
    )));

    // Add section for ad settings
    $wp_customize->add_section('ad_section', array(
        'title' => __('Advertisement Settings', 'unit-converters-child'),
        'priority' => 33,
    ));

    // Add setting for header ad code
    $wp_customize->add_setting('header_ad_code', array(
        'default' => '',
        'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control('header_ad_code', array(
        'label' => __('Header Ad Code', 'unit-converters-child'),
        'section' => 'ad_section',
        'type' => 'textarea',
        'description' => __('Enter the ad code for the header section.', 'unit-converters-child'),
    ));

    // Add setting for footer ad code
    $wp_customize->add_setting('footer_ad_code', array(
        'default' => '',
        'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control('footer_ad_code', array(
        'label' => __('Footer Ad Code', 'unit-converters-child'),
        'section' => 'ad_section',
        'type' => 'textarea',
        'description' => __('Enter the ad code for the footer section.', 'unit-converters-child'),
    ));
}
add_action('customize_register', 'unit_converters_child_customize_register');

// Output custom CSS
function unit_converters_child_customize_css() {
    ?>
    <style type="text/css">
        :root {
            --primary-color: <?php echo esc_attr(get_theme_mod('primary_color', '#007bff')); ?>;
            --secondary-color: <?php echo esc_attr(get_theme_mod('secondary_color', '#6c757d')); ?>;
        }
    </style>
    <?php
}
add_action('wp_head', 'unit_converters_child_customize_css'); 