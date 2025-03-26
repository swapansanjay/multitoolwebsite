<?php
/**
 * The main template file
 *
 * @package Unit_Converters_Child
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <?php
        if (have_posts()) :
            while (have_posts()) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                    </header>

                    <div class="entry-content">
                        <?php
                        the_content();
                        ?>
                    </div>

                    <footer class="entry-footer">
                        <?php
                        // Display categories, tags, and custom taxonomies
                        $categories_list = get_the_category_list(esc_html__(', ', 'unit-converters-child'));
                        if ($categories_list) {
                            printf('<span class="cat-links">' . esc_html__('Posted in %1$s', 'unit-converters-child') . '</span>', $categories_list);
                        }

                        $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'unit-converters-child'));
                        if ($tags_list) {
                            printf('<span class="tags-links">' . esc_html__('Tagged %1$s', 'unit-converters-child') . '</span>', $tags_list);
                        }
                        ?>
                    </footer>
                </article>
                <?php
            endwhile;

            the_posts_navigation();
        else :
            ?>
            <p><?php esc_html_e('Nothing found.', 'unit-converters-child'); ?></p>
            <?php
        endif;
        ?>
    </div>
</main>

<?php
get_footer(); 