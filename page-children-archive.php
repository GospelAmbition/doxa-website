<?php
/**
 * Template Name: Page with Children Archive
 *
 * A reusable template for pages with child pages.
 * Displays a sidebar menu with all child pages and the current page content.
 */

get_header(); ?>

<main class="site-main children-archive-template">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <?php
            // Get the current page ID
            $current_page_id = get_the_ID();

            // Determine if this is a parent or child page
            $parent_id = wp_get_post_parent_id($current_page_id);

            // If this is a child page, get the parent ID for the menu
            // If this is a parent page, use its own ID
            $menu_parent_id = $parent_id ? $parent_id : $current_page_id;

            // Get all child pages
            $child_pages = get_pages(array(
                'child_of' => $menu_parent_id,
                'parent' => $menu_parent_id,
                'sort_column' => 'menu_order',
                'sort_order' => 'ASC',
            ));
            ?>

            <div class="children-archive-container">
                <?php if ($child_pages) : ?>
                    <aside class="children-sidebar">
                        <nav class="children-nav" aria-label="Child pages navigation">
                            <?php
                            // Get the parent page title for the sidebar header
                            $parent_page = get_post($menu_parent_id);
                            ?>
                            <h2 class="sidebar-title">
                                <a href="<?php echo esc_url(get_permalink($menu_parent_id)); ?>"
                                   class="<?php echo ($current_page_id === $menu_parent_id) ? 'current-page' : ''; ?>">
                                    <?php echo esc_html($parent_page->post_title); ?>
                                </a>
                            </h2>

                            <ul class="children-menu">
                                <?php foreach ($child_pages as $child) : ?>
                                    <li class="<?php echo ($current_page_id === $child->ID) ? 'current-menu-item' : ''; ?>">
                                        <a href="<?php echo esc_url(get_permalink($child->ID)); ?>">
                                            <?php echo esc_html($child->post_title); ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </nav>
                    </aside>
                <?php endif; ?>

                <article id="page-<?php the_ID(); ?>" <?php post_class('page-content children-archive-content'); ?>>
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="page-featured-image">
                            <?php the_post_thumbnail('large'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="page-header">
                        <h1 class="page-title"><?php the_title(); ?></h1>
                    </div>

                    <div class="page-body">
                        <?php the_content(); ?>

                        <?php
                        wp_link_pages(array(
                            'before' => '<div class="page-links">',
                            'after'  => '</div>',
                        ));
                        ?>
                    </div>

                    <?php
                    // If this is the parent page and has no content, show child pages grid
                    if (!$parent_id && empty(trim(strip_tags(get_the_content())))) :
                        if ($child_pages) :
                    ?>
                        <div class="children-grid">
                            <?php foreach ($child_pages as $child) : ?>
                                <div class="child-card">
                                    <?php if (has_post_thumbnail($child->ID)) : ?>
                                        <div class="child-thumbnail">
                                            <a href="<?php echo esc_url(get_permalink($child->ID)); ?>">
                                                <?php echo get_the_post_thumbnail($child->ID, 'medium'); ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>

                                    <div class="child-content">
                                        <h3 class="child-title">
                                            <a href="<?php echo esc_url(get_permalink($child->ID)); ?>">
                                                <?php echo esc_html($child->post_title); ?>
                                            </a>
                                        </h3>

                                        <?php if ($child->post_excerpt) : ?>
                                            <div class="child-excerpt">
                                                <?php echo wp_kses_post($child->post_excerpt); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php
                        endif;
                    endif;
                    ?>
                </article>
            </div>

        <?php endwhile; ?>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
