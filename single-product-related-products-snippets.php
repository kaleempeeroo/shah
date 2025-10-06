<?php
add_filter( 'woocommerce_loop_add_to_cart_link', function( $html, $product, $args ) {
    if ( function_exists('yith_woocompare_is_compare_page') && yith_woocompare_is_compare_page() ) {
        $favicon_url = get_stylesheet_directory_uri() . '/images/my-favicon.png';
        $icon_html = '<i class="fa fa-shopping-cart"></i>';
        // Inject icon before button text
        $html = preg_replace('/>(.*?)<\/a>/', '>' . $icon_html . '$1</a>', $html);
    }
    return $html . '<i class="fa fa-shopping-cart"></i>';
}, 10, 3 );


function custom_compare_shortcode($atts) {
    $atts = shortcode_atts([
        'id' => get_the_ID(),
        'class' => '',
    ], $atts);

    $product_id = intval($atts['id']);
    $class = sanitize_html_class($atts['class']);
    $url = add_query_arg([
        'action' => 'yith-woocompare-add-product',
        'id' => $product_id
    ], site_url('/'));

    return '<a href="' . esc_url($url) . '" class="compare ' . esc_attr($class) . '" data-product_id="' . $product_id . '" rel="nofollow">
        <span>Add To Compare</span>
        <i class="fa fa-exchange"></i>
    </a>';
}
add_shortcode('custom_compare', 'custom_compare_shortcode');

/* Forcibly removing another Related Products section appearing after our custom one defined above*/
add_action( 'wp', function() {
    if ( is_product() ) {
        remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
    }
});

add_action( 'woocommerce_after_single_product_summary', 'related_products_', 25);

function related_products_() {
   
	$output = null;

    ob_start();
    woocommerce_related_products( array (
	'posts_per_page' => 4,
	'columns' => 4,)); 
    $content = ob_get_clean();
    if($content) { $output .= $content; }

    echo '<div class="clear"></div><h1>ho</h1>' . $output;
}

remove_action ('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail',10);

add_action ('woocommerce_before_shop_loop_item_title', 'open_template_loop_product_thumbnail',9);

function open_template_loop_product_thumbnail () {
	?>

		<div class="product">
			<div class="product-img">

				
	<?php
		
}
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );

add_action ('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail',10);

add_action ('woocommerce_before_shop_loop_item_title', 'close_template_loop_product_thumbnail',11);
	

function close_template_loop_product_thumbnail () {
?>
			<div class="product-label">
					<span> LABEL </span>
				</div>
			</div>
			<div class="product-body">
				<p class="product-category"> 
					<?php 
					   $product = wc_get_product(get_the_ID());
					   $terms = get_the_terms($product->ID, 'product_cat');
   					   foreach ($terms as $term) {

        				$product_cat = $term->name;
           				echo $product_cat;
             			break;
  						}
					?>
				</p>
				<h3 class="product-name">
					<?php the_title();     
				?> </h3>
				<h4 class="product-price">
					<?php 
						echo wc_price($product->get_price());
						$old_price = $product->get_regular_price();
						   
						echo '<del class="product-old-price">' . wc_price($old_price) . '</del>';						   
					?>
				</h4>
<?php
}

add_action('woocommerce_after_shop_loop_item_title', 'loop_rating', 3); 

function loop_rating(){
?>
	<div class="product-rating"> 

<?php
}
add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);

add_action('woocommerce_after_shop_loop_item_title', 'close_div_rating', 6); 
	
	function close_div_rating() {
?>
		</div>
<?php
}

add_action ('woocommerce_after_shop_loop_item_title', 'open_product_btns_div',12);

function open_product_btns_div() {
?>
	<div class="product-btns">		
		<?php echo  do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
		<?php echo  do_shortcode('[custom_compare class="green-button"]'); ?>


		<button class="quick-view">
			<i class="fa fa-eye"></i>
			<span class="tooltipp">Quick View</span>
		</button>
		
	</div>

<?php
}
	
	
add_action ('woocommerce_after_shop_loop_item_title', 'close_div',15);

	function close_div() {
?>
			

</div>
		<?php
}


remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
add_action( 'woocommerce_after_shop_loop_item', 'my_template_loop_add_to_cart' );
//remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close');
	
function my_template_loop_add_to_cart ()
{
	echo '<div style="background-color:green">yo</div>';
}


?>