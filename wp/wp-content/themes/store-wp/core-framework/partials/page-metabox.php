<?php
function igthemes_page_meta() {
    add_meta_box( 'igthemes_meta', __( 'Page Settings', 'store-wp' ), 'igthemes_meta_callback', 'page','side' );
}
add_action( 'add_meta_boxes', 'igthemes_page_meta' );
/**
 * Outputs the content of the meta box
 */
function igthemes_meta_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'igthemes_nonce' );
    $igthemes_stored_meta = get_post_meta( $post->ID );
    ?>
    <p>
        <span class="igthemes-row-title"><strong><?php _e( 'Page title', 'store-wp' )?></strong></span>
        <div class="igthemes-row-content">
            <label for="igthemes-page-title">
                <input type="checkbox" name="igthemes-page-title" id="igthemes-page-title" value="yes" <?php if ( isset ( $igthemes_stored_meta['igthemes-page-title'] ) ) checked( $igthemes_stored_meta['igthemes-page-title'][0], 'yes' ); ?> />
                <?php _e( 'Hide page title', 'store-wp' )?>
            </label>
        </div>
    </p>

<?php
}
/**
 * Saves the custom meta input
 */
function igthemes_meta_save( $post_id ) {

    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'igthemes_nonce' ] ) && wp_verify_nonce( $_POST[ 'igthemes_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }

    // Checks for input and saves
    if( isset( $_POST[ 'igthemes-page-title' ] ) ) {
        update_post_meta( $post_id, 'igthemes-page-title', 'yes' );
    } else {
        update_post_meta( $post_id, 'igthemes-page-title', '' );
        delete_post_meta( $post_id, 'igthemes-page-title' );
    }
}
add_action( 'save_post', 'igthemes_meta_save' );
