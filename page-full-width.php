<?php
/**
 * Template Name: Full Width Page
 * 
 * The template for displaying full width pages with no container constraints
 */

get_header(); ?>

<main class="site-main full-width-template">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <article id="page-<?php the_ID(); ?>" <?php post_class('page-content full-width-page'); ?>>
                <?php if (has_post_thumbnail()) : ?>
                    <div class="page-featured-image full-width">
                        <?php the_post_thumbnail('full'); ?>
                    </div>
                <?php endif; ?>

                <div class="page-body full-width">
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
