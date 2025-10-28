<?php
/**
 * The template for displaying search results
 */

get_header(); ?>

<main class="site-main">
    <div class="container">
        <header class="page-header">
            <h1 class="page-title">
                <?php
                printf(
                    esc_html__('Search Results for: %s', 'gospel-ambition'),
                    '<span>' . get_search_query() . '</span>'
                );
                ?>
            </h1>
        </header>

        <?php if (have_posts()) : ?>
            <div class="search-results">
                <p class="search-results-count">
                    <?php
                    global $wp_query;
                    printf(
                        esc_html(_n('Found %s result', 'Found %s results', $wp_query->found_posts, 'gospel-ambition')),
                        number_format_i18n($wp_query->found_posts)
                    );
                    ?>
                </p>

                <div class="posts-grid">
                    <?php while (have_posts()) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('post-card search-result'); ?>>
                            <?php if (has_post_thumbnail()) : ?>
                                <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'post-thumbnail')); ?>" 
                                     alt="<?php echo esc_attr(get_the_title()); ?>" 
                                     class="post-thumbnail">
                            <?php endif; ?>
                            
                            <div class="post-content">
                                <div class="post-type">
                                    <?php echo esc_html(get_post_type()); ?>
                                </div>
                                
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
                        <?php gospel_ambition_pagination(); ?>
                    </div>
                <?php endif; ?>
            </div>

        <?php else : ?>
            <div class="no-results">
                <h2><?php esc_html_e('Nothing Found', 'gospel-ambition'); ?></h2>
                <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'gospel-ambition'); ?></p>
                
                <div class="search-suggestions">
                    <h3><?php esc_html_e('Try searching again:', 'gospel-ambition'); ?></h3>
                    <?php get_search_form(); ?>
                    
                    <div class="popular-content">
                        <h4><?php esc_html_e('Popular Pages:', 'gospel-ambition'); ?></h4>
                        <ul>
                            <li><a href="<?php echo esc_url(home_url('/about/')); ?>">About</a></li>
                            <li><a href="<?php echo esc_url(home_url('/projects/')); ?>">Projects</a></li>
                            <li><a href="<?php echo esc_url(home_url('/blog/')); ?>">Blog</a></li>
                            <li><a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
