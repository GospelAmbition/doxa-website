<?php

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
                    <a class="button font-size-lg" href="<?php echo home_url('/adopt'); ?>">
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


<div class="page">

    <?php get_header(); print_r($uupg); ?>

    <main class="site-main">
        <div class="container page-content uupg-detail-page">
            <div class="stack stack--lg">
                <button class="button back-button compact" onclick="window.history.back();"><?php echo __('< Back', 'doxa-website'); ?></button>
                <h1 class="highlight" data-highlight-index="1"><?php echo __('Adoption Form', 'doxa-website'); ?></h1>
                <p class="subtext"><?php echo __('Thank you for taking a step toward adopting an unengaged people group. Please complete the form below so we can confirm your church\'s adoption, connect with your Prayer Champion, and begin sending prayer updates and resources', 'doxa-website'); ?></p>
                <div class="switcher | adoption-card shadow">
                    <div class="grow-none">
                        <img
                            class="uupg__image"
                            data-size="small"
                            src="<?php echo esc_attr( $uupg['imb_picture_url'] ); ?>"
                            alt="<?php echo esc_attr( $uupg['imb_display_name'] ); ?>"
                        >
                    </div>
                    <div class="repel align-center">
                        <div class="stack stack--md lh-0">
                            <p class="font-size-xl font-weight-medium"><?php echo esc_html( $uupg['imb_display_name'] ); ?></p>
                            <p class="font-size-lg font-weight-medium"><?php echo esc_html( $uupg['imb_isoalpha3']['label'] ); ?> (<?php echo esc_html( $uupg['imb_reg_of_people_1']['label'] ); ?>)</p>
                        </div>
                    </div>
                </div>
                <div class="stack stack--lg | text-card shadow">
                    <div class="stack">
                        <h3 class="h5"><?php echo __('Partnering Church', 'doxa-website'); ?></h3>
                        <div class="">
                            <label for="church-name"><?php echo __('Church Name', 'doxa-website'); ?></label>
                            <input type="text" id="church-name" name="church-name" required placeholder="<?php echo __('Enter Church Name', 'doxa-website'); ?>">
                        </div>
                        <div>
                            <label for="wagf-block"><?php echo __('WAGF Block', 'doxa-website'); ?></label>
                            <select id="wagf-block" name="wagf-block" required>
                                <option value="" disabled selected hidden><?php echo __('Select WAGF Block', 'doxa-website'); ?></option>
                                <?php foreach (doxa_get_wagf_blocks() as $block) : ?>
                                    <option value="<?php echo esc_attr( $block['value'] ); ?>"><?php echo esc_html( $block['label'] ); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="stack">
                        <h3 class="h5"><?php echo __('Prayer Champion Details', 'doxa-website'); ?></h3>
                        <i class="color-primary font-size-sm"><?php echo __('The Prayer Champion is the person who will organize the 144 intercessors and receive updates.', 'doxa-website'); ?></i>
                        <div class="">
                            <label for="first-name"><?php echo __('First Name', 'doxa-website'); ?></label>
                            <input type="text" id="first-name" name="first-name" required placeholder="<?php echo __('First Name', 'doxa-website'); ?>">
                        </div>
                        <div class="">
                            <label for="last-name"><?php echo __('Last Name', 'doxa-website'); ?></label>
                            <input type="text" id="last-name" name="last-name" required placeholder="<?php echo __('Last Name', 'doxa-website'); ?>">
                        </div>
                        <div class="">
                            <label for="email"><?php echo __('Email', 'doxa-website'); ?></label>
                            <input type="email" id="email" name="email" required placeholder="<?php echo __('Enter Email', 'doxa-website'); ?>">
                        </div>
                        <div class="">
                            <label for="phone"><?php echo __('Phone', 'doxa-website'); ?></label>
                            <input type="tel" id="phone" name="phone" required placeholder="<?php echo __('Enter Phone', 'doxa-website'); ?>">
                        </div>
                        <div class="">
                            <label for="role"><?php echo __('Role', 'doxa-website'); ?></label>
                            <input type="text" id="role" name="role" required placeholder="<?php echo __('Emample: Missions Pastor, Elder, Volunteer Leader etc.', 'doxa-website'); ?>">
                        </div>
                    </div>
                    <section class="stack">
                        <h3><?php echo __('Champion Commitments: Pray. Give. Go.', 'doxa-website'); ?></h3>
                        <p><?php echo esc_html__( 'When you adopt a people group, you step into a leadership role on their behalf—standing in the gap until the gospel takes root. This involves a commitment to:', 'doxa-website' ); ?></p>
                        <div class="ms-auto form-control color-primary-darker font-weight-medium">
                            <label for="confirm-pray">
                                <strong><?php echo __('Pray', 'doxa-website'); ?> – </strong>
                                <?php echo __('Mobilize toward the goal of at least 144 prayer partners to cover the people group in continuous, daily prayer (10 minutes each, 24 hours a day).', 'doxa-website'); ?>
                            </label>
                            <input type="checkbox" id="confirm-pray" name="confirm-pray">
                        </div>
                        <div class="ms-auto form-control color-primary-darker font-weight-medium">
                            <label for="confirm-give">
                                <strong><?php echo __('Give', 'doxa-website'); ?> – </strong>
                                <?php echo __('Partner financially on a monthly basis with the Doxa Foundation to help sustain prayer mobilization, campaign operations, and the sending of gospel workers.', 'doxa-website'); ?>
                            </label>
                            <input type="checkbox" id="confirm-give" name="confirm-give">
                        </div>
                        <div class="ms-auto form-control color-primary-darker font-weight-medium">
                            <label for="confirm-go">
                                <strong><?php echo __('Go', 'doxa-website'); ?> – </strong>
                                <?php echo __('Actively help surface and support potential goers, encouraging those God may be calling to cross cultures and serve this people group directly.', 'doxa-website'); ?>
                            </label>
                            <input type="checkbox" id="confirm-go" name="confirm-go">
                        </div>
                        <div class="ms-auto form-control color-primary-darker font-weight-medium">
                            <label for="confirm-adoption"><?php echo __('Our church commits to adopting this People Group for prayer, partnership and support.', 'doxa-website'); ?></label>
                            <input type="checkbox" id="confirm-adoption" name="confirm-adoption">
                        </div>
                    </section>
                    <button class="button ms-auto compact" href="<?php echo home_url('#'); ?>"><?php echo __('Submit', 'doxa-website'); ?></button>
                </div>
            </div>
        </div>
    </main>

    <?php get_footer(); ?>

</div>

<?php get_footer( 'bottom' ); ?>