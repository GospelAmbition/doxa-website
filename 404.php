<?php
/**
 * The template for displaying 404 pages (not found)
 */

get_header(); ?>

<main class="site-main">
    <div class="container">
        <section class="error-404 not-found">
            <header class="page-header">
                <h1 class="page-title">Page Not Found</h1>
            </header>

            <div class="page-content">
                <p>It looks like nothing was found at this location. Perhaps one of the links below can help.</p>
                
                <div class="error-404-content">
                    <div class="error-404-search">
                        <h3>Try searching for what you need:</h3>
                        <?php get_search_form(); ?>
                    </div>
                    
                    <div class="error-404-links">
                        <h3>Popular Pages:</h3>
                        <ul>
                            <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
                            <li><a href="<?php echo esc_url(home_url('/about/')); ?>">About</a></li>
                            <li><a href="<?php echo esc_url(home_url('/blog/')); ?>">Blog</a></li>
                            <li><a href="<?php echo esc_url(home_url('/projects/')); ?>">Projects</a></li>
                            <li><a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact</a></li>
                        </ul>
                    </div>
                    
                    <?php if (is_active_sidebar('sidebar-1')) : ?>
                        <div class="error-404-widgets">
                            <h3>More Information:</h3>
                            <?php dynamic_sidebar('sidebar-1'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </div>
</main>

<?php get_footer(); ?>
