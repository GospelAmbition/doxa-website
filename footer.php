<footer id="colophon" class="footer">
    <div class="container | footer__content">
        <div class="footer__left stack stack--xs">
            <div>
                <img
                    src="<?php echo get_template_directory_uri(); ?>/assets/DOXA-logo-light-with-text.png"
                    alt="DOXA Logo"
                    class="mx-auto"
                    width="120"
                    height="auto"
                >
            </div>
        </div>
        <div class="footer__center">
            <div class="footer__description">
                <h3><?php bloginfo('name'); ?></h3>
                <p>Global Partnership for the Unreached</p>
            </div>
            <nav class="main-navigation">
                <?php
                if (!is_page( 'coming-soon' ) && has_nav_menu('footer')) {
                    wp_nav_menu(array(
                        'theme_location' => 'footer',
                        'menu_class'     => 'main-navigation role-list',
                        'depth'          => 1,
                    ));
                }
                ?>
            </nav>

        </div>

        <div class="footer__right">

            <?php if (is_active_sidebar('footer-widgets')) : ?>

                <?php dynamic_sidebar('footer-widgets'); ?>

            <?php endif; ?>

        </div>
    </div>
    <div class="center | footer__copyright">
        <p>&copy; <?php echo esc_html(date('Y')); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
    </div>
</footer>