<?php
/**
 * The template for displaying single articles
 */

get_header(); ?>

<main class="site-main">
    <div class="blog-layout">
        <!-- Left Sidebar with Articles -->
        <aside class="blog-sidebar">
            <div class="sidebar-content">
                <h3>Articles</h3>
                <?php
                // Get all articles in custom order
                $sidebar_query = new WP_Query(array(
                    'post_type' => 'article',
                    'posts_per_page' => -1,
                    'orderby' => 'menu_order date',
                    'order' => 'ASC'
                ));
                
                if ($sidebar_query->have_posts()) : ?>
                    <ul class="sidebar-post-list">
                        <?php while ($sidebar_query->have_posts()) : $sidebar_query->the_post(); ?>
                            <li class="sidebar-post-item">
                                <a href="<?php the_permalink(); ?>" class="sidebar-post-link">
                                    <div class="sidebar-post-content">
                                        <h4 class="sidebar-post-title"><?php the_title(); ?></h4>
                                    </div>
                                </a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; wp_reset_postdata(); ?>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="blog-main-content">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
                    <header class="post-header">
                        <h1 class="single-post-title"><?php the_title(); ?></h1>
                        <!-- <div class="single-post-meta">
                            <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                <?php echo esc_html(get_the_date('F j, Y')); ?>
                            </time>
                        </div> -->
                    </header>

                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-featured-image">
                            <?php the_post_thumbnail('large', array('class' => 'post-featured-image')); ?>
                        </div>
                    <?php endif; ?>

                    <div class="post-body">
                        <?php the_content(); ?>
                    </div>

                    <?php
                    // Article navigation using custom order
                    $prev_post = get_previous_article();
                    $next_post = get_next_article();
                    
                    if ($prev_post || $next_post) :
                    ?>
                        <nav class="post-navigation">
                            <div class="nav-links">
                                <?php if ($prev_post) : ?>
                                    <div class="nav-previous">
                                        <a href="<?php echo esc_url(get_permalink($prev_post)); ?>" rel="prev">
                                            <span class="nav-subtitle">Previous Article</span>
                                            <span class="nav-title"><?php echo esc_html(get_the_title($prev_post)); ?></span>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if ($next_post) : ?>
                                    <div class="nav-next">
                                        <a href="<?php echo esc_url(get_permalink($next_post)); ?>" rel="next">
                                            <span class="nav-subtitle">Next Article</span>
                                            <span class="nav-title"><?php echo esc_html(get_the_title($next_post)); ?></span>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </nav>
                    <?php endif; ?>

                </article>
                <?php endwhile; ?>
            <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>