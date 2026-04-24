/* 
   Single Product Excerpt section.
   Removing defaults Add to Cart, 
   price, rating and title.
*/

remove_action( 'woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );

/* 
   Single Product Excerpt section opening wrapper DIV hook. 
   woocommerce_single_product_summary, 
   PRIORITY = 2 
*/

add_action( 'woocommerce_single_product_summary', 'open_excerpt_div', 2 );

/* Single Product Excerpt section opening wrapper DIV */

function open_excerpt_div () {
?>
	<!-- Excerpt opening wrapper DIV -->	
	<div class="product-details">
<?php
}

/* Add Product title before ratings.
   woocommerce_single_product_summary, 
   PRIORITY = 5
*/

add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );


/* Rating DIV hook. 
   woocommerce_single_product_summary, 
   PRIORITY = 6
*/

add_action( 'woocommerce_single_product_summary', 'rating_div', 6 );

function rating_div() {
?> 		
	<!-- open excerpt rating DIV -->			
	<div class="excerpt-rating">
		 
		<?php 	
		 global $product;
		 $average_rating = $product->get_average_rating();
		 $review_count = $product->get_review_count();
	     $reviews_url = get_permalink($product->get_id()) . '#tab-reviews';
		 // Output the rating HTML
		 echo wc_get_rating_html($average_rating, $review_count); 		
		?>
		
		<a class="review-link" href="<?php echo esc_url($reviews_url); ?>">
    		<?php echo esc_html($review_count); ?> Review(s) | Add your review
		</a>	
	
	</div>		
	<!-- close excerpt rating -->						
<?php
}

/* Product Price (Old/New) opening DIV hook. 
   woocommerce_single_product_summary, 
   PRIORITY = 7 
*/

add_action( 'woocommerce_single_product_summary', 'open_price_div', 7 );

/* Excerpt section price, opening wrapper DIV */

function open_price_div() {
?>
	<!-- Product price details -->				 						
	<div id="product-price">	
		<h3 class="product-price">
<?php
}

/*
	Outputs price (old/new) hook.
	woocommerce_single_product_summary, 
    PRIORITY = 10 
	
*/

add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

/*
	Closes price </h3>.
	woocommerce_single_product_summary, 
    PRIORITY = 11 
*/

add_action( 'woocommerce_single_product_summary', 'close_price_h3', 11 );
function close_price_h3() {
	echo '</h3>';
}

/* 
	Outputs stock after price. 
	woocommerce_single_product_summary, 
   	PRIORITY = 12


add_action( 'woocommerce_single_product_summary', function() {
   global $product;
   if ( $product->is_type('variable') ) {
        // If it's a variable product, don't display stock initially,
        // otherwise it outputs total stock for variable product like 100.
        // The stock will be displayed dynamically by WooCommerce's JavaScript
        // echo '<p class="stock-info initial-stock-message">Select an option to see stock.</p>';
    } else {
        // If it's a simple product, display the stock as normal
        //
        //
        //echo wc_get_stock_html( $product );
    }
}, 12 );
*/

/* 
   Excerpt section price, closing wrapper DIV.
   Adds stock DIV before closing wrapper DIV.
   woocommerce_single_product_summary, 
   PRIORITY = 13
*/

add_action( 'woocommerce_single_product_summary', 'close_price_div', 13 );

function close_price_div() {	
	global $product;
	// if simple product 
	if ( !$product->is_type('variable') ) {
		// if in stock
		if ( $product->get_stock_quantity() > 0 ) {
		  	// Wrap the standard "In Stock" message in a custom div
		 	echo '<div class="custom-stock">' . $product->get_stock_quantity() .' in stock</div>';
		}
		else {
			echo '<div class="custom-stock">Out of stock</div>';
		}
    }
	else {
		// It is a variable product. 
		// main.js will handle this div and output stock.
		echo '<div class="custom-stock"></div>';
	}
?>			
	</div>
	<!-- close price div  -->					
<?php
}

/* 
   Single Product excerpt description summary hook. 
   woocommerce_single_product_summary, 
   PRIORITY = 28
*/

add_action( 'woocommerce_single_product_summary', 'excerpt', 28 );

function excerpt () {
?>
<p>
	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
	Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
</p>
<?php
}

// Do any actions needed before form

do_action( 'woocommerce_before_add_to_cart_form' );

/*
    Before hook styling the options (SIZE,COLOR) combo dropdowns. 
	woocommerce_variable_add_to_cart,
	PRIORITY = 29.
*/ 

add_action( 'woocommerce_variable_add_to_cart', 'woocommerce_before_variable_add_to_cart', 29 );

function woocommerce_before_variable_add_to_cart() {
?>
	<!-- opening product options DIV -->
	<div class="product-options">			
<?php
}
	
/* 
   Single Product Add to Cart for variable product section hook.
   Seems to work with simple product as well.   
   woocommerce_variable_add_to_cart, 
   PRIORITY = 30. 
*/

add_action( 'woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30 );


/* 
   Single Product before quantity input hook inside add to cart form. 
   Outputs a opening wrapper DIV.quantity.
   Outputs a table with Qty label, input boxes for amount and Add to Cart button.
   woocommerce_before_quantity_input_field, 
   PRIORITY = 10
*/

add_action( 'woocommerce_before_quantity_input_field', 'before_quantity_input_field', 10 );

function before_quantity_input_field() {
	?>
	<!-- Quantity label DIV -->
	<div class="qty-label" style="border=1px solid yellow;">
		<table id="input-number">
			<tr>
				<th class="label"><label>Qty</label></th>
				<td></td>
				<td style="padding-left:2px;">	
					<div class="input-number">
						<input type="number" value=1>
						<span class="qty-up">+</span>
						<span class="qty-down">-</span>
								</div>
				</td>
				<td style="padding-left:25px;">								 
					<button class="add-to-cart-btn">
						<i class="fa fa-shopping-cart"></i> add to cart
					</button>
				 </td>
				</tr>
			</table>
							</div>
	<!-- Quantity label DIV close -->
<?php
}

/*
    After hook styling the options (SIZE,COLOR) combo dropdowns. 
	woocommerce_variable_add_to_cart,
	PRIORITY = 40.
*/ 

add_action( 'woocommerce_variable_add_to_cart', 'woocommerce_after_variable_add_to_cart', 40 );

function woocommerce_after_variable_add_to_cart () {
	echo '</div> <!-- closing product options DIV -->';
}

// Do any actions needed after add to cart button is displayed

do_action( 'woocommerce_after_add_to_cart_button' );

// Do any actions needed after form

do_action( 'woocommerce_after_add_to_cart_form' );

/* 
   Single Product Excerpt section closing wrapper DIV hook. 
   woocommerce_single_product_summary, 
   PRIORITY = 45 
*/

add_action( 'woocommerce_single_product_summary', 'close_excerpt_div', 45 );

function close_excerpt_div(){
	// social buttons
	echo do_shortcode('[insertrankyasharebuttonshortcode]');

	?>
	<ul class="product-links">
		<li>Share:</li>
		<li><a href="#"><i class="fa fa-facebook"></i></a></li>
		<li><a href="#"><i class="fa fa-twitter"></i></a></li>
		<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
		<li><a href="#"><i class="fa fa-envelope"></i></a></li>
	</ul>

</div>		
<!-- Excerpt closing wrapper DIV -->	
<?php
}

/* 
   Single Product tabs section hook. 
   woocommerce_after_single_product_summary, 
   PRIORITY = 10 
*/

add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );


/*
	Intercepting the form on Single Product page for the Add to Cart button.
	Get the current url we are on.
	Get the quantity if it is set in URI else default to 1.
	Construct URL by adding product ID and quantity for WooCommerce Cart page.	
*/

add_filter( 'woocommerce_add_to_cart_form_action', 'custom_add_to_cart_form_action' );

function custom_add_to_cart_form_action( $url ) {
    // Option 1: Redirect to Checkout directly
    //$url = "http://localhost/shah/cart";
	global $product;
 	$current_url = get_permalink( $product->get_id() );

    // Check if we are on a product page and have a valid product object
    if ( is_product() && is_object( $product ) ) {
        $product_id = $product->get_id();
        
        // Get the current quantity (defaults to 1 if not set)
        $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 1;

        // Construct the URL with parameters
        $url = add_query_arg( array(
            'add-to-cart' => $product_id,
            'quantity'    => $quantity
        ), $current_url );
    }

    return $url;
    // Option 2: Redirect to a custom page URL
    // return home_url( '/custom-thank-you/' );
}
