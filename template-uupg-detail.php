<?php
/**
 * Template Name: UUPG Detail
 *
 * Custom template for the UUPG detail page - completely independent of posts/archive templates
 */

$post_id = get_query_var('uupg_slug');

$uupg = get_uupg_by_post_id($post_id);

get_header( 'top' ); ?>

<div class="page">

    <?php get_header(); ?>

    <main class="site-main">
        <div class="container page-content uupg-detail-page">
            <!-- Custom content for UUPGS page goes here -->
            <h1 class="text-center"><?php echo __('Find a UUPG to adopt', 'doxa-website'); ?></h1>
            <div class="stack stack--lg">
                <a class="button back-button compact" href="<?php echo home_url('/discover'); ?>"><?php echo __('< Back', 'doxa-website'); ?></a>
                <div class="surface">
                    <div class="stack stack--2xl">
                        <div class="uupg__card">
                            <img class="uupg__image" data-size="medium" src="<?php echo esc_attr( $uupg['imb_picture_url'] ); ?>" alt="<?php echo esc_attr( $uupg['imb_display_name'] ); ?>">
                            <div class="stack stack--sm | uupg__header">
                                <h3><?php echo esc_html( $uupg['imb_display_name'] ); ?></h3>
                                <h4><?php echo esc_html( $uupg['imb_isoalpha3']['label'] ); ?> (<?php echo esc_html( $uupg['imb_reg_of_people_1']['label'] ); ?>)</h4>
                                <p>
                                    Aliquam erat volutpat. Nullam scelerisque auctor libero, id volutpat est dignissim vitae. Aliquam erat volutpat. Integer laoreet, nisi a tincidunt tincidunt, odio nisl commodo libero, id ultricies sapien purus non odio. Phasellus ac ultricies ex, vel scelerisque libero.
                                </p>
                            </div>
                            <div class="uupg_adopted"></div>
                            <p class="uupg__content"><?php echo __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'doxa-website'); ?></p>
                        </div>
                        <div class="grid" data-width-lg>
                            <div class="stack stack--3xl | card | text-center lh-0" data-variant="secondary">
                                <h2><?php echo __('Prayer Status', 'doxa-website'); ?></h2>
                                <p class="font-size-4xl font-weight-bold"><?php echo __('98 / 144', 'doxa-website'); ?></p>
                                <p class="font-size-lg font-weight-bold"><?php echo __('People praying 10 minutes a day for this people group', 'doxa-website'); ?></p>
                                <div class="progress-bar">
                                    <div class="progress-bar__slider" style="width: <?php echo esc_attr( 98 / 144 * 100 ); ?>%"></div>
                                </div>
                            </div>
                            <div class="stack stack--3xl | card | text-center lh-0" data-variant="primary">
                                <h2><?php echo __('Adoption Status', 'doxa-website'); ?></h2>
                                <p class="font-size-4xl font-weight-bold"><?php echo __('2', 'doxa-website'); ?></p>
                                <p class="font-size-lg font-weight-bold"><?php echo __('Churches have adopted this people group', 'doxa-website'); ?></p>
                            </div>
                            <div><a class="button fit-content mx-auto" href="<?php echo home_url('#'); ?>"><?php echo __('Sign up to pray', 'doxa-website'); ?></a></div>
                            <div><a class="button fit-content mx-auto" href="<?php echo home_url('#'); ?>"><?php echo __('Adopt people group', 'doxa-website'); ?></a></div>
                            <div class="card" data-variant="primary">
                                <h2><?php echo __('Overview', 'doxa-website'); ?></h2>
                                <div class="stack stack--2xs">
                                    <p><strong><?php echo __('Country', 'doxa-website'); ?>:</strong> <?php echo esc_html( $uupg['imb_isoalpha3']['label'] ); ?></p>
                                    <p><strong><?php echo __('Area', 'doxa-website'); ?>:</strong> <?php echo esc_html( $uupg['imb_reg_of_people_1']['label'] ); ?></p>
                                    <p><strong><?php echo __('People Group Name', 'doxa-website'); ?>:</strong> <?php echo esc_html( $uupg['imb_display_name'] ); ?></p>
                                    <p><strong><?php echo __('Population', 'doxa-website'); ?>:</strong> ~<?php echo esc_html( $uupg['imb_population'] ); ?></p>
                                    <p><?php echo esc_html( $uupg['imb_population_class']['label'] ); ?></p>
                                    <p><strong><?php echo __('Community', 'doxa-website'); ?>:</strong> <?php echo esc_html( $uupg['imb_location_description'] ); ?></p>
                                </div>
                            </div>
                            <div class="card">
                                <h2><?php echo __('Map', 'doxa-website'); ?></h2>
                                <p>Vivamus lacinia lacus vel neque egestas, vitae volutpat purus dapibus. Nullam nec ultricies erat. Etiam ac urna metus. Sed cursus libero id ullamcorper interdum. Donec non urna et erat vehicula porttitor. Vivamus a sagittis dolor. Nulla facilisi. Cras euismod orci at felis cursus, vel vulputate sapien suscipit.</p>
                            </div>
                            <div class="card" data-variant="primary">
                                <h2><?php echo __('Spiritual Status', 'doxa-website'); ?></h2>
                                <div class="stack stack--2xs">
                                    <p><strong><?php echo __('Evangelical Level', 'doxa-website'); ?>:</strong> <?php echo esc_html( $uupg['imb_evangelical_level']['label'] ); ?></p>
                                    <p><strong><?php echo __('Churches Exist', 'doxa-website'); ?>:</strong> <?php echo esc_html( $uupg['imb_congregation_existing']['label'] ); ?></p>
                                    <p><strong><?php echo __('Church Planting Status', 'doxa-website'); ?>:</strong> <?php echo esc_html( $uupg['imb_church_planting']['label'] ); ?></p>
                                    <p><strong><?php echo __('Engagement Status', 'doxa-website'); ?>:</strong> <?php echo esc_html( $uupg['imb_strategic_priority_index']['label'] ); ?></p>
                                    <p><strong><?php echo __('GSEC', 'doxa-website'); ?>:</strong> <?php echo esc_html( $uupg['imb_gsec']['label'] ); ?></p>
                                </div>
                            </div>
                            <div class="card" data-variant="secondary-lighter">
                                <h2><?php echo __('Religion', 'doxa-website'); ?></h2>
                                <div class="stack stack--2xs">
                                    <p><strong><?php echo __('Primary Religion', 'doxa-website'); ?>:</strong> <?php echo esc_html( $uupg['imb_reg_of_religion']['label'] ); ?></p>
                                    <p><strong><?php echo __('Religious Practices', 'doxa-website'); ?>:</strong> Phasellus ac eros at urna condimentum lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed bibendum, sapien a venenatis fermentum, mauris augue cursus turpis, vitae elementum massa orci sit amet massa. In hac habitasse platea dictumst.</p>
                                </div>
                            </div>
                            <div class="card" data-variant="secondary-light">
                                <h2><?php echo __('Language', 'doxa-website'); ?></h2>
                                <div class="stack stack--2xs">
                                    <p><strong><?php echo __('Primary Language', 'doxa-website'); ?>:</strong> <?php echo esc_html( $uupg['imb_reg_of_language']['label'] ); ?></p>
                                    <p><strong><?php echo __('Language Family', 'doxa-website'); ?>:</strong> <?php echo esc_html( $uupg['imb_language_family']['label'] ); ?></p>
                                </div>
                            </div>
                        </div> <!-- End of grid -->
                        <div class="stack stack--lg | card" data-variant="primary">
                            <h2><?php echo __('Resources', 'doxa-website'); ?></h2>
                            <div class="switcher">
                                <div class="stack stack--2xs">
                                    <p><strong><?php echo __('Bible Translation', 'doxa-website'); ?>:</strong> <?php echo esc_html( $uupg['imb_bible_available']['label'] ); ?></p>
                                    <p><strong><?php echo __('Jesus Film', 'doxa-website'); ?>:</strong> <?php echo esc_html( $uupg['imb_jesus_film_available']['label'] ); ?></p>
                                    <p><strong><?php echo __('Radio Broadcasts', 'doxa-website'); ?>:</strong> <?php echo esc_html( $uupg['imb_radio_broadcast_available']['label'] ); ?></p>
                                </div>
                                <div class="stack stack--2xs">
                                    <p><strong><?php echo __('Gospel Recordings', 'doxa-website'); ?>:</strong> <?php echo esc_html( $uupg['imb_gospel_recordings_available']['label'] ); ?></p>
                                    <p><strong><?php echo __('Audio Scripture', 'doxa-website'); ?>:</strong> <?php echo esc_html( $uupg['imb_audio_scripture_available']['label'] ); ?></p>
                                    <p><strong><?php echo __('Bible Stories', 'doxa-website'); ?>:</strong> <?php echo esc_html( $uupg['imb_bible_stories_available']['label'] ); ?></p>
                                    <p class="font-size-xl ms-auto"><strong><?php echo __('Total Resources', 'doxa-website'); ?>: <?php echo esc_html( $uupg['imb_total_resources_available'] ); ?></strong></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <?php get_footer(); ?>

</div>

<?php get_footer( 'bottom' ); ?>

