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

}
