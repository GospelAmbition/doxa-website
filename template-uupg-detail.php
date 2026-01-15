<?php
/**
 * Template Name: UUPG Detail
 *
 * Custom template for the UUPG detail page - completely independent of posts/archive templates
 */

$slug = get_query_var( 'uupg_slug' );

$uupg = get_uupg_by_slug( $slug );

?>


<?php if ( isset( $uupg['error'] ) ) : ?>
    <?php get_header( 'top' ); ?>
    <div class="page">
        <?php get_header(); ?>
        <main class="site-main">
            <div class="container page-content uupg-detail-page">
                <div class="stack stack--lg">
                    <h1><?php echo __('People Group Not Found', 'doxa-website'); ?></h1>
                    <p><?php echo __('The people group you are looking for could not be found. Please try again.', 'doxa-website'); ?></p>
                    <a class="button font-size-lg" href="<?php echo home_url('/research'); ?>">
                        <span class="sr-only"><?php echo __('Back', 'doxa-website'); ?></span>
                        <svg class="icon | rotate-270" viewBox="0 0 489.67 289.877">
                            <path d="M439.017,211.678L263.258,35.919c-3.9-3.9-8.635-6.454-13.63-7.665-9.539-2.376-20.051.161-27.509,7.619L46.361,211.632c-11.311,11.311-11.311,29.65,0,40.961h0c11.311,11.311,29.65,11.311,40.961,0L242.667,97.248l155.39,155.39c11.311,11.311,29.65,11.311,40.961,0h0c11.311-11.311,11.311-29.65,0-40.961Z"/>
                        </svg>
                        <?php echo __('Back', 'doxa-website'); ?>
                    </a>
                </div>
            </div>
        </main>
        <?php get_footer(); ?>
    </div>
    <?php get_footer( 'bottom' ); ?>
<?php endif; ?>

<?php get_header( 'top' ); ?>

<div class="page">

    <?php get_header(); ?>

    <main class="site-main">
        <div class="container page-content uupg-detail-page">
            <button class="icon-button color-primary font-size-5xl" data-action="back" data-url="<?php echo home_url('/research'); ?>">
                <span class="sr-only"><?php echo __('Back', 'doxa-website'); ?></span>
                <svg class="icon | rotate-270" viewBox="0 0 489.67 289.877">
                    <path d="M439.017,211.678L263.258,35.919c-3.9-3.9-8.635-6.454-13.63-7.665-9.539-2.376-20.051.161-27.509,7.619L46.361,211.632c-11.311,11.311-11.311,29.65,0,40.961h0c11.311,11.311,29.65,11.311,40.961,0L242.667,97.248l155.39,155.39c11.311,11.311,29.65,11.311,40.961,0h0c11.311-11.311,11.311-29.65,0-40.961Z"/>
                </svg>
            </button>
            <div class="stack stack--lg">

                <div class="stack stack--2xl">
                    <div class="card switcher align-center" padding-small>
                        <div class="engaged-stamp" data-engaged="false">
                            <span><?php echo __('Not Engaged', 'doxa-website'); ?></span></div>
                        <img class="uupg__image | grow-none" data-size="medium" src="<?php echo esc_attr( $uupg['imb_picture_url'] ); ?>" alt="<?php echo esc_attr( $uupg['imb_display_name'] ); ?>">
                        <div class="stack stack--xs | uupg__header">
                            <h4 class="font-base font-weight-medium font-size-2xl"><?php echo esc_html( $uupg['imb_display_name'] ); ?></h4>
                            <p class="font-weight-medium font-size-lg"><?php echo esc_html( $uupg['imb_isoalpha3']['label'] ); ?> (<?php echo esc_html( $uupg['imb_reg_of_people_1']['label'] ); ?>)</p>
                            <p><?php echo esc_html( $uupg['imb_people_description'] ); ?></p>
                        </div>
                    </div>
                    <div class="card stack stack--2xs" id="engagement-status" padding-small>
                        <h2 class="text-center"><?php echo __('Engagement Status', 'doxa-website'); ?></h2>
                        <div class="cluster justify-center">
                            <div class="cluster justify-center align-start" data-width="md">
                                <div class="status-item">
                                    <?php if ( $uupg['people_praying'] > 0 ) : ?>
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/Check-GreenCircle.png" alt="<?php echo __('Done', 'doxa-website'); ?>">
                                    <?php else : ?>
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/RedX-Circle.png" alt="<?php echo __('Not Done', 'doxa-website'); ?>">
                                    <?php endif; ?>
                                    <p><?php echo __('Prayer Status', 'doxa-website'); ?></p>
                                </div>
                                <div class="status-item">
                                    <?php if ( $uupg['adopted_by_churches'] > 0 ) : ?>
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/Check-GreenCircle.png" alt="<?php echo __('Done', 'doxa-website'); ?>">
                                    <?php else : ?>
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/RedX-Circle.png" alt="<?php echo __('Not Done', 'doxa-website'); ?>">
                                    <?php endif; ?>
                                    <p><?php echo __('Adoption Status', 'doxa-website'); ?></p>
                                </div>
                                <div class="status-item">
                                    <?php if ( $uupg['cross_cultural_workers_present'] > 0 ) : ?>
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/Check-GreenCircle.png" alt="<?php echo __('Done', 'doxa-website'); ?>">
                                    <?php else : ?>
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/RedX-Circle.png" alt="<?php echo __('Not Done', 'doxa-website'); ?>">
                                    <?php endif; ?>
                                    <p><?php echo __('Cross-cultural workers present', 'doxa-website'); ?></p>
                                </div>
                                <div class="status-item">
                                    <?php if ( $uupg['work_in_local_language'] ) : ?>
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/Check-GreenCircle.png" alt="<?php echo __('Done', 'doxa-website'); ?>">
                                    <?php else : ?>
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/RedX-Circle.png" alt="<?php echo __('Not Done', 'doxa-website'); ?>">
                                    <?php endif; ?>
                                    <p><?php echo __('Work in local language &amp; culture', 'doxa-website'); ?></p>
                                </div>
                                <div class="status-item">
                                    <?php if ( $uupg['disciple_and_church_multiplication'] ) : ?>
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/Check-GreenCircle.png" alt="<?php echo __('Done', 'doxa-website'); ?>">
                                    <?php else : ?>
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/RedX-Circle.png" alt="<?php echo __('Not Done', 'doxa-website'); ?>">
                                    <?php endif; ?>
                                    <p><?php echo __('Disciple &amp; church multiplication', 'doxa-website'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="switcher">
                        <div class="stack stack--xl | card | text-center lh-0" data-variant="secondary">
                            <h2><?php echo __('Prayer Status', 'doxa-website'); ?></h2>
                            <p class="font-size-4xl font-weight-medium"><?php echo $uupg['people_praying'] ?></p>
                            <p class="font-size-lg"><?php echo __('people praying', 'doxa-website'); ?></p>
                            <div class="stack stack--sm">
                                <div class="progress-bar" data-size="md">
                                    <div class="progress-bar__slider" style="width: <?php echo esc_attr( $uupg['people_praying'] / 144 * 100 ); ?>%"></div>
                                </div>
                                <p class="font-size-lg font-weight-medium"><?php echo __('24-hour Prayer Coverage', 'doxa-website'); ?></p>
                            </div>
                            <a class="button fit-content mx-auto stack-spacing-4xl" href="https://pray.doxa.life/<?php echo $uupg['slug']; ?>"><?php echo __('Sign up to pray', 'doxa-website'); ?></a>
                        </div>
                        <div class="stack stack--xl | card | text-center lh-0" data-variant="primary">
                            <h2><?php echo __('Adoption Status', 'doxa-website'); ?></h2>
                            <p class="font-size-4xl font-weight-medium"><?php echo $uupg['adopted_by_churches'] ? count( $uupg['adopted_by_churches'] ) : 0; ?></p>
                            <p class="font-size-lg"><?php echo __('churches/individuals have adopted this people group', 'doxa-website'); ?></p>
                            <a class="button fit-content mx-auto mt-auto" href="<?php echo home_url('adopt/' . $uupg['slug']); ?>"><?php echo __('Adopt people group', 'doxa-website'); ?></a>
                        </div>
                    </div>
                    <div class="card">
                        <h2><?php echo __('Map', 'doxa-website'); ?></h2>
                        <p>Vivamus lacinia lacus vel neque egestas, vitae volutpat purus dapibus. Nullam nec ultricies erat. Etiam ac urna metus. Sed cursus libero id ullamcorper interdum. Donec non urna et erat vehicula porttitor. Vivamus a sagittis dolor. Nulla facilisi. Cras euismod orci at felis cursus, vel vulputate sapien suscipit.</p>
                    </div>
                    <div class="switcher">
                        <div class="card" data-variant="primary">
                            <div class="stack">
                                <h2 class="color-primary"><?php echo __('Overview', 'doxa-website'); ?></h2>
                                <p><strong><?php echo __('Country', 'doxa-website'); ?>:</strong> <?php echo esc_html( $uupg['imb_isoalpha3']['label'] ); ?></p>

                                <?php if ( isset( $uupg['imb_alternate_name'] ) ) : ?>
                                    <p><strong><?php echo __('Alternate Names', 'doxa-website'); ?>:</strong> <?php echo esc_html( $uupg['imb_alternate_name'] ); ?></p>
                                <?php endif; ?>
                                <p><strong><?php echo __('Population', 'doxa-website'); ?>:</strong> ~<?php echo esc_html( $uupg['imb_population'] ); ?></p>
                                <p><strong><?php echo __('Primary Language', 'doxa-website'); ?>:</strong> <?php echo esc_html( $uupg['imb_reg_of_language']['label'] ); ?></p>
                                <p><strong><?php echo __('Primary Religion', 'doxa-website'); ?>:</strong> <?php echo esc_html( $uupg['imb_reg_of_religion']['label'] ); ?></p>
                                <p><strong><?php echo __('Religious Practices', 'doxa-website'); ?>:</strong> <br><?php echo esc_html( $uupg['imb_reg_of_religion']['description'] ); ?></p>
                            </div>
                        </div>
                        <div class="stack | card" data-variant="primary">
                            <h2 class="color-primary"><?php echo __('Progress', 'doxa-website'); ?></h2>
                            <p class="progress-item">
                                <?php if ( $uupg['imb_bible_available']['value'] === 'available' ) : ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/Check-GreenCircle.png" alt="<?php echo __('Done', 'doxa-website'); ?>">
                                <?php else : ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/RedX-Circle.png" alt="<?php echo __('Not Done', 'doxa-website'); ?>">
                                <?php endif; ?>
                                <strong><?php echo __('Bible Translation', 'doxa-website'); ?>:</strong> <?php echo esc_html( $uupg['imb_bible_available']['label'] ); ?>
                            </p>
                            <p class="progress-item">
                                <?php if ( $uupg['imb_bible_stories_available']['value'] === 'available' ) : ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/Check-GreenCircle.png" alt="<?php echo __('Done', 'doxa-website'); ?>">
                                <?php else : ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/RedX-Circle.png" alt="<?php echo __('Not Done', 'doxa-website'); ?>">
                                <?php endif; ?>
                                <strong><?php echo __('Bible Stories', 'doxa-website'); ?>:</strong> <?php echo esc_html( $uupg['imb_bible_stories_available']['label'] ); ?>
                            </p>
                            <p class="progress-item">
                                <?php if ( $uupg['imb_jesus_film_available']['value'] === 'available' ) : ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/Check-GreenCircle.png" alt="<?php echo __('Done', 'doxa-website'); ?>">
                                <?php else : ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/RedX-Circle.png" alt="<?php echo __('Not Done', 'doxa-website'); ?>">
                                <?php endif; ?>
                                <strong><?php echo __('Jesus Film', 'doxa-website'); ?>:</strong> <?php echo esc_html( $uupg['imb_jesus_film_available']['label'] ); ?>
                            </p>
                            <p class="progress-item">
                                <?php if ( $uupg['imb_radio_broadcast_available']['value'] === 'available' ) : ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/Check-GreenCircle.png" alt="<?php echo __('Done', 'doxa-website'); ?>">
                                <?php else : ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/RedX-Circle.png" alt="<?php echo __('Not Done', 'doxa-website'); ?>">
                                <?php endif; ?>
                                <strong><?php echo __('Radio Broadcasts', 'doxa-website'); ?>:</strong> <?php echo esc_html( $uupg['imb_radio_broadcast_available']['label'] ); ?>
                            </p>
                            <p class="progress-item">
                                <?php if ( $uupg['imb_gospel_recordings_available']['value'] === 'available' ) : ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/Check-GreenCircle.png" alt="<?php echo __('Done', 'doxa-website'); ?>">
                                <?php else : ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/RedX-Circle.png" alt="<?php echo __('Not Done', 'doxa-website'); ?>">
                                <?php endif; ?>
                                <strong><?php echo __('Gospel Recordings', 'doxa-website'); ?>:</strong> <?php echo esc_html( $uupg['imb_gospel_recordings_available']['label'] ); ?>
                            </p>
                            <p class="progress-item">
                                <?php if ( $uupg['imb_audio_scripture_available']['value'] === 'available' ) : ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/Check-GreenCircle.png" alt="<?php echo __('Done', 'doxa-website'); ?>">
                                <?php else : ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/RedX-Circle.png" alt="<?php echo __('Not Done', 'doxa-website'); ?>">
                                <?php endif; ?>
                                <strong><?php echo __('Audio Scripture', 'doxa-website'); ?>:</strong> <?php echo esc_html( $uupg['imb_audio_scripture_available']['label'] ); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <?php get_footer(); ?>

</div>

<?php get_footer( 'bottom' ); ?>

