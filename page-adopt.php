<?php
/**
 * Template Name: Adopt
 *
 * Custom template for the Adopt page - completely independent of posts/archive templates
 */

get_header( 'top' ); ?>

<div class="page bg-secondary">

    <?php get_header(); ?>

    <main class="site-main">
        <div class="adopt-page">
            <section>
                <div class="container stack stack--2xl">
                    <div class="stack stack-md">
                        <h1 class="h2 highlight" data-highlight-index="1"><?php echo __('Adopt an unengaged people group', 'doxa-website'); ?></h1>
                        <p class="subtext"><?php echo __('A church-led commitment to pray, give, and send so that gospel access begins.', 'doxa-website'); ?></p>
                    </div>
                    <div class="switcher">
                        <div class="card-two-tone | text-center grow-1">
                            <div class="stack stack--lg">
                                <h2 class="h3"><?php echo __('Adoption Goal', 'doxa-website'); ?></h2>
                                <p class="subtext font-size-md"><?php echo __('Every unengaged people group adopted by a church committed to prayer, giving, and sending.', 'doxa-website'); ?></p>
                            </div>
                            <div>
                                <h2 class="h3"><?php echo __('Current Status', 'doxa-website'); ?></h2>
                                <span class="font-size-4xl font-weight-bold font-button" id="prayer-current-status">124 / 2085</span>
                                <div class="stack stack--3xs">
                                    <p class="subtext font-size-md"><?php echo __('people groups adopted', 'doxa-website'); ?></p>
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
            <section class="surface-brand-light">
                <div class="container stack stack--3xl">
                    <h2><?php echo __('Where do I start?', 'doxa-website'); ?></h2>
                    <div class="switcher | gap-md">
                        <div class="step-card">
                            <div class="step-card__number">1</div>
                            <div class="step-card__content" data-no-action>
                                <h2 class="step-card__title"><?php echo __('Choose', 'doxa-website'); ?></h2>
                                <p><?php echo __('Prayerfully select an unengaged people group to adopt.', 'doxa-website'); ?></p>
                            </div>
                        </div>
                        <div class="step-card">
                            <div class="step-card__number">2</div>
                            <div class="step-card__content" data-no-action>
                                <h2 class="step-card__title"><?php echo __('Mobilize', 'doxa-website'); ?></h2>
                                <p><?php echo __('Raise up 144+ daily intercessors to pray 10 minutes a day.', 'doxa-website'); ?></p>
                            </div>
                        </div>
                        <div class="step-card">
                            <div class="step-card__number">3</div>
                            <div class="step-card__content" data-no-action>
                                <h2 class="step-card__title"><?php echo __('Partner', 'doxa-website'); ?></h2>
                                <p><?php echo __('Partner through prayer, giving, and sending so that gospel access begins.', 'doxa-website'); ?></p>
                            </div>
                        </div>
                    </div>
                    <a href="#choose-people-group" class="button | compact mx-auto"><?php echo __('Get Started', 'doxa-website'); ?></a>
                </div>
            </section>
            <section>
                <div class="container">
                    <div class="stack stack--lg">
                        <h2><?php echo __('Why adoption matters', 'doxa-website'); ?></h2>
                        <div class="switcher | gap-md">
                            <div class="grow-none">
                                <img src="https://placehold.co/150x200" alt="<?php echo __('Adopt an unengaged people group', 'doxa-website'); ?>">
                            </div>
                            <div class="stack stack--lg | text-card | surface-brand-lightest">
                                <h4><?php echo __('They have no gospel access', 'doxa-website'); ?></h4>
                                <p><?php echo __('Unengaged people groups have no missionaries, no churches, and often no known believers. Adoption helps ensure they are finally seen, prayed for, and intentionally pursued with the gospel.', 'doxa-website'); ?></p>
                            </div>
                        </div>
                        <div class="switcher | gap-md">
                            <div class="grow-none">
                                <img src="https://placehold.co/150x200" alt="<?php echo __('Adopt an unengaged people group', 'doxa-website'); ?>">
                            </div>
                            <div class="stack stack--lg | text-card | surface-brand-lightest">
                                <h4><?php echo __('Prayer opens the door for engagement', 'doxa-website'); ?></h4>
                                <p><?php echo __('Adoption mobilizes 144+ daily intercessors, creating 24 hours of prayer that prepares the soil, breaks spritual barriers, and supports workers who go. Every gospel movement begins with prayer.', 'doxa-website'); ?></p>
                            </div>
                        </div><div class="switcher | gap-md">
                            <div class="grow-none">
                                <img src="https://placehold.co/150x200" alt="<?php echo __('Adopt an unengaged people group', 'doxa-website'); ?>">
                            </div>
                            <div class="stack stack--lg | text-card | surface-brand-lightest">
                                <h4><?php echo __('Churches become active partners in God\'s mission', 'doxa-website'); ?></h4>
                                <p><?php echo __('Adoptoin invites the local church into meaningful participation - praying, giving and sending - so that a people group moves from unengaged to engaged, and ultimately becomes a worshipping community for Jesus.', 'doxa-website'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="surface-brand-dark">
                <div class="container stack stack--3xl">
                    <div class="stack stack--md">
                        <h2 id="choose-people-group"><?php echo __('Choose a people group', 'doxa-website'); ?></h2>
                        <p class="subtext"><?php echo __('Select one of these six highlighted engaged people groups - or search for more below.', 'doxa-website'); ?></p>
                    </div>
                    <highlighted-people-groups
                        selectUrl="/adopt"
                        t="<?php echo esc_attr( json_encode( [
                            'select' => __('Select', 'doxa-website'),
                            'full_profile' => __('Full Profile', 'doxa-website'),
                            'prayer_coverage' => __('Prayer Coverage', 'doxa-website'),
                            'loading' => __('Loading results...', 'doxa-website'),
                        ])); ?>"
                        numberOfPeopleGroups="6"
                    ></highlighted-people-groups>

                    <uupgs-list
                        selectUrl="/adopt"
                        t="<?php echo esc_attr( json_encode( [
                            'select' => __('Select', 'doxa-website'),
                            'full_profile' => __('Full Profile', 'doxa-website'),
                            'prayer_coverage' => __('Prayer Coverage', 'doxa-website'),
                            'loading' => __('Loading results...', 'doxa-website'),
                            'load_more' => __('Load More', 'doxa-website'),
                            'total' => __('Total', 'doxa-website'),
                            'search' => __('Search people names', 'doxa-website'),
                        ])); ?>"
                        perPage="6"
                        preventInitialFetch="true"
                    ></uupgs-list>
                </div>
            </section>
            <section>
                <div class="container stack stack--5xl">
                    <figure class="text-center font-size-5xl font-heading">
                        <blockquote><?php echo __('A great quote about praying, giving and sending', 'doxa-website'); ?></blockquote>
                        <figcaption>-<?php echo __('The Bible', 'doxa-website'); ?></figcaption>
                    </figure>
                    <div><img src="https://placehold.co/1200x300" alt="<?php echo __('Jesus', 'doxa-website'); ?>"></div>
                </div>
            </section>
        </div>
    </main>

    <?php get_footer(); ?>

</div>

<?php get_footer( 'bottom' ); ?>
