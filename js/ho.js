jQuery(document).ready(function ($) {
    $("input.wspsc_add_cart_submit").replaceWith( 
        "<button class=\"add-to-cart-btn\"><i class=\"fa fa-shopping-cart\"></i>Add to Cart</button> " 
        );

    	$('#product-main-img').slick({
            infinite: true,
            speed: 300,
            dots: false,
            arrows: true,
            fade: true,
            asNavFor: '#product-imgs',
          });


          $('#product-imgs').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            arrows: true,
            centerMode: true,
            focusOnSelect: true,
                centerPadding: 0,
                vertical: true,
            asNavFor: '#product-main-img',
                responsive: [{
                breakpoint: 991,
                settings: {
                            vertical: false,
                            arrows: false,
                            dots: true,
                }
              },
            ]
          });

        
            // Product img zoom
            var zoomMainProduct = document.getElementById('product-main-img');
          //alert(zoomMainProduct);

            //if (zoomMainProduct) {
                $('#product-main-img .product-preview').zoom();
            //}
        
        

    }); 