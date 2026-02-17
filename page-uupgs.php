<?php
/**
 * Template Name: UUPGS
 *
 * Custom template for the UUPGS page - completely independent of posts/archive templates
 */

get_header( 'top' ); ?>

<?php $search = get_query_var( 'uupg_search' ); ?>

<div class="page">

    <?php get_header(); ?>

    <main class="site-main">
        <div class="container page-content uupgs-page stack stack--3xl">
            <h1 class="text-center highlight" data-highlight-last><?php echo __('Find a UUPG', 'doxa-website'); ?></h1>
            <uupgs-list
                researchUrl="<?php echo esc_url( doxa_translation_url( 'research' ) ); ?>"
                t="<?php echo esc_attr( json_encode( [
                    'full_profile' => __('Full Profile', 'doxa-website'),
                    'loading' => __('Loading results...', 'doxa-website'),
                    'load_more' => __('Load More', 'doxa-website'),
                    'total' => __('Total', 'doxa-website'),
                    'search' => __('Search names, locations, religions...', 'doxa-website'),
                    'adopted' => __('Adopted', 'doxa-website'),
                    'not_adopted' => __('Not Adopted', 'doxa-website'),
                    'filters' => [
                        'search' => __('Search', 'doxa-website'),
                        'sort' => __('Sort', 'doxa-website'),
                        'per_page' => __('Per Page', 'doxa-website'),
                    ],
                ])); ?>"
                initialSearchTerm="<?php echo esc_attr( $search ); ?>"
            ></uupgs-list>
        </div>
    </main>

    <?php get_footer(); ?>

</div>

<?php get_footer( 'bottom' ); ?>
