<header id="masthead" class="position-relative">
    <nav id="hamburger-menu" class="hamburger-menu" aria-label="Hamburger menu" data-state="closed">
        <?php
        if (has_nav_menu('secondary')) {
            wp_nav_menu(array(
                'theme_location' => 'secondary',
                'menu_id'        => 'secondary-menu',
                'menu_class'     => 'role-list stack',
                'submenu_class'     => 'role-list',
                'container'      => false,
                'depth'          => 2,
            ));
        }
        ?>
    </nav>

    <div class="header">
        <div class="container">
            <div class="header-content">
                <div class="site-branding">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/Small Banner/DOXA-small-light-banner.png"
                            class="custom-logo"
                            alt="<?php bloginfo('name'); ?>"
                            width="250"
                            height="auto">
                    </a>
                </div>
                <div class="header-menu">
                    <nav id="site-navigation" class="main-navigation">
                        <?php
                        if (has_nav_menu('primary')) {
                            wp_nav_menu(array(
                                'theme_location' => 'primary',
                                'menu_id'        => 'primary-menu',
                                'menu_class'     => 'role-list',
                                'submenu_class'     => 'role-list',
                                'container'      => false,
                                'depth'          => 2,
                            ));
                        }
                        ?>
                    </nav>
                    <button class="mobile-menu-toggle" aria-label="Toggle navigation menu">
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>


</header>
