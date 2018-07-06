<?php

/*
Enqueue scripts
*/
add_action('admin_enqueue_scripts', function () {
    wp_enqueue_style('ibinex-crypto-calculator/select2.css', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css', false, null);
    wp_enqueue_script('ibinex-crypto-calculator/select2.js', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js', ['jquery'], null, true);
    wp_enqueue_script('ibinex-crypto-calculator/select2/main.js', plugin_dir_url(__FILE__) .'js/admin-crypto.js', ['jquery'], null, true);
});



//Register Meta Box
add_action( 'add_meta_boxes', 'crypto_symbols_box');
function crypto_symbols_box() {
    add_meta_box( 
        'rm-meta-box-id',                                   //ID
        esc_html__( 'Currencies', 'ibinex-crypto-calculator' ), //TITLE
        'crypto_symbols',                                   //callback
        ['crypto-display', 'crypto-calculator'],            //screen
        'advanced'                                          //context
    );

    add_meta_box( 
        'rm-meta-box-id1',                                   //ID
        esc_html__( 'Currencies', 'ibinex-crypto-calculator' ), //TITLE
        'op_render_menu_meta_box',                                   //callback
        ['crypto-calculator'],            //screen
        'advanced'                                          //context
    );
}

// Save field
add_action( 'save_post', 'crypto_symbols_save' );
function crypto_symbols_save( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'crypto_symbols_nonce' ) ) return;
     
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post', $post_id ) ) return;

    
    // Make sure your data is set before trying to save it
    if( isset( $_POST['crypto_symbols'] ) )
        update_post_meta( $post_id, 'crypto_symbols', implode( ',', $_POST['crypto_symbols'] )  );
    // Make sure your data is set before trying to save it
    if( isset( $_POST['ibx_calc_theme'] ) )
        update_post_meta( $post_id, 'ibx_calc_theme', filter_var($_POST['ibx_calc_theme'], FILTER_SANITIZE_STRING ));
}

// Add field
function crypto_symbols( $meta_id ) {
    global $post;
    $values = get_post_custom( $post->ID );
    wp_nonce_field( 'crypto_symbols_nonce', 'meta_box_nonce' );
    $outline = '<select id="crypto_symbols" name="crypto_symbols[]" class="js-example-basic-multiple"  multiple="multiple" style="width: 100%;"></select>';
    echo $outline;


    wp_localize_script('ibinex-crypto-calculator/select2.js', 'cryptoSymbols', (array_key_exists("crypto_symbols", $values)) ? $values['crypto_symbols'] : ['']);
}

function op_render_menu_meta_box() {
    global $post;
    // Metabox content
    wp_nonce_field( 'crypto_style_nonce', 'meta_boxstyle_nonce' );
    $value = get_post_meta( $post->ID, 'ibx_calc_theme', true );
    ?>

    <div class="d-flex row justify-content-around align-items-center">
        <label><?php _e('Choose Theme', 'accesspress-social-counter'); ?></label>
        <div class="col-12">
            <label class="col-4">
                <input type="radio" name="ibx_calc_theme" value="theme-1" <?php checked( $value, 'theme-1' ); ?>>
                <div class=""><img src="<?php echo SC_IMAGE_DIR.'/style1.PNG';?>"/></div>
            </label>
            <label class="col-4">
                <input type="radio" name="ibx_calc_theme" value="theme-2" <?php checked( $value, 'theme-2' ); ?>>
                <div class=""><img src="<?php echo SC_IMAGE_DIR.'/style2.PNG';?>"/></div>
            </label>
            <label class="col-4">
                <input type="radio" name="ibx_calc_theme" value="theme-3" <?php checked( $value, 'theme-3' ); ?>>
                <div class=""><img src="<?php echo SC_IMAGE_DIR.'/style3.PNG';?>"/></div>
            </label>
        </div>
    </div>

    <?php
}