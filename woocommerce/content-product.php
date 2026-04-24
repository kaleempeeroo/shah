<?php
/**
 * The template for displaying product content within loops such as Related Products on Single Product page,
 * Top Selling and New Products on Home page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Check if the product is a valid WooCommerce product and ensure its visibility before proceeding.
if ( ! is_a( $product, WC_Product::class ) || ! $product->is_visible() ) {
	return;
}
?>
<li <?php wc_product_class( '', $product ); ?>>
	
	<!-- Adding Related products wrapper -->
	<div class="product">
	
	<?php
	/**
	 * Hook: woocommerce_before_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item' );

	/**
	 * Hook: woocommerce_before_shop_loop_item_title.
	 *
	 * @hooked woocommerce_show_product_loop_sale_flash - 10
	 * @hooked woocommerce_template_loop_product_thumbnail - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item_title' );

	/**
	 * Hook: woocommerce_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_product_title - 10
	 */
	do_action( 'woocommerce_shop_loop_item_title' );

	/**
	 * Hook: woocommerce_after_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_rating - 5
	 * @hooked woocommerce_template_loop_price - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item_title' );

	/**
	 * Hook: woocommerce_after_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item' );
	?></div> <!-- closing div -->

	 <!-- 
		Adds the pop down Add to Cart button on mouse hover.
		If the item is a single product then we can add 1 item directly to cart, 
		by constructing the URL according to WC cart url.
		Else if the item is a variable, then get the link for that product
		and let user visit it so that options can be chosen.	  
	 -->
	<div class="add-to-cart">
		<?php 
			// get product ID
			$current_id = $product->get_id();
			// get the quantity in cart for that product ID
			$qty_in_cart = get_cart_quantity_by_id( $current_id );
			// check if simple product and add 1 to cart.
			if (!$product->is_type( 'variable' ) && $qty_in_cart >= 1) 
				$current_url = wc_get_cart_url() . '?add-to-cart=' . $current_id  . '&quantity=1';
			// else if variable product, get the product page link.
			else 
				$current_url = get_permalink( get_the_ID() );			
		?>	
		<!-- Add the $current_url constructed above to the form for Add to Cart button -->
		<form class="related-products" action="<?php echo $current_url; ?>" method="post">
			<button class="add-to-cart-btn" Enable><i class="fa fa-shopping-cart"></i> add to cart	</button>
		</form>
	</div>
 
</li>
