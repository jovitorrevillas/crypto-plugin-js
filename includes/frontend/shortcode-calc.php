<?php

/**
 * Retrieve path to a compiled blade view
 * @param $file
 * @param array $data
 * @return string
 */


add_shortcode('ibx_calc', function( $atts ){
    // Set default values for the attributes: title and symbols
    wp_enqueue_style( 'ibinex-calculator-css', plugin_dir_url(__FILE__) . '/css/ibinex-calculator.css' );
    $shortcode_attributes = shortcode_atts( array(
        'id' => ''
    ), $atts );

    $postID = $shortcode_attributes['id'];
   	$values = get_post_custom( $postID );
   	$selectedStyle = implode('', $values['ibx_calc_theme']);
   	$cryptoSelected = implode(',', $values['crypto_symbols']);

    //Strip whitespaces from shortcode attributes
    $cryptoSelected = preg_replace('/\s+/', '', $cryptoSelected);
    return '<script type="text/javascript" data-ibx-calc-currencies="' . $cryptoSelected .'" style-selected="'. $selectedStyle .'" data-ibx-calc-coins="'. $cryptoSelected .'" src="'. IBINEX_CC_PLUGIN_CALL .'\includes\js\crypto-converter1.js"></script>';
});