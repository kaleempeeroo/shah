<?php 
get_header();
?>
<!-- SECTION -->
<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- Product main img -->
					<?php echo '<h1>heyd</h1>' ; ?>
					<div class="col-md-5 col-md-push-2">
						<div id="product-main-img" class="slick-initialized slick-slider">
							<button class="slick-prev slick-arrow" aria-label="Previous" type="button" style="display: block;">Previous</button>
							
							<div class="slick-list draggable">
								<div class="slick-track" style="opacity: 1; width: 2880px;">
									<div class="product-preview slick-slide" data-slick-index="0" aria-hidden="true" tabindex="-1" style="width: 720px; position: relative; left: 0px; top: 0px; z-index: 998; opacity: 0; overflow: hidden; transition: opacity 300ms;">
								
									<img src=<?php echo get_theme_file_uri('/img/') ; ?>product01.png alt="">
							
									<img role="presentation" src=<?php echo get_theme_file_uri('/img/') ; ?>product01.png class="zoomImg" style="position: absolute; top: 71.3333px; left: 111.833px; opacity: 0; width: 600px; height: 600px; border: none; max-width: none; max-height: none;"></div><div class="product-preview slick-slide slick-current slick-active" data-slick-index="1" aria-hidden="false" tabindex="0" style="width: 720px; position: relative; left: -720px; top: 0px; z-index: 999; opacity: 1; overflow: hidden;">
								<img src="./img/product05.png" alt="">
							<img role="presentation" src=<?php echo get_theme_file_uri('/img/') ; ?>product05.png class="zoomImg" style="position: absolute; top: 46.8333px; left: 115.833px; opacity: 0; width: 600px; height: 600px; border: none; max-width: none; max-height: none;"></div><div class="product-preview slick-slide" data-slick-index="2" aria-hidden="true" tabindex="-1" style="width: 720px; position: relative; left: -1440px; top: 0px; z-index: 998; opacity: 0; overflow: hidden;">
								<img src="./img/product06.png" alt="hey">
							<img role="presentation" src="file:///C:/Users/User/Downloads/electro-master/electro-master/img/product06.png" class="zoomImg" style="position: absolute; top: 0px; left: 0px; opacity: 0; width: 600px; height: 600px; border: none; max-width: none; max-height: none;"></div><div class="product-preview slick-slide" data-slick-index="3" aria-hidden="true" tabindex="-1" style="width: 720px; position: relative; left: -2160px; top: 0px; z-index: 998; opacity: 0; overflow: hidden;">
								<img src="./img/product08.png" alt="">
							<img role="presentation" src="file:///C:/Users/User/Downloads/electro-master/electro-master/img/product08.png" class="zoomImg" style="position: absolute; top: 0px; left: 0px; opacity: 0; width: 600px; height: 600px; border: none; max-width: none; max-height: none;"></div></div></div>

							

							

							
						<button class="slick-next slick-arrow" aria-label="Next" type="button" style="display: block;">Next</button></div>
					</div>	<!-- /Product main img -->

					<!-- Product thumb imgs -->
					<div class="col-md-2  col-md-pull-5">
						<div id="product-imgs">
							<div class="product-preview">
								<img src=<?php echo get_theme_file_uri('/img/') ; ?>product01.png alt="">
							</div>

							<div class="product-preview">
								<img src="./img/product03.png" alt="">
							</div>

							<div class="product-preview">
								<img src="./img/product06.png" alt="">
							</div>

							<div class="product-preview">
								<img src="./img/product08.png" alt="">
							</div>
						</div>
					</div>
					<!-- /Product thumb imgs -->
  </div>
  </div>
  </div>

  <?php

get_footer();
?>
