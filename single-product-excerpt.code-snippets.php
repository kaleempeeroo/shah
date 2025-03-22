<?php
remove_action( 'woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
////do_action( 'woocommerce_product_after_tabs' );
//add_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
//add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );


add_action( 'woocommerce_single_product_summary', 'open_excerpt_section_div', 2 );
function open_excerpt_section_div () {
?>
<div class="product-details" style="clear:both;z-index:10;position:relative;border:1px solid green;"> open product details
<?php
}
add_action( 'woocommerce_single_product_summary', 'open_price_div', 7 );

function open_price_div() {
?>
	<!-- Product details -->				 
						
	<div id="product-price">	
		<h3 class="product-price">
<?php
}
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'close_price_div', 11 );
function close_price_div() {	
?>					
		<del class="product-old-price"></del></h3>
		<span class="product-available">In Stock</span>
	</div>
					
<?php
}

// test div -- big outer
//add_action( 'woocommerce_before_single_product', 'open_div', 15 );
// excerpt div

remove_action( 'woocommerce_single_product_summary', 'title_open', 3 );
function title_open() {	
	?><div id="title">title open

	<?php
}
remove_action( 'woocommerce_single_product_summary', 'title', 4 );
function title() {
	?>
	<h2 class="product-name">
<?php
}
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 7 );	

remove_action( 'woocommerce_single_product_summary', 'title_close', 8 );
function title_close() {
	?> </h2></div> title close
<?php
}
	


add_action( 'woocommerce_single_product_summary', 'open_excerpt_div', 6 );

function open_excerpt_div() {
	?>
							<div>
								<div class="product-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o"></i>
								</div>
								<a class="review-link" href="#">10 Review(s) | Add your review</a>
							</div>
					
					
		
<?php
}
add_action( 'woocommerce_single_product_summary', 'close_excerpt_div', 45 );
function close_excerpt_div(){
	
	?>
</div>close product details
	<?php
}
add_action( 'woocommerce_after_single_product_summary', 'clear_tabs', 10 );
function clear_tabs() {
	?>
	open tabs div
	
		<div style="height:200px; width:100%; clear:both;"></div>
	
close tabs div
<?php
	
}

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 20 );
add_action( 'woocommerce_single_product_summary', 'excerpt', 28 );

do_action( 'woocommerce_before_add_to_cart_form' );

add_action( 'woocommerce_variable_add_to_cart', 'woocommerce_before_variable_add_to_cart', 29 );
add_action( 'woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30 );
add_action( 'woocommerce_variable_add_to_cart', 'woocommerce_after_variable_add_to_cart', 40 );
/*

add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
 
remove_action( 'woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 29 );
remove_action( 'woocommerce_grouped_add_to_cart', 'woocommerce_grouped_add_to_cart', 30 );

add_action( 'woocommerce_before_add_to_cart_button', 'woocommerce_after_variable_add_to_cart',41 );

////

remove_action( 'woocommerce_external_add_to_cart', 'woocommerce_external_add_to_cart', 30 );
remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation', 10 );
add_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );
*/
do_action( 'woocommerce_before_quantity_input_field' );
do_action( 'woocommerce_after_quantity_input_field' );
do_action( 'woocommerce_after_add_to_cart_button' );
do_action( 'woocommerce_after_add_to_cart_form' );

function excerpt () {
	the_title();
?>
	hey
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
<?php }

function woocommerce_before_variable_add_to_cart() {
?>
							<div class="product-options">
								heyy
			<!--
								<label>
									Size
									<select class="input-select">
										<option value="0">X</option>
									</select>
								</label>
								<label>
									Color
									<select class="input-select">
										<option value="0">Red</option>
									</select>
								</label>
							</div>

							<div class="add-to-cart">
								<div class="qty-label">
									Qty
									<div class="input-number">
										<input type="number">
										<span class="qty-up">+</span>
										<span class="qty-down">-</span>
									</div>
								</div>
								<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
							</div>
							<ul class="product-btns">
								<li><a href="#"><i class="fa fa-heart-o"></i> add to wishlist</a></li>
								<li><a href="#"><i class="fa fa-exchange"></i> add to compare</a></li>
							</ul>

							<ul class="product-links">
								<li>Category:</li>
								<li><a href="#">Headphones</a></li>
								<li><a href="#">Accessories</a></li>
							</ul>

							<ul class="product-links">
								<li>Share:</li>
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
								<li><a href="#"><i class="fa fa-envelope"></i></a></li>
							</ul>

						</div>
					</div>
					<!-- /Product details -->
<?php }


function woocommerce_after_variable_add_to_cart () {
	echo 'eeehey</div>';
}

