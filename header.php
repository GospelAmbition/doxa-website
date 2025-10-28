<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <header id="masthead" class="site-header">
        <div class="container">
            <div class="header-content">
                <div class="site-branding">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="custom-logo-link" rel="home">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/Small Banner/DOXA-small-light-banner.png"
                             class="custom-logo"
                             alt="<?php bloginfo('name'); ?>"
                             width="200"
                             height="60">
                    </a>
                </div>

                <button class="mobile-menu-toggle" aria-label="Toggle navigation menu">
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                </button>
                
                <nav id="site-navigation" class="main-navigation">
                    <?php
                    if (has_nav_menu('primary')) {
                        wp_nav_menu(array(
                            'theme_location' => 'primary',
                            'menu_id'        => 'primary-menu',
                            'container'      => false,
                            'depth'          => 2,
                        ));
                    }
                    ?>
                </nav>
            </div>
        </div>
    </header>
