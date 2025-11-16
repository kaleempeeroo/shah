<?php
/**
 * Custom template for displaying product content in a slider.
 */

if (!defined('ABSPATH')) {
    exit;
}

global $product;

?>
<div class="product-widget">
									<div class="product-img">
										<img src="<?php echo get_theme_file_uri('/img/') ; ?>product07.png" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Category</p>
										<h3 class="product-name"><a href="#">product name goes here</a></h3>
										<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
									</div>
</div>