<?php

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}


// Delete all data related to the plugin.
$args = array(
    'post_type' => 'crypto-display',
    'numberposts' => -1
);
$crypto_delete = get_posts( $args );

foreach( $crypto_delete as $crypto_delete_post ) {

    wp_delete_post( $crypto_delete_post->ID, true );

}