<?php
/**
 * Template Name: Pray
 *
 * Custom template for the Pray page - completely independent of posts/archive templates
 */

get_header( 'top' ); ?>

<div class="page bg-secondary">

    <?php get_header(); ?>

    <main class="site-main">
        <div class="pray-page">
            <section>
                <div class="container stack stack--2xl">
                    <div class="stack stack-md">
                        <h1 class="h2 highlight-first"><?php echo __('Prayer for an unengaged people group', 'doxa-website'); ?></h1>
                        <p class="subtext"><?php echo __('Help prepare the way for gospel engagement through prayer.', 'doxa-website'); ?></p>
                    </div>
                    <div class="switcher">
                        <div class="card-two-tone | text-center grow-1">
                            <div class="stack stack--lg">
                                <h2 class="h3"><?php echo __('Prayer Goal', 'doxa-website'); ?></h2>
                                <p class="subtext font-size-md"><?php echo __('24-Hour Prayer Coverage', 'doxa-website'); ?></p>
                                <p class="subtext font-size-md"><?php echo __('Mobilize 144+ people praying 10 minutes a day for all 2,085 peoples.', 'doxa-website'); ?></p>
                            </div>
                            <div>
                                <h2 class="h3"><?php echo __('Current Status', 'doxa-website'); ?></h2>
                                <span class="font-size-4xl font-weight-bold font-button" id="prayer-current-status">124 / 2085</span>
                                <div class="stack stack--3xs">
                                    <p class="subtext font-size-md"><?php echo __('People groups with 24-hour prayer.', 'doxa-website'); ?></p>
                                    <div class="progress-bar" data-size="md">
                                        <div class="progress-bar__slider" style="width: <?php echo esc_attr( 124 / 2085 * 100 ); ?>%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grow-2 bg-image rounded-md" style="background-image: url('https://placehold.co/800x600/455449/bbb');">
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <?php get_footer(); ?>

</div>

<?php get_footer( 'bottom' ); ?>
