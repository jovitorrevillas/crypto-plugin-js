<?php

add_shortcode('crypto_list', function($args){

    // Set default values for the attributes: title and symbols
    $shortcode_attributes = shortcode_atts( array(
        'id' => '',
        'style' => ''
    ), $args );

    $postID = $shortcode_attributes['id'];
    $values = get_post_custom( $postID );
    $cryptoSelected = implode(',', $values['crypto_symbols']);

    //Strip whitespaces from shortcode attributes
    $cryptoSelected = preg_replace('/\s+/', '', $cryptoSelected);
    return '<script type="text/javascript" currency-selected="' . $cryptoSelected .'" src="'. plugin_dir_url(__FILE__) .'js/crypto-list.js"></script>';
});
