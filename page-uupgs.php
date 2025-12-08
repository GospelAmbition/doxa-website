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
            <section id="filters"></section>
            <h2 class="text-center"><?php echo __('Results', 'doxa-website'); ?></h2>
            <section id="results" class="grid | uupgs-list">
                <div class="card | uupg__card">
                    <img class="uupg__image" src="https://picsum.photos/100" alt="<?php echo __('UUPG 1', 'doxa-website'); ?>">
                    <div class="uupg__header">
                        <h3><?php echo __('UUPG 1', 'doxa-website'); ?></h3>
                        <p><?php echo __('Location of UUPG 1', 'doxa-website'); ?></p>
                    </div>
                    <div class="uupg_adopted"></div>
                    <p class="uupg__content"><?php echo __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'doxa-website'); ?></p>
                    <a class="uupg__more-button button compact" href="<?php echo home_url('/uupgs/1'); ?>"><?php echo __('Full Profile', 'doxa-website'); ?></a>
                </div>
                <div class="card | uupg__card">
                    <img class="uupg__image" src="https://picsum.photos/100" alt="<?php echo __('UUPG 2', 'doxa-website'); ?>">
                    <div class="uupg__header">
                        <h3><?php echo __('UUPG 2', 'doxa-website'); ?></h3>
                        <p><?php echo __('Location of UUPG 2', 'doxa-website'); ?></p>
                    </div>
                    <div class="uupg_adopted"></div>
                    <p class="uupg__content"><?php echo __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'doxa-website'); ?></p>
                    <a class="uupg__more-button button compact" href="<?php echo home_url('/uupgs/2'); ?>"><?php echo __('Full Profile', 'doxa-website'); ?></a>
                </div>
            </section>
        </div>
    </main>


    <?php get_footer(); ?>

</div>

<?php get_footer( 'bottom' ); ?>
