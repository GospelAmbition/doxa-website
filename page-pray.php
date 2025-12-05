<?php
/**
 * Template Name: Pray
 *
 * Custom template for the Pray page - completely independent of posts/archive templates
 */

get_header( 'top' ); ?>

<div class="page bg-secondary">

    <?php get_header(); ?>

    <main class="site-main">

        <div class="container page-content pray-page">
            <!-- Custom content for Pray page goes here -->
            <h1 class="text-center"><?php echo __('Unengaged people groups adopted in prayer', 'doxa-website'); ?></h1>


            <p class="text-center font-heading font-size-3xl"><?php echo __('"Prayer is the work" - Oswald Chambers', 'doxa-website'); ?></p>
            <a class="button mx-auto" href="<?php echo home_url('/uupgs'); ?>"><?php echo __('Find a people group', 'doxa-website'); ?></a>
        </div>
    </main>

    <?php get_footer(); ?>

</div>

<?php get_footer( 'bottom' ); ?>
