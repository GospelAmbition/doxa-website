<?php
/**
 * The front page template file
 */

get_header( 'top' ); ?>

<div class="page">

    <?php get_header(); ?>

    <main class="site-main">
        <div class="front-page">
            <section class="stack stack--md container">
                <div>
                    <h2 class="color-brand"><?php echo __('Our gift to Jesus', 'doxa-website'); ?>:</h2>
                    <h1 class="color-brand-light highlight" data-highlight-index="1" data-highlight-last data-highlight-color="primary"><?php echo __('Engage every people by 2033', 'doxa-website'); ?></h1>
                </div>
                <div>
                    <img
                        class="rounded-xlg"
                        src="<?php echo get_template_directory_uri(); ?>/assets/images/home-01-hero.jpg"
                        alt="<?php echo __('Engage every people by 2033', 'doxa-website'); ?>"
                    >
                </div>
            </section>
            <section class="stack stack--md | surface-brand-light">
                <div class="container stack stack--4xl">
                    <div class="stack stack--2xl">
                        <h2 class="highlight" data-highlight-index="1"><?php echo sprintf( __( '%s unengaged people groups', 'doxa-website'), '2,085' ); ?></h2>
                        <p class="subtext">
                            <?php echo __('Our hope is to see each one of them covered in 24-hour prayer, and your church can be part of it.', 'doxa-website'); ?>
                        </p>
                    </div>
                    <div class="reel" data-reel-mode="auto-scroll">
                        <div class="stack stack--sm | reel__item">
                            <div><img class="square rounded-md" src="<?php echo get_template_directory_uri(); ?>/assets/images/jp-bedouin-gulf.jpg" alt="<?php echo __('Gulf Bedouin', 'doxa-website'); ?>"></div>
                            <p class="text-center uppercase"><?php echo __('Gulf Bedouin', 'doxa-website'); ?></p>
                        </div>
                        <div class="stack stack--sm | reel__item">
                            <div><img class="square rounded-md" src="<?php echo get_template_directory_uri(); ?>/assets/images/jp-bobo-madare.jpg" alt="<?php echo __('Bobo Madare', 'doxa-website'); ?>"></div>
                            <p class="text-center uppercase"><?php echo __('Bobo Madare', 'doxa-website'); ?></p>
                        </div>
                        <div class="stack stack--sm | reel__item">
                            <div><img class="square rounded-md" src="<?php echo get_template_directory_uri(); ?>/assets/images/jp-bosniak.jpg" alt="<?php echo __('Bosniak', 'doxa-website'); ?>"></div>
                            <p class="text-center uppercase"><?php echo __('Bosniak', 'doxa-website'); ?></p>
                        </div>
                        <div class="stack stack--sm | reel__item">
                            <div><img class="square rounded-md" src="<?php echo get_template_directory_uri(); ?>/assets/images/jp-chhipa.jpg" alt="<?php echo __('Chhipa', 'doxa-website'); ?>"></div>
                            <p class="text-center uppercase"><?php echo __('Chhipa', 'doxa-website'); ?></p>
                        </div>
                        <div class="stack stack--sm | reel__item">
                            <div><img class="square rounded-md" src="<?php echo get_template_directory_uri(); ?>/assets/images/jp-rtaho-amdo.jpg" alt="<?php echo __('Rtahu Amdo', 'doxa-website'); ?>"></div>
                            <p class="text-center uppercase"><?php echo __('Rtahu Amdo', 'doxa-website'); ?></p>
                        </div>
                        <div class="stack stack--sm | reel__item">
                            <div><img class="square rounded-md" src="<?php echo get_template_directory_uri(); ?>/assets/images/jp-maninka-eastern.jpg" alt="<?php echo __('Eastern Maninka', 'doxa-website'); ?>"></div>
                            <p class="text-center uppercase"><?php echo __('Eastern Maninka', 'doxa-website'); ?></p>
                        </div>
                        <div class="stack stack--sm | reel__item">
                            <div><img class="square rounded-md" src="<?php echo get_template_directory_uri(); ?>/assets/images/jp-algerian.jpg" alt="<?php echo __('Algerian', 'doxa-website'); ?>"></div>
                            <p class="text-center uppercase"><?php echo __('Algerian', 'doxa-website'); ?></p>
                        </div>
                        <div class="stack stack--sm | reel__item">
                            <div><img class="square rounded-md" src="<?php echo get_template_directory_uri(); ?>/assets/images/jp-hadrami.jpg" alt="<?php echo __('Hadrami Arab', 'doxa-website'); ?>"></div>
                            <p class="text-center uppercase"><?php echo __('Hadrami Arab', 'doxa-website'); ?></p>
                        </div>
                        <div class="stack stack--sm | reel__item">
                            <div><img class="square rounded-md" src="<?php echo get_template_directory_uri(); ?>/assets/images/jp-awlad-hassan.jpg" alt="<?php echo __('Awlad Hassan', 'doxa-website'); ?>"></div>
                            <p class="text-center uppercase"><?php echo __('Awlad Hassan', 'doxa-website'); ?></p>
                        </div>
                    </div>
                    <div class="stack stack--2xl">
                        <h2 class="highlight" data-highlight-last><?php echo __('A simple path to faithful obedience', 'doxa-website'); ?></h2>
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
            <section class="bg-image" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/home-02-WhoAreTheUnreached.jpg');">
                <h2 class="text-center banner-title"><?php echo __('Who are the unreached?', 'doxa-website'); ?></h2>
            </section>
            <section class="surface-white">
                <div class="container stack stack--xl">
                    <h3 class="color-primary text-center"><?php echo __('48% of the world population', 'doxa-website'); ?></h3>
                    <div class="switcher | gap-md" data-width="lg">
                        <div class="switcher-item">
                            <div class="info-card surface-secondary-light">
                                <div class="stack stack--lg | info-card__content">
                                    <h3 class="color-brand-lighter"><?php echo __('Unreached', 'doxa-website'); ?></h3>
                                    <span><?php echo sprintf( __( '%s Billion', 'doxa-website'), '3.9' ); ?></span>
                                    <span class="color-brand-lighter"><?php echo sprintf( __( '%s People Groups', 'doxa-website'), '6,602' ); ?></span>
                                </div>
                                <button class="button | compact"><?php echo __('More', 'doxa-website'); ?></button>
                            </div>
                        </div>
                        <div class="switcher-item">
                            <div class="info-card surface-brand-lightest">
                                <div class="stack stack--lg | info-card__content">
                                    <h3><?php echo __('Under-Engaged', 'doxa-website'); ?></h3>
                                    <span class="color-secondary-light"><?php echo sprintf( __( '%s Billion', 'doxa-website'), '3.3' ); ?></span>
                                    <span><?php echo sprintf( __( '%s People Groups', 'doxa-website'), '5,119' ); ?></span>
                                </div>
                                <button class="button | compact"><?php echo __('More', 'doxa-website'); ?></button>
                            </div>
                        </div>
                        <div class="switcher-item">
                            <div class="info-card surface-brand-light">
                                <div class="stack stack--lg | info-card__content">
                                    <h3><?php echo __('Frontier People', 'doxa-website'); ?></h3>
                                    <span class="color-secondary-light"><?php echo sprintf( __( '%s Billion', 'doxa-website'), '2' ); ?></span>
                                    <span><?php echo sprintf( __( '%s People Groups', 'doxa-website'), '4,788' ); ?></span>
                                </div>
                                <button class="button | compact"><?php echo __('More', 'doxa-website'); ?></button>
                            </div>
                        </div>
                        <div class="switcher-item">
                            <div class="info-card surface-brand-dark">
                                <div class="stack stack--lg | info-card__content">
                                    <h3><?php echo __('Unengaged', 'doxa-website'); ?></h3>
                                    <span><?php echo sprintf( __( '%s Million', 'doxa-website'), '202' ); ?></span>
                                    <span><?php echo sprintf( __( '%s People Groups', 'doxa-website'), '2,085' ); ?></span>
                                </div>
                                <button class="button | compact"><?php echo __('More', 'doxa-website'); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section>
                <div class="container stack stack--xl">
                    <h2><?php echo __('Vision 2033', 'doxa-website'); ?></h2>
                    <div class="card shadow">
                        <div class="switcher" data-width="xl">
                            <div class="switcher-item grow-none">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home-03-Vision-2033.jpg" alt="<?php echo __('Vision 2033', 'doxa-website'); ?>">
                            </div>
                            <div class="switcher-item align-center justify-center">
                                <div class="stack stack--xl">
                                    <h3 class="subtext"><?php echo __('In partnership with the global church, our vision is to...', 'doxa-website'); ?></h3>
                                    <ul class="stack stack--md" data-list-color="primary">
                                        <li><?php echo __('Engage all unengaged peoples by 2033.', 'doxa-website'); ?></li>
                                        <li><?php echo __('Mobilize 20,000+ DOXA partnership missionaries', 'doxa-website'); ?></li>
                                        <li><?php echo __('Advance fruitful engagement among frontier and under-engaged peoples.', 'doxa-website'); ?></li>
                                        <li><?php echo __('Catalyze church-planting movements among all unreached peoples.', 'doxa-website'); ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
            <section class="surface-brand-light">
                <div class="container stack stack--3xl">
                    <h2 class="highlight" data-highlight-last><?php echo __('Engagement starts with prayer', 'doxa-website'); ?></h2>
                    <div class="switcher | align-center">
                        <div class="switcher-item grow-none">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home-04-EngagementStartsWithPrayer.jpg" alt="<?php echo __('Engagement starts with prayer', 'doxa-website'); ?>">
                        </div>
                        <div>
                            <div class="stack stack--3xl | align-center">
                                <p class="text-center max-width-md font-size-lg"><?php echo __('Every momevent of the gospel begins with intercession. Cover an unengaged people group in daily prayer and help prepare the way.', 'doxa-website'); ?></p>
                                <a href="/pray" class="button | compact"><?php echo __('Pray', 'doxa-website'); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section>
                <div class="switcher container | gap-md" data-width="xl">
                    <div class="switcher-item card | bg-image align-center" style="background-image: url('https://placehold.co/800x600/455449/bbb');">
                        <div class="stack stack--md | text-center text-secondary">
                            <h2><?php echo __('What does "DOXA" mean?', 'doxa-website'); ?></h2>
                            <p class="subtext"><?php echo __('DOXA is the Greek word for "GLORY".', 'doxa-website'); ?></p>
                            <p><?php echo __('We chose this name because Jesus is worthy of glory from every tribe, tongue, people and nation. DOXA remindns us that we partner with the whole Church to take the whole gospel to the whole world - until people from every nation are worshipping Jesus and He alone receives all the glory.', 'doxa-website'); ?></p>
                        </div>
                    </div>
                    <div class="switcher-item | grow-none">
                        <img class="rounded-xlg" src="<?php echo get_template_directory_uri(); ?>/assets/images/home-05-WhatDoesDoxaMean.jpg" alt="<?php echo __('Engagement starts with prayer', 'doxa-website'); ?>">
                    </div>
                </div>
            </section>
        </div>
    </main>

    <?php get_footer(); ?>

</div>

<?php get_footer( 'bottom' ); ?>


