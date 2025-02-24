<?php 
get_header();
?>
<!-- SECTION -->
<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">


					<!-- Products tab & slick -->
					<div class="col-md-12">
						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								<div id="tab1" class="tab-pane active">
									<div class="products-slick" data-nav="#slick-nav-1">
									
<?php


// search for targetted featured products.
// meta WP query by ids.
// output img in slider with <a> get_the_permalink() </a>
// output slider button as it is in slider 
// wrap add to cart link with <a> get_the_ID() <a> around button
// 

         
                 
     
     $params = array('posts_per_page' => 5, 'post_type' => 'product', 'p' => array(89,141)    ); // (1)
     $wc_query = new WP_Query($params); // (2)

     // search for targetted featured products.
     // meta WP query by ids.
     // output img in slider with <a> get_the_permalink() </a>
     // output slider button as it is in slider 
     // wrap add to cart link with <a> get_the_ID() <a> around button
     // 

      if ($wc_query->have_posts()) : 
      while ($wc_query->have_posts()) :
                     $wc_query->the_post(); 
                      //the_title();
                      //the_content();
                      //$id = get_the_ID();
                      //echo do_shortcode( '[add_to_cart id='.$id.']');
                      //wc_get_template_part( 'content', 'product' );
                      global $product;
                      //do_action( 'single_product_archive_thumbnail_size' );
                      $image_size = apply_filters( 'single_product_archive_thumbnail_size', 'woocommerce_thumbnail' );
              ?>
                   <!-- product -->
										<div class="product">
											<div class="product-img">
                                                            <a href="<?php echo get_the_permalink() ;?>">
												<?php echo $product ? $product->get_image( $image_size ) : 'no'; ?>
                                                            </a>
                                                       </div>
											<div class="product-body">
												<p class="product-category">Category</p>
												<h3 class="product-name"><a href="#"><?php echo the_title() ;?></a></h3>
												<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
												<div class="product-rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
												</div>
												<div class="product-btns">
													<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
													<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
													<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
												</div>
											</div>
											<div class="add-to-cart">
												<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
											</div>
										</div>
										
                   
              <?php
     endwhile; 
  
     wp_reset_postdata(); 
       else:  ?>
     <p>
          <?php _e( 'No Products' ); // (6) ?>
     </p>
     <?php endif; ?>
     <?php
     //the_content();

     //$images = wp_get_attachment_image_src( get_post_thumbnail_id($product->get_the_ID()));
     // <! <img src= <?php echo $images[0];  
     
 ?>
 
                                             </div>
									<div id="slick-nav-1" class="products-slick-nav"></div>
								</div>
								<!-- /tab -->
							</div>
						</div>
					</div>
	                    <!-- Products tab & slick -->

       </div>
       </div>
       </div>
<?php

get_footer();
?>
