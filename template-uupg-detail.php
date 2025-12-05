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
            <h1 class="text-center"><?php echo __('UUPG Detail', 'doxa-website'); ?></h1>
            <h2><?php echo $uupg_slug; ?></h2>

        </div>
    </main>


    <?php get_footer(); ?>

</div>

<?php get_footer( 'bottom' ); ?>

