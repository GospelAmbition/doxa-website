<?php
/**
 * Adoption Form REST API Endpoint
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Adoption Form REST API Endpoint
 */
function doxa_register_adopt_rest_route() {
    register_rest_route( 'doxa/v1', '/adopt', array(
        'methods'             => 'POST',
        'callback'            => 'doxa_handle_adopt_form',
        'permission_callback' => '__return_true',
    ) );
}
add_action( 'rest_api_init', 'doxa_register_adopt_rest_route' );

/**
 * Handle Adoption Form Submission
 */
function doxa_handle_adopt_form( WP_REST_Request $request ) {
    $params = $request->get_params();

    // Verify Cloudflare Turnstile token
    $cf_token = $params['cf_turnstile'] ?? '';
    if ( empty( $cf_token ) ) {
        return new WP_Error( 'cf_token', 'Invalid token', [ 'status' => 400 ] );
    }

    $secret_key = get_option( 'dt_webform_cf_secret_key', '' );
    if ( empty( $secret_key ) ) {
        return new WP_Error( 'cf_token', 'Invalid token', [ 'status' => 400 ] );
    }

    $response = wp_remote_post( 'https://challenges.cloudflare.com/turnstile/v0/siteverify', [
        'body' => [
            'secret'   => $secret_key,
            'response' => $cf_token,
            'remoteip' => $_SERVER['REMOTE_ADDR'] ?? '',
        ],
    ] );

    if ( is_wp_error( $response ) ) {
        return new WP_Error( 'cf_token', 'Invalid token', [ 'status' => 400 ] );
    }

    $response_body = json_decode( wp_remote_retrieve_body( $response ), true );
    if ( empty( $response_body['success'] ) ) {
        return new WP_Error( 'cf_token', 'Invalid token', [ 'status' => 400 ] );
    }

    // Sanitize inputs
    $first_name       = sanitize_text_field( $params['first_name'] ?? '' );
    $last_name        = sanitize_text_field( $params['last_name'] ?? '' );
    $email            = sanitize_email( $params['email'] ?? '' );
    $phone            = sanitize_text_field( $params['phone'] ?? '' );
    $church_name      = sanitize_text_field( $params['church_name'] ?? '' );
    $wagf_block       = sanitize_text_field( $params['wagf_block'] ?? '' );
    $role             = sanitize_text_field( $params['role'] ?? '' );
    $confirm_adoption = ! empty( $params['confirm_adoption'] );
    $people_group     = sanitize_text_field( $params['people_group'] ?? '' );

    // Validate required fields
    if ( empty( $email ) || empty( $first_name ) || empty( $last_name ) ) {
        return new WP_Error( 'missing_fields', 'Name and email are required', [ 'status' => 400 ] );
    }

    if ( ! $confirm_adoption ) {
        return new WP_Error( 'missing_confirmation', 'Please confirm your adoption commitment', [ 'status' => 400 ] );
    }

    // Load Site_Link_System if not already loaded
    if ( ! class_exists( 'Site_Link_System' ) ) {
        $site_link_path = WP_PLUGIN_DIR . '/disciple-tools-webform/includes/site-link-post-type.php';
        if ( file_exists( $site_link_path ) ) {
            require_once $site_link_path;
            Site_Link_System::instance();
        } else {
            return new WP_Error( 'no_site_link', 'Site Link System not available', [ 'status' => 500 ] );
        }
    }

    $keys = Site_Link_System::get_site_keys();
    $crm_link = '';
    foreach ( $keys ?? [] as $key ) {
        if ( $key['dev_key'] === 'crm_link' ) {
            $crm_link = $key;
        }
    }

    if ( empty( $crm_link ) ) {
        return new WP_Error( 'no_crm_link', 'CRM not configured', [ 'status' => 400 ] );
    }

    $var = Site_Link_System::get_site_connection_vars( $crm_link['post_id'] );

    // Build note with adoption form details
    $note = "Adoption Form Submission\n\n";
    $note .= "People Group: " . $people_group . "\n";
    $note .= "Church Name: " . $church_name . "\n";
    $note .= "WAGF Block: " . $wagf_block . "\n";
    $note .= "Role: " . $role . "\n";
    $note .= "Champion Commitment Confirmed: Yes";

    $full_name = trim( $first_name . ' ' . $last_name );

    // Send to CRM
    $crm_response = wp_remote_post( 'https://' . $var['url'] . '/wp-json/dt-posts/v2/contacts?check_for_duplicates=contact_email', [
        'body'    => wp_json_encode( [
            'title'         => $full_name ?: $email,
            'contact_email' => [ [ 'value' => $email ] ],
            'contact_phone' => [ [ 'value' => $phone ] ],
            'sources'       => [ 'values' => [ [ 'value' => 'doxa_adoption_form' ] ] ],
            'notes'         => [ $note ],
            'tags'          => [ 'values' => [ [ 'value' => 'adoption_form' ] ] ],
        ] ),
        'headers' => [
            'Authorization' => 'Bearer ' . $var['transfer_token'],
            'Content-Type'  => 'application/json',
        ],
    ] );

    if ( is_wp_error( $crm_response ) ) {
        return new WP_Error( 'crm_error', 'Failed to submit adoption. Please try again.', [ 'status' => 500 ] );
    }

    $response_code = wp_remote_retrieve_response_code( $crm_response );
    if ( $response_code !== 200 ) {
        return new WP_Error( 'crm_error', 'Failed to submit adoption. Please try again.', [ 'status' => 500 ] );
    }

    return new WP_REST_Response( 'success', 200 );
}
