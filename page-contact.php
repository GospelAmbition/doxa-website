<?php
/**
 * Template Name: Contact Page
 *
 * A contact page template
 */


if ( isset( $_POST['action'] ) && $_POST['action'] === 'contact_us' ) {
    $name = isset( $_POST['name'] ) ? sanitize_text_field( $_POST['name'] ) : '';
    $email = isset( $_POST['email'] ) ? sanitize_email( $_POST['email'] ) : '';
    $message = isset( $_POST['message'] ) ? sanitize_textarea_field( $_POST['message'] ) : '';
    $grecaptcha = isset( $_POST['g-recaptcha-response'] ) ? sanitize_text_field( $_POST['g-recaptcha-response'] ) : '';
}

get_header( 'top' ); ?>

<div class="page">

    <?php get_header(); ?>

    <main class="site-main">
        <div class="container page-content">

            <h1 class="page-title"><?php echo esc_html__('Contact Us', 'doxa-website'); ?></h1>

            <form action="" method="POST" class="stack stack--md" id="contact-form">
                <input type="hidden" name="action" value="contact_us">
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
                <button
                    type="submit"
                    class="button g-recaptcha"
                    data-action='submit'
                    data-callback='onSubmit'
                    data-sitekey="<?php echo esc_attr( get_option('doxa_recaptcha_site_key') ); ?>"
                >
                    <?php echo esc_html__('Submit', 'doxa-website'); ?>
                </button>
            </form>

        </div>
    </main>

    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
        function onSubmit(token) {
            const formElement = document.getElementById("contact-form")

            if ( formElement.checkValidity() ) {
                formElement.submit();
            } else {
                formElement.reportValidity();
            }
        }
    </script>

    <?php get_footer(); ?>

</div>

<?php get_footer( 'bottom' ); ?>
