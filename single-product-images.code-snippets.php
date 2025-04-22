<?php
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );


add_action( 'woocommerce_before_single_product_summary', 'hey', 20 );
// removed below action and images displaying correctly.
//add_action( 'woocommerce_product_thumbnails', 'hey', 10 );
 
//add_action( 'woocommerce_product_thumbnails', 'hey', 20 );
 
function hey () {
	echo 'hey';
	?>
				
			<!-- Product main img -->
			<?php echo '<h1>sshewy</h1>' ; ?>
			<div class="col-md-5 col-md-push0">
					<!-- Product main img -->
					<!-- Controls main img x-axis position -->
					<div class="col-md-2 col-md-push-1">
						<div id="product-main-img">
							<div class="product-preview">
								<img src=<?php echo get_theme_file_uri('/img/') ; ?>product01.png alt="">
							</div>

							<div class="product-preview">
								<img src=<?php echo get_theme_file_uri('/img/') ; ?>product03.png alt="">
							</div>

							<div class="product-preview">
								<img src=<?php echo get_theme_file_uri('/img/') ; ?>product06.png alt="">
							</div>

							<div class="product-preview">
								<img src=<?php echo get_theme_file_uri('/img/') ; ?>product08.png alt="">
							</div>
						</div>
					</div>
					<!-- /Product main img -->

			
					<!-- Product thumb imgs -->
					<!-- Controls thumbnails img x-axis position -->
					<div class="col-md-2 col-md-pull-3">
						<div id="product-imgs">
							<div class="product-preview">
								<img src=<?php echo get_theme_file_uri('/img/') ; ?>product01.png alt="">
							</div>

							<div class="product-preview">
								<img src=<?php echo get_theme_file_uri('/img/') ; ?>product03.png alt="">
							</div>

							<div class="product-preview">
								<img src=<?php echo get_theme_file_uri('/img/') ; ?>product06.png alt="">
							</div>

							<div class="product-preview">
								<img src=<?php echo get_theme_file_uri('/img/') ; ?>product08.png alt="">
							</div>
						</div>
					</div>
					<!-- /Product thumb imgs -->
				</div>
<?php
}