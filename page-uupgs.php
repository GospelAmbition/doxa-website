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
            <h1 class="text-center"><?php echo __('Find a UUPG to adopt', 'doxa-website'); ?></h1>
            <uupgs-list
                t="<?php echo esc_attr( json_encode( [
                    'results' => __('Results', 'doxa-website'),
                    'full_profile' => __('Full Profile', 'doxa-website'),
                    'loading' => __('Loading results...', 'doxa-website'),
                ])); ?>"
            ></uupgs-list>
        </div>
    </main>


    <?php get_footer(); ?>

</div>

<?php get_footer( 'bottom' ); ?>
