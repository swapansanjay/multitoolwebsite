<?php
/**
 * The header for our theme
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Header -->
<header class="bg-primary text-white">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
                <i class="fas fa-calculator me-2"></i><?php bloginfo('name'); ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => false,
                    'menu_class' => 'navbar-nav me-auto',
                    'fallback_cb' => false,
                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'depth' => 2,
                    'walker' => new Bootstrap_5_Nav_Walker()
                ));
                ?>
                <div class="d-flex align-items-center">
                    <!-- Language Selector -->
                    <div class="dropdown me-3">
                        <button class="btn btn-outline-light dropdown-toggle" type="button" id="languageDropdown" data-bs-toggle="dropdown">
                            <i class="fas fa-globe me-1"></i>
                            <span id="currentLanguage"><?php echo esc_html(get_locale()); ?></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#" data-lang="en_US">English</a></li>
                            <li><a class="dropdown-item" href="#" data-lang="es_ES">Español</a></li>
                            <li><a class="dropdown-item" href="#" data-lang="fr_FR">Français</a></li>
                            <li><a class="dropdown-item" href="#" data-lang="de_DE">Deutsch</a></li>
                            <li><a class="dropdown-item" href="#" data-lang="it_IT">Italiano</a></li>
                        </ul>
                    </div>
                    <!-- Search Button -->
                    <button class="btn btn-outline-light me-2" type="button" data-bs-toggle="modal" data-bs-target="#searchModal">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>
</header>

<!-- Search Modal -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="searchModalLabel"><?php esc_html_e('Search Tools', 'unit-converters-child'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="search-container">
                    <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                        <div class="input-group">
                            <input type="search" class="form-control search-input" placeholder="<?php esc_attr_e('Search for tools...', 'unit-converters-child'); ?>" value="<?php echo get_search_query(); ?>" name="s">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div id="searchResults" class="mt-3">
                    <!-- Search results will be populated here -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Ad Section -->
<div class="container mt-3">
    <div class="ad-section">
        <?php if (function_exists('dynamic_sidebar')) dynamic_sidebar('header-ad'); ?>
    </div>
</div> 