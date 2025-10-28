    <footer id="colophon" class="site-footer">
        <div class="footer-content">
            <div class="footer-description">
                <h3><?php bloginfo('name'); ?></h3>
                <p>Global Partnership for the Unreached</p>
            </div>

            <nav class="footer-navigation">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'menu_class'     => 'footer-links',
                    'depth'          => 1,
                ));
                ?>
            </nav>

            <?php if (is_active_sidebar('footer-widgets')) : ?>
                <div class="footer-widgets">
                    <?php dynamic_sidebar('footer-widgets'); ?>
                </div>
            <?php endif; ?>

            <div class="footer-copyright">
                <p>&copy; <?php echo esc_html(date('Y')); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
            </div>
        </div>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
