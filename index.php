<?php
/**
 * The main template file
 */

get_header(); ?>

<main class="site-main">
    <?php if (is_home() && !is_front_page()) : ?>
        <div class="blog-header">
            <div class="container">
                <h1 class="blog-title"><?php echo esc_html(get_the_title(get_option('page_for_posts'))); ?></h1>
                <!-- <p class="blog-description">Stay updated with the latest news and insights from Gospel Ambition</p> -->
            </div>
        </div>
    <?php endif; ?>

    <div class="container">
        <?php 
        // Query posts from 'go-blog' category only
        $blog_query = new WP_Query(array(
            'category_name' => 'go-blog',
            'posts_per_page' => get_option('posts_per_page'),
            'paged' => get_query_var('paged')
        ));
        
        if ($blog_query->have_posts()) : ?>
            <div class="posts-grid">
                <?php while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
                        <?php if (has_post_thumbnail()) : ?>
                            <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'post-thumbnail')); ?>" 
                                 alt="<?php echo esc_attr(get_the_title()); ?>" 
                                 class="post-thumbnail">
                        <?php endif; ?>
                        
                        <div class="post-content">
                            <h2 class="post-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            
                            <div class="post-meta">
                                <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                    <?php echo esc_html(get_the_date()); ?>
                                </time>
                            </div>
                            
                            <div class="post-excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <?php if (function_exists('gospel_ambition_pagination')) : ?>
                <div class="pagination-wrapper">
                    <?php 
                    // Use custom pagination for our custom query
                    global $wp_query;
                    $temp_query = $wp_query;
                    $wp_query = $blog_query;
                    gospel_ambition_pagination();
                    $wp_query = $temp_query;
                    ?>
                </div>
            <?php endif; ?>

        <?php else : ?>
            <div class="no-posts">
                <h2>No blog posts found</h2>
                <p>No posts have been published in the 'go-blog' category yet. Check back soon for updates!</p>
            </div>
        <?php endif; 
        
        // Reset post data after custom query
        wp_reset_postdata();
        ?>
    </div>
</main>

<?php get_footer(); ?>
