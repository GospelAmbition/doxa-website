<?php
/**
 * The template for displaying archive pages
 */

get_header(); ?>

<main class="site-main">
    <div class="blog-header">
        <div class="container">
            <h1 class="blog-title">
                <?php
                if (is_category()) {
                    single_cat_title();
                } elseif (is_tag()) {
                    single_tag_title();
                } elseif (is_author()) {
                    printf(esc_html__('Posts by %s', 'gospel-ambition'), get_the_author());
                } elseif (is_day()) {
                    printf(esc_html__('Posts from %s', 'gospel-ambition'), get_the_date());
                } elseif (is_month()) {
                    printf(esc_html__('Posts from %s', 'gospel-ambition'), get_the_date('F Y'));
                } elseif (is_year()) {
                    printf(esc_html__('Posts from %s', 'gospel-ambition'), get_the_date('Y'));
                } else {
                    esc_html_e('Archives', 'gospel-ambition');
                }
                ?>
            </h1>
            
            <?php
            $description = '';
            if (is_category()) {
                $description = category_description();
            } elseif (is_tag()) {
                $description = tag_description();
            } elseif (is_author()) {
                $description = get_the_author_meta('description');
            }
            
            if ($description) :
            ?>
                <div class="archive-description">
                    <?php echo wp_kses_post($description); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="container">
        <?php if (have_posts()) : ?>
            <div class="posts-grid">
                <?php while (have_posts()) : the_post(); ?>
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
                                
                                <?php if (has_category() && !is_category()) : ?>
                                    <div class="post-categories">
                                        <?php the_category(', '); ?>
                                    </div>
                                <?php endif; ?>
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

        <?php else : ?>
            <div class="no-posts">
                <h2>No posts found</h2>
                <p>Sorry, but no posts were found in this archive. Please try searching or browse other categories.</p>
                
                <div class="archive-suggestions">
                    <?php get_search_form(); ?>
                    
                    <div class="category-links">
                        <h3>Browse Categories:</h3>
                        <?php
                        $categories = get_categories(array(
                            'orderby' => 'count',
                            'order'   => 'DESC',
                            'number'  => 5,
                        ));
                        
                        if ($categories) :
                        ?>
                            <ul class="category-list">
                                <?php foreach ($categories as $category) : ?>
                                    <li>
                                        <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
                                            <?php echo esc_html($category->name); ?>
                                            <span class="post-count">(<?php echo esc_html($category->count); ?>)</span>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
