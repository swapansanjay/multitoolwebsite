<?php
/**
 * The footer for our theme
 */
?>

<!-- Footer -->
<footer class="bg-dark text-light py-5">
    <div class="container">
        <div class="row">
            <!-- About Section -->
            <div class="col-md-4 mb-4">
                <h5 class="mb-3"><?php esc_html_e('About Unit Converters', 'unit-converters-child'); ?></h5>
                <p class="text-muted"><?php esc_html_e('Free online unit converter that converts common units of measurement, temperature, mass and more. Use our free unit converter to calculate and convert between different units of measurement.', 'unit-converters-child'); ?></p>
                <a href="<?php echo esc_url(get_permalink(get_page_by_path('about-us'))); ?>" class="btn btn-outline-light btn-sm"><?php esc_html_e('Learn More', 'unit-converters-child'); ?></a>
            </div>
            
            <!-- Quick Links -->
            <div class="col-md-4 mb-4">
                <h5 class="mb-3"><?php esc_html_e('Quick Links', 'unit-converters-child'); ?></h5>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'container' => false,
                    'menu_class' => 'list-unstyled',
                    'fallback_cb' => false,
                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'depth' => 1
                ));
                ?>
            </div>
            
            <!-- Contact & Social -->
            <div class="col-md-4 mb-4">
                <h5 class="mb-3"><?php esc_html_e('Connect With Us', 'unit-converters-child'); ?></h5>
                <div class="social-links mb-3">
                    <?php
                    $social_links = array(
                        'facebook' => get_theme_mod('social_facebook'),
                        'twitter' => get_theme_mod('social_twitter'),
                        'linkedin' => get_theme_mod('social_linkedin'),
                        'github' => get_theme_mod('social_github')
                    );

                    foreach ($social_links as $platform => $url) {
                        if ($url) {
                            printf(
                                '<a href="%s" class="text-muted me-3" target="_blank" rel="noopener noreferrer"><i class="fab fa-%s"></i></a>',
                                esc_url($url),
                                esc_attr($platform)
                            );
                        }
                    }
                    ?>
                </div>
                <p class="text-muted mb-0"><?php echo esc_html(get_theme_mod('contact_email')); ?></p>
                <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>" class="btn btn-outline-light btn-sm mt-2"><?php esc_html_e('Contact Us', 'unit-converters-child'); ?></a>
            </div>
        </div>

        <!-- Legal Links -->
        <div class="row mt-4">
            <div class="col-12">
                <hr class="bg-secondary">
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="<?php echo esc_url(get_permalink(get_page_by_path('copyright'))); ?>" class="text-muted text-decoration-none"><?php esc_html_e('Copyright', 'unit-converters-child'); ?></a>
                    <a href="<?php echo esc_url(get_permalink(get_page_by_path('terms-of-service'))); ?>" class="text-muted text-decoration-none"><?php esc_html_e('Terms of Service', 'unit-converters-child'); ?></a>
                    <a href="<?php echo esc_url(get_permalink(get_page_by_path('privacy-policy'))); ?>" class="text-muted text-decoration-none"><?php esc_html_e('Privacy Policy', 'unit-converters-child'); ?></a>
                </div>
            </div>
        </div>
        
        <!-- Copyright -->
        <div class="row mt-3">
            <div class="col-12">
                <p class="text-center text-muted mb-0">
                    &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php esc_html_e('All rights reserved.', 'unit-converters-child'); ?>
                </p>
            </div>
        </div>
    </div>
</footer>

<!-- Ad Section -->
<div class="container mt-3">
    <div class="ad-section">
        <?php if (function_exists('dynamic_sidebar')) dynamic_sidebar('footer-ad'); ?>
    </div>
</div>

<!-- Back to Top Button -->
<button id="backToTop" class="btn btn-primary rounded-circle position-fixed bottom-0 end-0 m-4 d-none">
    <i class="fas fa-arrow-up"></i>
</button>

<?php wp_footer(); ?>
</body>
</html> 