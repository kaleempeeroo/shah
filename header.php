<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="wrapper" class="hfeed">
<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-phone"></i> +021-95-51-84</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> email@email.com</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a></li>
					</ul>
					<ul class="header-links pull-right">
						<li><a href="#"><i class="fa fa-dollar"></i> USD</a></li>
						<li><a href="#"><i class="fa fa-user-o"></i> My Account</a></li>
					</ul>
				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="#" class="logo">
									<img src="./img/logo.png" alt="">
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
								<form>
									<select class="input-select">
										<option value="0">All Categories</option>
										<option value="1">Category 01</option>
										<option value="1">Category 02</option>
									</select>
									<input class="input" placeholder="Search here">
									<button class="search-btn">Search</button>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								<!-- Wishlist -->
								<div>
			

									<a href="#">
										<i class="fa fa-heart-o"></i>
										<span>Your Wishlist</span>
										<div class="qty"><?php 
											// counts number of products in wishlist 
											if ( function_exists( 'YITH_WCWL' ) ) {
												$wishlist_count = YITH_WCWL()->count_products();
												echo '<span class="wishlist-count-top">' . esc_html( $wishlist_count ) . '</span>';
											}
										?>
										</div>
									</a>
								</div>
								<!-- /Wishlist -->

								<!-- Cart -->
								<div class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<i class="fa fa-shopping-cart"></i>
										<span>Your Cart</span>
										<div class="qty"><span class="cart-count-top"><?php echo WC()->cart->get_cart_contents_count(); ?></span></div>
									</a>
									

									<div class="cart-dropdown">
										<div class="cart-list">
											<?php
												if ( ! WC()->cart ) return 0;
												$unique_items = 0;
												$sub_total = 0;

												// start the loop over the cart items
												foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {

													// Check for Simple Product ID or Variation ID
													$qty = $cart_item['quantity'];
													$product = $cart_item['data'];
													
													// 2. Get Name
													$name = $product->get_name(); // Returns name including variation attributes

													// 3. Get Quantity
													$quantity = $cart_item['quantity']; // Direct access from cart item array
													$line_total = WC()->cart->get_product_subtotal( $product, $cart_item['quantity'] );	
													$thumbnail = wp_make_link_relative(wp_get_attachment_image_url( $product->get_image_id(), 'full' )); // Get the URL								
													$unique_items = count( WC()->cart->get_cart() );
													?>

													<!-- Displaying each cart item in cart DIV -->

													<div class="product-widget product-widget-id-<?php echo $cart_item_key; ?>" >

														<div class="product-img">
															<img src="<?php echo $thumbnail; ?>" alt="">
														</div>

														<div class="product-body">
															<h3 class="product-name"><a href="#"><?php echo $name; ?></a></h3>
															<h4 class="product-price price-block-<?php echo $cart_item_key; ?>">
																<span class="qty">
																	<?php echo $cart_item['quantity']; ?>x
																</span> 
																<?php echo WC()->cart->get_product_subtotal( $product, $quantity ); ?>
															</h4>
														</div>
														<!-- close button (x) will send remove request to cart -->
														<a href="<?php echo wc_get_cart_remove_url($cart_item_key); ?>" class="delete">
															<i class="fa fa-close"></i>
														</a>
													</div>
													<?php
												}
											?>									
										</div>
										<div class="cart-summary">
											<small><?php echo ($unique_items) ? $unique_items : 'No '; ?>Item(s) selected</small>
											<h5>SUBTOTAL: <?php echo $sub_total; ?></h5>
										</div>
										<div class="cart-btns">
											<a href="#">View Cart</a>
											<a href="#">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</div>
								</div>
								<!-- /Cart -->

								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->

		<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<li class="active"><a href="#">Home</a></li>
						<li><a href="#">Hot Deals</a></li>
						<li><a href="#">Categories</a></li>
						<li><a href="#">Laptops</a></li>
						<li><a href="#">Smartphones</a></li>
						<li><a href="#">Cameras</a></li>
						<li><a href="#">Accessories</a></li>
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->
	
	<!-- BREADCRUMB -->
	<?php
	
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

	add_action( 'woocommerce_before_main_content', 'open_breadcrumbs_div', 15, 0 );
	
	function open_breadcrumbs_div() {
	?>
	<div id="breadcrumb" class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<div class="col-md-12">
						
	<?php
	}

	add_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

	add_action( 'woocommerce_before_main_content', 'close_breadcrumbs_div', 25, 0 );
	
	function close_breadcrumbs_div() {
	?>
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /breadcrumbs -->		
	<?php
	}
	?>
	<!-- /BREADCRUMB -->