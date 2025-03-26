<?php
/**
 * The front page template file
 */

get_header();
?>

<!-- Hero Section with Search -->
<div class="hero-section text-center mb-5">
    <h1 class="display-4 mb-4"><?php esc_html_e('Online Unit Converters & Calculators', 'unit-converters-child'); ?></h1>
    <p class="lead mb-4"><?php esc_html_e('Access our collection of free online tools for unit conversion and calculations', 'unit-converters-child'); ?></p>
    
    <!-- Main Search Bar -->
    <div class="search-bar-container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                    <div class="input-group input-group-lg">
                        <input type="search" class="form-control form-control-lg" placeholder="<?php esc_attr_e('Search for converters and calculators...', 'unit-converters-child'); ?>" value="<?php echo get_search_query(); ?>" name="s">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search me-2"></i><?php esc_html_e('Search', 'unit-converters-child'); ?>
                        </button>
                    </div>
                </form>
                <div class="popular-searches mt-3">
                    <small class="text-muted"><?php esc_html_e('Popular:', 'unit-converters-child'); ?> </small>
                    <?php
                    $popular_categories = array(
                        'length' => __('Length', 'unit-converters-child'),
                        'weight' => __('Weight', 'unit-converters-child'),
                        'temperature' => __('Temperature', 'unit-converters-child'),
                        'area' => __('Area', 'unit-converters-child')
                    );

                    foreach ($popular_categories as $slug => $name) {
                        printf(
                            '<a href="%s" class="badge bg-light text-dark me-2">%s</a>',
                            esc_url(get_term_link($slug, 'tool_category')),
                            esc_html($name)
                        );
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Categories Grid -->
<div class="container">
    <div class="row">
        <?php
        $categories = array(
            'length' => array(
                'icon' => 'ruler',
                'title' => __('Length Converters', 'unit-converters-child')
            ),
            'weight' => array(
                'icon' => 'weight',
                'title' => __('Weight Converters', 'unit-converters-child')
            ),
            'temperature' => array(
                'icon' => 'thermometer-half',
                'title' => __('Temperature Converters', 'unit-converters-child')
            ),
            'area' => array(
                'icon' => 'square',
                'title' => __('Area Converters', 'unit-converters-child')
            ),
            'volume' => array(
                'icon' => 'fill',
                'title' => __('Volume Converters', 'unit-converters-child')
            ),
            'speed' => array(
                'icon' => 'tachometer-alt',
                'title' => __('Speed Converters', 'unit-converters-child')
            ),
            'digital' => array(
                'icon' => 'laptop-code',
                'title' => __('Digital Tools', 'unit-converters-child')
            ),
            'engineering' => array(
                'icon' => 'cogs',
                'title' => __('Engineering Tools', 'unit-converters-child')
            ),
            'text' => array(
                'icon' => 'font',
                'title' => __('Text Tools', 'unit-converters-child')
            ),
            'time' => array(
                'icon' => 'clock',
                'title' => __('Time Tools', 'unit-converters-child')
            )
        );

        foreach ($categories as $slug => $info) {
            ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-<?php echo esc_attr($info['icon']); ?> me-2"></i><?php echo esc_html($info['title']); ?>
                        </h5>
                        <?php echo do_shortcode('[tools category="' . esc_attr($slug) . '" count="3"]'); ?>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>

<?php
get_footer(); 