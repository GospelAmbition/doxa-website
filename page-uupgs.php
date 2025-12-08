<?php
/**
 * Template Name: UUPGS
 *
 * Custom template for the UUPGS page - completely independent of posts/archive templates
 */

get_header( 'top' ); ?>

<div class="page">

    <?php get_header(); ?>

    <main class="site-main">
        <div class="container page-content uupgs-page">
            <!-- Custom content for UUPGS page goes here -->
            <h1 class="text-center"><?php echo __('Find a UUPG to adopt', 'doxa-website'); ?></h1>
            <a class="button" href="<?php echo home_url('/uupgs'); ?>"><?php echo __('Reset filters', 'doxa-website'); ?></a>
            <a class="button back-button" href="<?php echo home_url('/pray'); ?>"><?php echo __('Back to prayer', 'doxa-website'); ?></a>
            <div class="filter-buttons">
                <button class="button filter-button"><?php echo __('Blah', 'doxa-website'); ?></button>
                <button class="button filter-button"><?php echo __('Foo', 'doxa-website'); ?></button>
            </div>
        </div>
    </main>


    <?php get_footer(); ?>

</div>

<?php get_footer( 'bottom' ); ?>
