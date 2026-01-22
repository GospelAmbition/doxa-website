<?php

function uupg_list_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'select_url' => 'https://pray.doxa.life',
        'select_text' => __('Select', 'doxa-website'),
        'per_page' => 6,
        'more_per_page' => 12,
        'dont_show_list_on_load' => false,
        'use_select_card' => false,
        'use_highlighted_uupgs' => false,
        'initial_search_term' => '',
    ), $atts );

    $translations = [
        'select' => $atts['select_text'],
        'full_profile' => __('Full Profile', 'doxa-website'),
        'prayer_coverage' => __('Prayer Coverage', 'doxa-website'),
        'loading' => __('Loading results...', 'doxa-website'),
        'load_more' => __('Load More', 'doxa-website'),
        'total' => __('Total', 'doxa-website'),
        'search' => __('Search names, country/continent, religions...', 'doxa-website'),
        'see_all' => __('See All', 'doxa-website'),
    ];

    $translations = json_encode( $translations );

    ob_start();
    ?>
    <uupgs-list
        selectUrl="<?php echo esc_attr( $atts['select_url'] ); ?>"
        perPage="<?php echo esc_attr( $atts['per_page'] ); ?>"
        morePerPage="<?php echo esc_attr( $atts['more_per_page'] ); ?>"
        dontShowListOnLoad="<?php echo esc_attr( $atts['dont_show_list_on_load'] ); ?>"
        useSelectCard="<?php echo esc_attr( $atts['use_select_card'] ); ?>"
        useHighlightedUUPGs="<?php echo esc_attr( $atts['use_highlighted_uupgs'] ); ?>"
        initialSearchTerm="<?php echo esc_attr( $atts['initial_search_term'] ); ?>"
        t="<?php echo esc_attr( $translations ); ?>"
    ></uupgs-list>
    <?php
    return ob_get_clean();
}
add_shortcode('uupg_list', 'uupg_list_shortcode');