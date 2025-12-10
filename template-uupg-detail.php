<?php
/**
 * Template Name: UUPG Detail
 *
 * Custom template for the UUPG detail page - completely independent of posts/archive templates
 */

$post_id = get_query_var('uupg_slug');

$uupg = get_uupg_by_post_id($post_id);

get_header( 'top' ); ?>

<div class="page">

    <?php get_header(); ?>

    <main class="site-main">
        <div class="container page-content uupg-detail-page">
            <!-- Custom content for UUPGS page goes here -->
            <h1 class="text-center"><?php echo __('Find a UUPG to adopt', 'doxa-website'); ?></h1>
            <a class="button back-button compact" href="<?php echo home_url('/uupgs'); ?>"><?php echo __('< Back', 'doxa-website'); ?></a>
            <div class="card uupg__card">
                <img class="uupg__image" data-size="medium" src="<?php echo esc_attr( $uupg['imb_picture_url'] ); ?>" alt="<?php echo esc_attr( $uupg['imb_display_name'] ); ?>">
                <div class="uupg__header">
                    <h3><?php echo esc_html( $uupg['imb_display_name'] ); ?></h3>
                    <p><?php echo esc_html( $uupg['imb_isoalpha3']['label'] ); ?> (<?php echo esc_html( $uupg['imb_reg_of_people_1']['label'] ); ?>)</p>
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

