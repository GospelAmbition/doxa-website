<?php
/**
 * The main template file
 */

get_header(); ?>

<main class="site-main">
    <?php if (is_home() && !is_front_page()) : ?>
        <div class="blog-header">
            <div class="container">
                <h1 class="blog-title"><?php echo esc_html(get_the_title(get_option('page_for_posts'))); ?></h1>
                <!-- <p class="blog-description">Stay updated with the latest news and insights from Gospel Ambition</p> -->
            </div>
        </div>
    <?php endif; ?>

    <div class="container">
        <div class="text-center font-size-xl"><i><?php echo __('Let\'s TOGETHER give Jesus a gift:', 'doxa-website'); ?></i></div>
        <h1 class="text-center"><?php echo __('Every unengaged people on earth engaged by 2033', 'doxa-website'); ?></h1>
    </div>
</main>

<?php get_footer(); ?>
