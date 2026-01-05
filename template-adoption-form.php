<?php

$slug = get_query_var( 'uupg_slug' );

$uupg = get_uupg_by_slug( $slug );

get_header( 'top' ); ?>

<div class="page">

    <?php get_header(); ?>

    <main class="site-main">
        <div class="container page-content uupg-detail-page">
            <div class="stack stack--lg">
                <button class="button back-button compact" onclick="window.history.back();"><?php echo __('< Back', 'doxa-website'); ?></button>
                <h1 class="highlight" data-highlight-index="1"><?php echo __('Adoption Form', 'doxa-website'); ?></h1>
                <p class="subtext"><?php echo __('Thank you for taking a step toward adopting an unengaged people group. Please complete the form below so we can confirm your church\'s adoption, connect with your Prayer Champion, and beign sending prayer updates and resources', 'doxa-website'); ?></p>
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
                        <div class="form-control color-primary-darker font-weight-medium">
                            <label for="confirm-uupg"><?php echo __('Confirm People Group', 'doxa-website'); ?></label>
                            <input type="checkbox" id="confirm-uupg" name="confirm-uupg">
                        </div>
                    </div>
                </div>
                <div class="text-card stack stack--lg">
                    <div class="stack">
                        <h3 class="h5"><?php echo __('Partnering Church', 'doxa-website'); ?></h3>
                        <div class="">
                            <label for="church-name"><?php echo __('Church Name', 'doxa-website'); ?></label>
                            <input type="text" id="church-name" name="church-name" required placeholder="<?php echo __('Enter Church Name', 'doxa-website'); ?>">
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
                    <div class="stack">
                        <h3 class="h5"><?php echo __('Pastoral Approval', 'doxa-website'); ?></h3>
                        <i class="color-primary font-size-sm"><?php echo __('We will send a confirmation email to this pastor to verify the adoption', 'doxa-website'); ?></i>
                        <div class="">
                            <label for="endorsement-email"><?php echo __('Pastor Endorsement Email', 'doxa-website'); ?></label>
                            <input type="email" id="endorsement-email" name="endorsement-email" required placeholder="<?php echo __('Email of the pastor or church leader confirming this adoption and the Prayer Champion', 'doxa-website'); ?>">
                        </div>
                    </div>
                </div>
                <div class="ms-auto form-control color-primary-darker font-weight-medium">
                    <label for="confirm-adoption"><?php echo __('Our church commits to adopting this People Group for prayer, partnership and support.', 'doxa-website'); ?></label>
                    <input type="checkbox" id="confirm-adoption" name="confirm-adoption">
                </div>
                <button class="button ms-auto" href="<?php echo home_url('#'); ?>"><?php echo __('Submit Adoption', 'doxa-website'); ?></button>
            </div>
        </div>
    </main>

    <?php get_footer(); ?>

</div>

<?php get_footer( 'bottom' ); ?>