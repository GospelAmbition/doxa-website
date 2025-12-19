<?php
/**
 * The front page template file
 */

get_header( 'top' ); ?>

<div class="page">

    <?php get_header(); ?>

    <main class="site-main">
        <div class="page-content front-page">
            <section class="stack stack--md container">
                <div>
                    <h2 class="color-brand"><?php echo __('Our gift to Jesus', 'doxa-website'); ?>:</h2>
                    <h1 class="color-brand-light highlight-first highlight-last" data-highlight-color="primary"><?php echo __('Engage every people by 2033', 'doxa-website'); ?></h1>
                </div>
                <div>
                    <!-- <img src="<?php echo get_template_directory_uri(); ?>/assets/images/front-page-image.jpg" alt="<?php echo __('Engage every people by 2033', 'doxa-website'); ?>"> -->
                    <img src="https://placehold.co/1200x600" alt="<?php echo __('Engage every people by 2033', 'doxa-website'); ?>">
                </div>
            </section>
            <section class="stack stack--md | surface-brand-light">
                <div class="container stack stack--4xl">
                    <div class="stack stack--2xl">
                        <h2 class="highlight-first"><?php echo sprintf( __( '%s unengaged people groups', 'doxa-website'), '2,085' ); ?></h2>
                        <p class="subtext">
                            <?php echo __('Our hope is to see each one of them covered in 24-hour prayer, and your church can be part of it.', 'doxa-website'); ?>
                        </p>
                    </div>
                    <div class="reel" data-reel-mode="auto-scroll">
                        <div class="stack stack--sm | reel__item">
                            <div><img class="square rounded-md" src="https://placehold.co/250x250" alt="<?php echo __('Gulf Bedouin', 'doxa-website'); ?>"></div>
                            <p class="text-center uppercase"><?php echo __('Gulf Bedouin', 'doxa-website'); ?></p>
                        </div>
                        <div class="stack stack--sm | reel__item">
                            <div><img class="square rounded-md" src="https://placehold.co/250x250" alt="<?php echo __('Bobo Madare', 'doxa-website'); ?>"></div>
                            <p class="text-center uppercase"><?php echo __('Bobo Madare', 'doxa-website'); ?></p>
                        </div>
                        <div class="stack stack--sm | reel__item">
                            <div><img class="square rounded-md" src="https://placehold.co/250x250" alt="<?php echo __('Bosniak', 'doxa-website'); ?>"></div>
                            <p class="text-center uppercase"><?php echo __('Bosniak', 'doxa-website'); ?></p>
                        </div>
                        <div class="stack stack--sm | reel__item">
                            <div><img class="square rounded-md" src="https://placehold.co/250x250" alt="<?php echo __('Chhipa', 'doxa-website'); ?>"></div>
                            <p class="text-center uppercase"><?php echo __('Chhipa', 'doxa-website'); ?></p>
                        </div>
                        <div class="stack stack--sm | reel__item">
                            <div><img class="square rounded-md" src="https://placehold.co/250x250" alt="<?php echo __('Rtahu Amdo', 'doxa-website'); ?>"></div>
                            <p class="text-center uppercase"><?php echo __('Rtahu Amdo', 'doxa-website'); ?></p>
                        </div>
                        <div class="stack stack--sm | reel__item">
                            <div><img class="square rounded-md" src="https://placehold.co/250x250" alt="<?php echo __('Eastern Maninka', 'doxa-website'); ?>"></div>
                            <p class="text-center uppercase"><?php echo __('Eastern Maninka', 'doxa-website'); ?></p>
                        </div>
                        <div class="stack stack--sm | reel__item">
                            <div><img class="square rounded-md" src="https://placehold.co/250x250" alt="<?php echo __('Algerian', 'doxa-website'); ?>"></div>
                            <p class="text-center uppercase"><?php echo __('Algerian', 'doxa-website'); ?></p>
                        </div>
                        <div class="stack stack--sm | reel__item">
                            <div><img class="square rounded-md" src="https://placehold.co/250x250" alt="<?php echo __('Hadrami Arab', 'doxa-website'); ?>"></div>
                            <p class="text-center uppercase"><?php echo __('Hadrami Arab', 'doxa-website'); ?></p>
                        </div>
                        <div class="stack stack--sm | reel__item">
                            <div><img class="square rounded-md" src="https://placehold.co/250x250" alt="<?php echo __('Awlad Hassan', 'doxa-website'); ?>"></div>
                            <p class="text-center uppercase"><?php echo __('Awlad Hassan', 'doxa-website'); ?></p>
                        </div>
                        <div class="stack stack--sm | reel__item">
                            <div><img class="square rounded-md" src="https://placehold.co/250x250" alt="<?php echo __('Jiluuk', 'doxa-website'); ?>"></div>
                            <p class="text-center uppercase"><?php echo __('Jiluuk', 'doxa-website'); ?></p>
                        </div>
                    </div>
                    <div class="stack stack--2xl">
                        <h2 class="highlight-last"><?php echo __('A simple path to faithful obedience', 'doxa-website'); ?></h2>
                        <div class="switcher | gap-md">
                            <div class="step-card">
                                <div class="step-card__number">1</div>
                                <div class="step-card__content">
                                    <h2 class="step-card__title"><?php echo __('Pray', 'doxa-website'); ?></h2>
                                    <p><?php echo __('Receive daily prayer points and join believers worldwide in prayer for the unengaged peoples.', 'doxa-website'); ?></p>
                                </div>
                                <a href="/pray" class="button | compact"><?php echo __('Join', 'doxa-website'); ?></a>
                            </div>
                            <div class="step-card">
                                <div class="step-card__number">2</div>
                                <div class="step-card__content">
                                    <h2 class="step-card__title"><?php echo __('Adopt', 'doxa-website'); ?></h2>
                                    <p><?php echo __('Churches and networks take ownership - praying, giving and preparing the way for gospel workers.', 'doxa-website'); ?></p>
                                </div>
                                <a href="/adopt" class="button | compact"><?php echo __('Commit', 'doxa-website'); ?></a>
                            </div>
                            <div class="step-card">
                                <div class="step-card__number">3</div>
                                <div class="step-card__content">
                                    <h2 class="step-card__title"><?php echo __('Engage', 'doxa-website'); ?></h2>
                                    <p><?php echo __('God raises up men and women to go, serve, and proclaim Christ among the nations', 'doxa-website'); ?></p>
                                </div>
                                <a href="/engage" class="button | compact"><?php echo __('Go', 'doxa-website'); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="bg-image" style="background-image: url('https://placehold.co/1200x600');">
                <h2 class="text-center banner-title"><?php echo __('Who are the unreached?', 'doxa-website'); ?></h2>
            </section>
            <section class="surface-white">
                <div class="container stack stack--xl">
                    <h3 class="color-primary text-center"><?php echo __('48% of the world population', 'doxa-website'); ?></h3>
                    <div class="switcher">
                        <div class="stack stack--xs | card info-card">
                            <h3><?php echo __('Unreached', 'doxa-website'); ?></h3>
                            <span><?php echo sprintf( __( '%s Billion', 'doxa-website'), '3.9' ); ?></span>
                            <span><?php echo sprintf( __( '%s People Groups', 'doxa-website'), '6,602' ); ?></span>
                            <button class="button | compact"><?php echo __('More', 'doxa-website'); ?></button>
                        </div>
                        <div class="stack stack--xs | card info-card">
                            <h3><?php echo __('Under-Engaged', 'doxa-website'); ?></h3>
                            <span><?php echo sprintf( __( '%s Billion', 'doxa-website'), '3.3' ); ?></span>
                            <span><?php echo sprintf( __( '%s People Groups', 'doxa-website'), '5,119' ); ?></span>
                            <button class="button | compact"><?php echo __('More', 'doxa-website'); ?></button>
                        </div>
                        <div class="stack stack--xs | card info-card">
                            <h3><?php echo __('Frontier People', 'doxa-website'); ?></h3>
                            <span><?php echo sprintf( __( '%s Billion', 'doxa-website'), '2' ); ?></span>
                            <span><?php echo sprintf( __( '%s People Groups', 'doxa-website'), '4,788' ); ?></span>
                            <button class="button | compact"><?php echo __('More', 'doxa-website'); ?></button>
                        </div>
                        <div class="stack stack--xs | card info-card">
                            <h3><?php echo __('Unengaged', 'doxa-website'); ?></h3>
                            <span><?php echo sprintf( __( '%s Million', 'doxa-website'), '202' ); ?></span>
                            <span><?php echo sprintf( __( '%s People Groups', 'doxa-website'), '2,085' ); ?></span>
                            <button class="button | compact"><?php echo __('More', 'doxa-website'); ?></button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <?php get_footer(); ?>

</div>

<?php get_footer( 'bottom' ); ?>


