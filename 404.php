<?php
/**
 * The template for displaying 404 pages (not found)
 */

$lang = function_exists( 'pll_current_language' ) ? pll_current_language() : substr( get_locale(), 0, 2 );

get_header( 'top' ); ?>

<div class="page">

    <?php get_header(); ?>

    <main class="site-main">
        <div class="container page-content">
            <div class="stack stack--lg">
                <h1 class="page-title"><?php echo esc_html__('Page Not Found', 'doxa-website'); ?></h1>
                <p><?php echo esc_html__('It looks like nothing was found at this location. Perhaps one of the links below can help.', 'doxa-website'); ?></p>
                <div class="error-404-content">
                    <div class="stack stack--md">
                        <h3><?php echo esc_html__('Popular Pages:', 'doxa-website'); ?></h3>
                        <ul>
                            <li><a href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html__('Home', 'doxa-website'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/pray')); ?>"><?php echo esc_html__('Pray', 'doxa-website'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/adopt')); ?>"><?php echo esc_html__('Adopt', 'doxa-website'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/research')); ?>"><?php echo esc_html__('Research', 'doxa-website'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/about')); ?>"><?php echo esc_html__('About', 'doxa-website'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/contact')); ?>"><?php echo esc_html__('Contact', 'doxa-website'); ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php get_footer(); ?>

</div>

<?php get_footer( 'bottom' ); ?>
