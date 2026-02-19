<?php

$slug = get_query_var( 'uupg_slug' );
$uupg = get_uupg_by_slug( $slug );
$cf_site_key = get_option( 'dt_webform_cf_site_key', '' );

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
<?php else : ?>

<?php get_header( 'top' ); ?>

<div class="page">

    <?php get_header(); ?>

    <main class="site-main">
        <div class="container page-content uupg-detail-page">
            <div class="stack stack--lg">
                <h1 class="highlight" data-highlight-index="1"><?php echo __('Adoption Form', 'doxa-website'); ?></h1>
                <p class="subtext"><?php echo __('Thank you for taking a step toward adopting an unengaged people group. Please complete the form below so we can confirm your church\'s adoption, connect with your Champion, and begin sending prayer updates and resources.', 'doxa-website'); ?></p>
                <div class="switcher | adoption-card shadow">
                    <div class="grow-none">
                        <img
                            class="uupg__image"
                            data-size="small"
                            src="<?php echo esc_attr( $uupg['image_url'] ); ?>"
                            alt="<?php echo isset( $uupg['imb_display_name'] ) ? esc_attr( $uupg['imb_display_name'] ) : esc_attr( $uupg['imb_people_name'] ); ?>"
                        >
                    </div>
                    <div class="repel align-center">
                        <div class="stack stack--md lh-0">
                            <p class="font-size-xl font-weight-medium"><?php echo esc_html( $uupg['imb_display_name'] ); ?></p>
                            <p class="font-size-lg font-weight-medium"><?php echo esc_html( $uupg['imb_isoalpha3']['label'] ); ?> (<?php echo esc_html( $uupg['imb_reg_of_people_1']['label'] ); ?>)</p>
                        </div>
                    </div>
                </div>
                <form id="adoption-form" class="text-card shadow">
                    <input type="email" name="email" style="display:none;" autocomplete="off" tabindex="-1">
                    <input type="hidden" name="people_group" value="<?php echo esc_attr( $uupg['imb_display_name'] . ' (' . $uupg['imb_isoalpha3']['label'] . ')' ); ?>">
                    <div class="stack stack--lg | max-width-lg mx-auto">
                        <section class="stack">
                            <h3 class="highlight" data-highlight-index="4"><?php echo __('What is your commitment? Pray. Give. Send.', 'doxa-website'); ?></h3>
                            <p><?php echo esc_html__( 'When you adopt a people group, you step into a leadership role on their behalf—standing in the gap until the gospel takes root. This involves a commitment to:', 'doxa-website' ); ?></p>
                            <ul class="stack" data-list-color="primary">
                                <li>
                                    <strong><?php echo __('Pray', 'doxa-website'); ?> – </strong>
                                    <?php echo __('Mobilize toward the goal of at least 144 prayer partners to cover the people group in continuous, daily prayer (10 minutes each, 24 hours a day).', 'doxa-website'); ?>
                                </li>
                                <li>
                                    <strong><?php echo __('Give', 'doxa-website'); ?> – </strong>
                                    <?php echo __('Partner financially on a monthly basis with the Doxa Foundation to help sustain prayer mobilization, campaign operations, and the sending of gospel workers.', 'doxa-website'); ?>
                                </li>
                                <li>
                                    <strong><?php echo __('Send', 'doxa-website'); ?> – </strong>
                                    <?php echo __('Actively help surface and support potential goers, encouraging those God may be calling to cross cultures and serve this people group directly.', 'doxa-website'); ?>
                                </li>
                            </ul>
                        </section>
                        <div class="stack">
                            <h3 class="h5"><?php echo __('Champion Details', 'doxa-website'); ?></h3>
                            <i class="color-primary font-size-sm"><?php echo __('The Champion is the person who will organize the 144 intercessors and receive updates.', 'doxa-website'); ?></i>
                            <div class="">
                                <label for="first-name"><?php echo __('First Name', 'doxa-website'); ?></label>
                                <input type="text" id="first-name" name="first_name" required placeholder="<?php echo __('First Name', 'doxa-website'); ?>">
                            </div>
                            <div class="">
                                <label for="last-name"><?php echo __('Last Name', 'doxa-website'); ?></label>
                                <input type="text" id="last-name" name="last_name" required placeholder="<?php echo __('Last Name', 'doxa-website'); ?>">
                            </div>
                            <div class="">
                                <label for="contact-email"><?php echo __('Email', 'doxa-website'); ?></label>
                                <input type="email" id="contact-email" name="contact_email" required placeholder="<?php echo __('Enter your Email', 'doxa-website'); ?>">
                            </div>
                            <div class="">
                                <label for="phone"><?php echo __('Phone', 'doxa-website'); ?></label>
                                <input type="tel" id="phone" name="phone" required placeholder="<?php echo __('Enter your Phone', 'doxa-website'); ?>">
                            </div>
                            <div class="">
                                <label for="role"><?php echo __('Role', 'doxa-website'); ?></label>
                                <input type="text" id="role" name="role" required placeholder="<?php echo __('Example: Pastor, Missions Pastor, Elder, Volunteer Leader etc.', 'doxa-website'); ?>">
                            </div>
                        </div>
                        <div class="stack">
                            <h3 class="h5"><?php echo __('Partnering Church', 'doxa-website'); ?></h3>
                            <div class="">
                                <label for="church-name"><?php echo __('Church/Group Name', 'doxa-website'); ?></label>
                                <input type="text" id="church-name" name="church_name" required placeholder="<?php echo __('Enter Church/Group Name', 'doxa-website'); ?>">
                            </div>
                            <div class="ms-auto form-control color-primary-darker font-weight-medium">
                                <label for="confirm-public-display"><?php echo __('I am happy for this church name to appear publicly on this site.', 'doxa-website'); ?></label>
                                <input type="checkbox" id="confirm-public-display" name="confirm_public_display">
                            </div>
                            <div>
                                <label for="country"><?php echo __('Location of Church/Group', 'doxa-website'); ?></label>
                                <select id="country" name="country" required>
                                    <option value="" disabled selected hidden><?php echo __('Select Country', 'doxa-website'); ?></option>
                                    <?php foreach (doxa_get_countries() as $country) : ?>
                                        <option value="<?php echo esc_attr( $country['label'] ); ?>"><?php echo esc_html( $country['label'] ); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="ms-auto form-control color-primary-darker font-weight-medium">
                            <label for="confirm-adoption"><?php echo __('I/my church/group commits to adopting this People Group for prayer, partnership and support.', 'doxa-website'); ?></label>
                            <input type="checkbox" id="confirm-adoption" name="confirm_adoption">
                        </div>
                        <div class="ms-auto form-control color-primary-darker font-weight-medium">
                            <label for="permission-to-contact"><?php echo __('I give permission for DOXA to connect me with others adopting this people group.', 'doxa-website'); ?></label>
                            <input type="checkbox" id="permission-to-contact" name="permission_to_contact">
                        </div>
                        <div class="cf-turnstile" data-sitekey="<?php echo esc_attr( $cf_site_key ); ?>" data-theme="light" data-callback="onTurnstileSuccess"></div>
                        <div id="adoption-message" class="contact-message" style="display: none;"></div>
                        <button type="submit" class="button compact" id="adoption-submit" disabled><?php echo __('Submit', 'doxa-website'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" defer></script>
    <script>
        let turnstileToken = '';

        function onTurnstileSuccess(token) {
            turnstileToken = token;
            document.getElementById('adoption-submit').disabled = false;
        }

        document.getElementById('adoption-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = e.target;
            const submitBtn = document.getElementById('adoption-submit');
            const messageDiv = document.getElementById('adoption-message');

            // Check honeypot
            const honeypot = form.querySelector('input[name="email"]');
            if (honeypot && honeypot.value) {
                return;
            }

            // Validate form
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            // Check confirmation checkbox
            if (!form.querySelector('#confirm-adoption').checked) {
                messageDiv.className = 'contact-message error';
                messageDiv.textContent = '<?php echo esc_js(__('Please confirm your adoption commitment.', 'doxa-website')); ?>';
                messageDiv.style.display = 'block';
                return;
            }

            // Disable button and show loading
            submitBtn.disabled = true;
            submitBtn.textContent = '<?php echo esc_js(__('Submitting...', 'doxa-website')); ?>';

            const formData = {
                first_name: form.querySelector('#first-name').value,
                last_name: form.querySelector('#last-name').value,
                email: form.querySelector('#contact-email').value,
                phone: form.querySelector('#phone').value,
                church_name: form.querySelector('#church-name').value,
                country: form.querySelector('#country').value,
                role: form.querySelector('#role').value,
                confirm_adoption: form.querySelector('#confirm-adoption').checked,
                people_group: form.querySelector('input[name="people_group"]').value,
                cf_turnstile: turnstileToken
            };

            fetch('<?php echo esc_url( rest_url( 'doxa/v1/adopt' ) ); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-WP-Nonce': '<?php echo wp_create_nonce( 'wp_rest' ); ?>'
                },
                body: JSON.stringify(formData)
            })
            .then(response => {
                return response.json().then(data => ({ ok: response.ok, data }));
            })
            .then(({ ok, data }) => {
                if (ok && data === 'success') {
                    messageDiv.className = 'contact-message success';
                    messageDiv.textContent = '<?php echo esc_js(__('Thank you for your adoption commitment! We will be in touch soon.', 'doxa-website')); ?>';
                    messageDiv.style.display = 'block';
                    form.reset();
                    turnstile.reset();
                    turnstileToken = '';
                    submitBtn.disabled = true;
                } else {
                    messageDiv.className = 'contact-message error';
                    messageDiv.textContent = data.message || '<?php echo esc_js(__('There was an error submitting your adoption. Please try again.', 'doxa-website')); ?>';
                    messageDiv.style.display = 'block';
                    turnstile.reset();
                    turnstileToken = '';
                }
                submitBtn.textContent = '<?php echo esc_js(__('Submit', 'doxa-website')); ?>';
            })
            .catch(error => {
                messageDiv.className = 'contact-message error';
                messageDiv.textContent = '<?php echo esc_js(__('There was an error submitting your adoption. Please try again.', 'doxa-website')); ?>';
                messageDiv.style.display = 'block';
                turnstile.reset();
                turnstileToken = '';
                submitBtn.textContent = '<?php echo esc_js(__('Submit', 'doxa-website')); ?>';
            });
        });
    </script>

    <?php get_footer(); ?>

</div>

<?php get_footer( 'bottom' ); ?>

<?php endif; ?>
