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
    $country          = sanitize_text_field( $params['country'] ?? '' );
    $role             = sanitize_text_field( $params['role'] ?? '' );
    $confirm_adoption = ! empty( $params['confirm_adoption'] );
    $permission_to_contact = ! empty( $params['permission_to_contact'] ) ? 'Yes' : 'No';
    $confirm_public_display = ! empty( $params['confirm_public_display'] ) ? 'Yes' : 'No';
    $people_group     = sanitize_text_field( $params['people_group'] ?? '' );
    $language         = sanitize_text_field( $params['language'] ?? 'en' );

    // Validate required fields
    if ( empty( $email ) || empty( $first_name ) || empty( $last_name ) ) {
        return new WP_Error( 'missing_fields', 'Name and email are required', [ 'status' => 400 ] );
    }

    if ( ! $confirm_adoption ) {
        return new WP_Error( 'missing_confirmation', 'Please confirm your adoption commitment', [ 'status' => 400 ] );
    }

    // Send to Prayer Tools app
    $api_url = defined( 'DOXA_PRAYER_TOOLS_URL' ) ? DOXA_PRAYER_TOOLS_URL : '';
    $api_key = defined( 'DOXA_FORM_API_KEY' ) ? DOXA_FORM_API_KEY : '';

    if ( empty( $api_url ) || empty( $api_key ) ) {
        return new WP_Error( 'config_error', 'Prayer Tools integration not configured', [ 'status' => 500 ] );
    }

    $response = wp_remote_post( rtrim( $api_url, '/' ) . '/api/adopt', [
        'body'    => wp_json_encode( [
            'first_name'             => $first_name,
            'last_name'              => $last_name,
            'email'                  => $email,
            'phone'                  => $phone,
            'role'                   => $role,
            'church_name'            => $church_name,
            'country'                => $country,
            'people_group'           => $people_group,
            'permission_to_contact'  => $permission_to_contact === 'Yes',
            'confirm_public_display' => $confirm_public_display === 'Yes',
            'language'               => $language,
        ] ),
        'headers' => [
            'X-API-Key'    => $api_key,
            'Content-Type' => 'application/json',
        ],
        'timeout' => 15,
    ] );

    if ( is_wp_error( $response ) ) {
        return new WP_Error( 'api_error', 'Failed to submit adoption. Please try again.', [ 'status' => 500 ] );
    }

    $response_code = wp_remote_retrieve_response_code( $response );
    if ( $response_code < 200 || $response_code >= 300 ) {
        $body = json_decode( wp_remote_retrieve_body( $response ), true );
        $message = $body['statusMessage'] ?? 'Failed to submit adoption. Please try again.';
        return new WP_Error( 'api_error', $message, [ 'status' => $response_code ] );
    }

    return new WP_REST_Response( 'success', 200 );
}
