<?php
/**
 * The template for displaying single posts
 */

get_header(); ?>

<main class="site-main">
    <div class="blog-layout">
        <!-- Left Sidebar with Blog Posts -->
        <aside class="blog-sidebar">
            <div class="sidebar-content">
                <h3>Articles</h3>
                <?php
                // Get all articles from 'go-blog' category in ascending order
                $sidebar_query = new WP_Query(array(
                    'category_name' => 'go-blog',
                    'posts_per_page' => -1,
                    'orderby' => 'date',
                    'order' => 'ASC'
                ));
                
                if ($sidebar_query->have_posts()) : ?>
                    <ul class="sidebar-post-list">
                        <?php while ($sidebar_query->have_posts()) : $sidebar_query->the_post(); ?>
                            <li class="sidebar-post-item">
                                <a href="<?php the_permalink(); ?>" class="sidebar-post-link">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <div class="sidebar-post-thumb">
                                            <?php the_post_thumbnail('thumbnail'); ?>
                                        </div>
                                    <?php endif; ?>
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
                        <div class="single-post-meta">
                            <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                <?php echo esc_html(get_the_date('F j, Y')); ?>
                            </time>
                            <?php if (has_category()) : ?>
                                <div class="post-categories">
                                    <?php the_category(', '); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </header>

                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-featured-image">
                            <?php the_post_thumbnail('large', array('class' => 'post-featured-image')); ?>
                        </div>
                    <?php endif; ?>

                    <div class="post-body">
                        <?php the_content(); ?>
                    </div>

                    <?php if (has_tag()) : ?>
                        <footer class="post-footer">
                            <div class="post-tags">
                                <strong>Tags: </strong>
                                <?php the_tags('', ', ', ''); ?>
                            </div>
                        </footer>
                    <?php endif; ?>

                    <?php
                    // Post navigation - only within 'go-blog' category
                    $prev_post = get_previous_post(true, '', 'category');
                    $next_post = get_next_post(true, '', 'category');
                    
                    // Filter to only show navigation for posts in 'go-blog' category
                    $current_categories = get_the_category();
                    $is_go_blog = false;
                    
                    if ($current_categories) {
                        foreach ($current_categories as $category) {
                            if ($category->slug === 'go-blog') {
                                $is_go_blog = true;
                                break;
                            }
                        }
                    }
                    
                    // Only show navigation if this is a go-blog post and there are adjacent posts
                    if ($is_go_blog && ($prev_post || $next_post)) :
                        // Double-check that adjacent posts are also in go-blog category
                        $show_prev = false;
                        $show_next = false;
                        
                        if ($prev_post) {
                            $prev_categories = get_the_category($prev_post->ID);
                            foreach ($prev_categories as $cat) {
                                if ($cat->slug === 'go-blog') {
                                    $show_prev = true;
                                    break;
                                }
                            }
                        }
                        
                        if ($next_post) {
                            $next_categories = get_the_category($next_post->ID);
                            foreach ($next_categories as $cat) {
                                if ($cat->slug === 'go-blog') {
                                    $show_next = true;
                                    break;
                                }
                            }
                        }
                        
                        if ($show_prev || $show_next) :
                    ?>
                        <nav class="post-navigation">
                            <div class="nav-links">
                                <?php if ($show_prev && $prev_post) : ?>
                                    <div class="nav-previous">
                                        <a href="<?php echo esc_url(get_permalink($prev_post)); ?>" rel="prev">
                                            <span class="nav-subtitle">Previous Post</span>
                                            <span class="nav-title"><?php echo esc_html(get_the_title($prev_post)); ?></span>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if ($show_next && $next_post) : ?>
                                    <div class="nav-next">
                                        <a href="<?php echo esc_url(get_permalink($next_post)); ?>" rel="next">
                                            <span class="nav-subtitle">Next Post</span>
                                            <span class="nav-title"><?php echo esc_html(get_the_title($next_post)); ?></span>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </nav>
                    <?php 
                        endif;
                    endif; ?>


                </article>

                

                                <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
