<?php
/* Adding specs tab on Single Product page */

add_filter( 'woocommerce_product_tabs', 'add_specs_product_tab' );

function add_specs_product_tab( $tabs ) {

    $tabs['specs'] = array(
        'title'    => __( 'Specs', 'your-textdomain' ),
        'priority' => 25,
        'callback' => 'render_specs_tab_content'
    );

    return $tabs;
}

/* Getting the specs attributes from product dashboard */

function render_specs_tab_content() {
    $content = get_post_meta( get_the_ID(), 'General', true ) . ' ' . get_post_meta( get_the_ID(), 'Processor', true )
		. ' ' . get_post_meta( get_the_ID(), 'specs_ram', true );

    if ( ! $content ) {
        echo '<p>No specifications added.</p>';
        return;
    }
echo 'hey';
    echo wpautop( wp_kses_post( $content ) );
}
?>