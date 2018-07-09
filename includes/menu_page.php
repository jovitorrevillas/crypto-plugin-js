<?php

// Add Admin Menu Page
add_action( 'admin_menu', 'admin_menu', 9 );
function admin_menu() {

	register_post_type( 'crypto-display',
	    array(
	            'labels' => array(
	                    'name' => __( 'Cryptocurrency Display' ),
	                    'singular_name' => __( 'Display' )
	            ),
	    'public' => 1,
	    'has_archive' => 1,
	    'supports' => array('title'),
	    'show_in_menu' => 'ibinex-calculator'
	    )
	);

	register_post_type( 'crypto-calculator',
	    array(
	            'labels' => array(
	                    'name' => __( 'Cryptocurrency Calculator' ),
	                    'singular_name' => __( 'Display' )
	            ),
	    'public' => 1,
	    'has_archive' => 1,
	    'supports' => array('title'),
	    'show_in_menu' => 'ibinex-calculator'
	    )
	);


	add_menu_page( 
		'Ibinex Cryptocurrency Calculator',	//Page Title
		'Cryptocurrency',	//Menu Title
		'manage_options', 	//User Capability Required
		'ibinex-calculator',	//Menu Slug
		'admin_management_page', //Function to display output
		'dashicons-analytics',	//icon
		'100'	//Position
	);

	add_filter( 'manage_edit-crypto-calculator_columns', 'my_edit_crypto_calculator_columns' ) ;
	add_filter( 'aa', 'my_edit_crypto_calculator_theme' );

	function my_edit_crypto_calculator_columns( $columns ) {    $columns = array(

	        'cb' => '<input type="checkbox" />',

	        'title' => __( 'Title' ),

	        'shortcode' => __( 'Shortcode' ),

	        'currency' => __( 'Currencies' ),

	        'date' => __( 'Date' )

	    );  return $columns;

	}

	function my_edit_crypto_calculator_theme( $style ) {    
		$style = array(
			'cb' => '<input type="radio" />',
			'title' => __( 'Title' ),
			'shortcode' => __( 'Shortcode' ),
			'currency' => __( 'Currencies' ),
			'date' => __( 'Date' )
		);  return $style;

	}


	add_action( 'manage_crypto-calculator_posts_custom_column', 'my_manage_crypto_calculator_columns', 10, 2 );

	function my_manage_crypto_calculator_columns( $column, $post_id ) {
		global $post;
		switch( $column ) {
			case 'shortcode' :
				$shortcode = get_post_custom( $post->specifiedID );
				if ( !empty( $shortcode ) )
					echo __( '[ibx_calc id="'. $post->ID .'"]' );
				else
					echo __( 'sample' );
				break;
			case 'currency' :
				$currency = get_post_custom( $post->specifiedID );
				if ( !empty( $currency ) )
					echo __( implode( ', ', $currency['crypto_symbols']) );
				else
					echo __( 'sample' );
				break;
			default :
				break;
		}
	}
}



add_filter( 'manage_edit-crypto-display_columns', 'my_edit_crypto_display_columns' ) ;
function my_edit_crypto_display_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Movie' ),
		'shortcode' => __( 'Shortcode' ),
		'currency' => __( 'Currencies' ),
		'date' => __( 'Date' )
	);

	return $columns;
}

add_action( 'manage_crypto-display_posts_custom_column', 'my_manage_crypto_display_columns', 10, 2 );
function my_manage_crypto_display_columns( $column, $post_id ) {
	global $post;
	switch( $column ) {
		case 'shortcode' :
			$shortcode = get_post_custom( $post->specifiedID );
			if ( !empty( $shortcode ) )
				echo __( '[crypto_list id="'.$post->ID.'"]' );
			else
				echo __( 'sample' );

			break;
			case 'currency' :
			$currency = get_post_custom( $post->specifiedID );
			if ( !empty( $currency ) )
				echo __( implode( ', ', $currency['crypto_symbols']) );
			else
				echo __( 'sample' );

			break;
		default :
			break;
	}
}
