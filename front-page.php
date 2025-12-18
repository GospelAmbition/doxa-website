<?php
/**
 * The front page template file
 */

get_header( 'top' ); ?>

<div class="page">

    <?php get_header(); ?>

    <main class="site-main">
        <div class="container page-content front-page">
            <section class="stack stack--md">
                <div>
                    <h2 class="color-brand"><?php echo __('Our gift to Jesus', 'doxa-website'); ?>:</h2>
                    <h1 class="color-brand-light highlight-first highlight-last" data-highlight-color="primary"><?php echo __('Engage every people by 2033', 'doxa-website'); ?></h1>
                </div>
                <div>
                    <!-- <img src="<?php echo get_template_directory_uri(); ?>/assets/images/front-page-image.jpg" alt="<?php echo __('Engage every people by 2033', 'doxa-website'); ?>"> -->
                    <img src="https://placehold.co/1200x600" alt="<?php echo __('Engage every people by 2033', 'doxa-website'); ?>">
                </div>
            </section>
        </div>
    </main>

    <?php get_footer(); ?>

</div>

<?php get_footer( 'bottom' ); ?>


