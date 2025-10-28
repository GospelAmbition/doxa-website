<?php
/**
 * Template Name: Max Width 1200px Page
 * 
 * The template for displaying pages with a maximum width of 1200px
 */

get_header(); ?>

<main class="site-main max-width-template">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <article id="page-<?php the_ID(); ?>" <?php post_class('page-content max-width-page'); ?>>
                <?php if (has_post_thumbnail()) : ?>
                    <div class="page-featured-image max-width">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>

                <div class="page-body max-width">
                    <?php the_content(); ?>
                    
                    <?php
                    wp_link_pages(array(
                        'before' => '<div class="page-links">',
                        'after'  => '</div>',
                    ));
                    ?>
                </div>
            </article>

        <?php endwhile; ?>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
