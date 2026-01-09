<?php
/**
 * Template Name: Contact Page
 *
 * A contact page template
 */

get_header( 'top' ); ?>

<div class="page">

    <?php get_header(); ?>

    <main class="site-main">
        <div class="container page-content">

            <h1 class="page-title"><?php echo esc_html__('Contact Us', 'doxa-website'); ?></h1>

            <form action="" class="stack stack--md">
                <div class="">
                    <label for="name"><?php echo esc_html__('Name', 'doxa-website'); ?></label>
                    <input type="text" id="name" name="name" required placeholder="<?php echo esc_attr__('Enter your name', 'doxa-website'); ?>">
                </div>
                <div class="">
                    <label for="email"><?php echo esc_html__('Email', 'doxa-website'); ?></label>
                    <input type="email" id="email" name="email" required placeholder="<?php echo esc_attr__('Enter your email', 'doxa-website'); ?>">
                </div>
                <div class="">
                    <label for="message"><?php echo esc_html__('Message', 'doxa-website'); ?></label>
                    <textarea id="message" name="message" rows="5" required placeholder="<?php echo esc_attr__('Enter your message', 'doxa-website'); ?>"></textarea>
                </div>
                <button type="submit" class="button"><?php echo esc_html__('Submit', 'doxa-website'); ?></button>
            </form>

        </div>
    </main>

    <?php get_footer(); ?>

</div>

<?php get_footer( 'bottom' ); ?>
