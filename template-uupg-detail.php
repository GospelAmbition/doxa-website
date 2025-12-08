<?php
/**
 * Template Name: UUPG Detail
 *
 * Custom template for the UUPG detail page - completely independent of posts/archive templates
 */

$uupg_slug = get_query_var('uupg_slug');

get_header( 'top' ); ?>

<div class="page">

    <?php get_header(); ?>

    <main class="site-main">
        <div class="container page-content uupg-detail-page">
            <!-- Custom content for UUPGS page goes here -->
            <h1 class="text-center"><?php echo __('Find a UUPG to adopt', 'doxa-website'); ?></h1>
            <a class="button back-button compact" href="<?php echo home_url('/uupgs'); ?>"><?php echo __('< Back', 'doxa-website'); ?></a>
            <div class="card uupg__card">
                <img class="uupg__image" data-size="medium" src="https://picsum.photos/200" alt="<?php echo __('UUPG 1', 'doxa-website'); ?>">
                <div class="uupg__header">
                    <h3><?php echo __('UUPG 1', 'doxa-website'); ?></h3>
                    <p><?php echo __('Location of UUPG 1', 'doxa-website'); ?></p>
                </div>
                <div class="uupg_adopted"></div>
                <p class="uupg__content"><?php echo __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'doxa-website'); ?></p>
                <div class="uupg__footer">
                    <a class="button fit-content" href="<?php echo home_url('#'); ?>"><?php echo __('Sign up to pray', 'doxa-website'); ?></a>
                    <a class="button fit-content" href="<?php echo home_url('#'); ?>"><?php echo __('Adopt people group', 'doxa-website'); ?></a>
                </div>
            </div>

        </div>
    </main>


    <?php get_footer(); ?>

</div>

<?php get_footer( 'bottom' ); ?>

