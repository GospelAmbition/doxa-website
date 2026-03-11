<?php
/**
 * Template Name: UUPG Detail
 *
 * Custom template for the UUPG detail page - completely independent of posts/archive templates
 */

$slug = get_query_var( 'uupg_slug' );

$uupg = get_uupg_by_slug( $slug );

$lang_code = doxa_get_language_code();
if ( $lang_code !== 'en' ) {
    $pray_url = 'https://pray.doxa.life/' . $lang_code . '/' . $slug;
} else {
    $pray_url = 'https://pray.doxa.life/' . $slug;
}

?>


<?php if ( isset( $uupg['error'] ) ) : ?>
    <?php get_header( 'top' ); ?>
    <div class="page">
        <?php get_header(); ?>
        <main class="site-main">
            <div class="container page-content uupg-detail-page">
                <div class="stack stack--lg">
                    <h1><?php echo __('People Group Not Found', 'doxa-website'); ?></h1>
                    <p><?php echo __('The people group you are looking for could not be found. Please try again.', 'doxa-website'); ?></p>
                    <a class="button font-size-lg" href="<?php echo home_url('/research'); ?>">
                        <span class="sr-only"><?php echo __('Back', 'doxa-website'); ?></span>
                        <svg class="icon | rotate-270" viewBox="0 0 489.67 289.877">
                            <path d="M439.017,211.678L263.258,35.919c-3.9-3.9-8.635-6.454-13.63-7.665-9.539-2.376-20.051.161-27.509,7.619L46.361,211.632c-11.311,11.311-11.311,29.65,0,40.961h0c11.311,11.311,29.65,11.311,40.961,0L242.667,97.248l155.39,155.39c11.311,11.311,29.65,11.311,40.961,0h0c11.311-11.311,11.311-29.65,0-40.961Z"/>
                        </svg>
                        <?php echo __('Back', 'doxa-website'); ?>
                    </a>
                </div>
            </div>
        </main>
        <?php get_footer(); ?>
    </div>
    <?php get_footer( 'bottom' ); ?>
<?php endif; ?>

<?php get_header( 'top' ); ?>

<div class="page">

    <?php get_header(); ?>

    <main class="site-main">
        <div class="uupg-detail-page stack stack--2xl">
            <div class="surface-brand-light py-xl color-secondary">
                <div class="container">
                    <h1 class="text-center"><?php echo __('Adoption Resources', 'doxa-website'); ?></h1>
                </div>
            </div>
            <div class="surface-white py-xl stack-spacing-none">
                <div class="container">
                    <div class="switcher">
                        <div class="center | grow-none">
                            <img class="uupg__image" data-size="medium" data-shape="portrait" src="<?php echo esc_attr( $uupg['image_url'] ); ?>" alt="<?php echo isset( $uupg['name'] ) ? esc_attr( $uupg['name'] ) : 'People Group Photo'; ?>">
                        </div>
                        <div class="stack stack--xs | uupg__header">
                            <h2 class="color-primary"><?php echo __('Your UUPG', 'doxa-website'); ?></h2>
                            <h3 class="h1 font-weight-medium"><?php echo esc_html( $uupg['display_name'] ); ?></h3>
                            <p class="font-weight-medium font-size-lg"><?php echo esc_html( $uupg['imb_isoalpha3']['label'] ); ?> (<?php echo esc_html( $uupg['imb_reg_of_people_1']['label'] ); ?>)</p>
                            <a href="<?php echo esc_url( doxa_translation_url('research/' ) . $slug ); ?>" class="button compact"><?php echo __('View full profile', 'doxa-website'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <section class="surface-white">
                <div class="container stack stack--xl">
                    <h2><?php echo __('Introduction', 'doxa-website'); ?></h2>
                    <h3 class="color-brand-lighter stack-spacing-3xl"><?php echo __('Welcome to the adoption Journey', 'doxa-website'); ?></h3>
                    <p><?php echo __('Thank you for adopting this Unengaged, Unreached People Group. Your church is joining a global movement asking God to open the way for the gospel among people who currently have little or no access to it. This page provides resources to help your church stay informed, mobilize prayer, and explore how God may use your community to help bring the good news of Jesus to this people group.', 'doxa-website'); ?></p>

                    <h3 class="color-brand-lighter stack-spacing-3xl"><?php echo __('Your role as an adopting church', 'doxa-website'); ?></h3>
                    <ul>
                        <li><?php echo __('Pray regularly for this people group and for gospel breakthrough', 'doxa-website'); ?></li>
                        <li><?php echo __('Mobilize others in your church to join in prayer', 'doxa-website'); ?></li>
                        <li><?php echo __('Give to support gospel work among unreached peoples', 'doxa-website'); ?></li>
                        <li><?php echo __('Send or raise up workers who may go and serve among them', 'doxa-website'); ?></li>
                    </ul>

                    <h3 class="color-brand-lighter stack-spacing-3xl"><?php echo __('Resources available on this page', 'doxa-website'); ?></h3>
                    <ul>
                        <li><?php echo __('Printable prayer cards and people group images', 'doxa-website'); ?></li>
                        <li><?php echo __('Graphics, QR code and slides for sharing with your congregation', 'doxa-website'); ?></li>
                        <li><?php echo __('Additional tools to help your church stay engaged in prayer for this people group', 'doxa-website'); ?></li>
                    </ul>
                </div>
            </section>

        </div>
    </main>


    <?php get_footer(); ?>

</div>

<?php get_footer( 'bottom' ); ?>

