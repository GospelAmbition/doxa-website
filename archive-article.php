<?php
/**
 * The template for displaying article archives
 */

get_header(); ?>

<main class="site-main">
    <div class="blog-header">
        <div class="container">
            <h1 class="blog-title">Gospel Ambition</h1>
            <div class="archive-description">
                <p>Fulfilling the Great Commission in this generation, with you</p>
            </div>
        </div>
    </div>

    <div class="container">
        <?php
        // Custom query to order by menu_order, then date
        $articles_query = new WP_Query(array(
            'post_type' => 'article',
            'posts_per_page' => get_option('posts_per_page'),
            'paged' => get_query_var('paged'),
            'orderby' => 'menu_order date',
            'order' => 'ASC'
        ));
        
        if ($articles_query->have_posts()) : ?>
            <div class="posts-grid">
                <?php while ($articles_query->have_posts()) : $articles_query->the_post(); ?>
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
                    // Custom pagination for custom query
                    $big = 999999999;
                    echo paginate_links(array(
                        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                        'format' => '?paged=%#%',
                        'current' => max(1, get_query_var('paged')),
                        'total' => $articles_query->max_num_pages,
                        'prev_text' => '&laquo; Previous',
                        'next_text' => 'Next &raquo;',
                        'type' => 'list'
                    ));
                    ?>
                </div>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>

        <?php else : ?>
            <div class="no-posts">
                <h2>No articles found</h2>
                <p>Sorry, but no articles were found. Please check back later for new content.</p>
                
                <div class="archive-suggestions">
                    <?php get_search_form(); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>