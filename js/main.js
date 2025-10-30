(function($) {
	"use strict"

	// Mobile Nav toggle
	$('.menu-toggle > a').on('click', function (e) {
		e.preventDefault();
		$('#responsive-nav').toggleClass('active');
	})

	// Fix cart dropdown from closing
	$('.cart-dropdown').on('click', function (e) {
		e.stopPropagation();
	});
 
	// Inserts stock HTML from woocommerce output inside our
	// .custom-stock DIV in single product excerpt Price DIV 
	// to display price inline with price
	$('form.variations_form').on('show_variation', function(event, variation){
        const stock_html = variation.availability_html;
        $('.custom-stock').html(stock_html); // Replace your custom container
    });

	 // When "Clear options" is clicked, empty the custom stock div
    $('form.variations_form').on('reset_data', function(){
        $('.custom-stock').html(''); // clears the content
    });

	/////////////////////////////////////////

	// Products Slick
	$('.products-slick').each(function() {
		var $this = $(this),
				$nav = $this.attr('data-nav');

		$this.slick({
			slidesToShow: 4,
			slidesToScroll: 1,
			autoplay: true,
			infinite: true,
			speed: 300,
			dots: false,
			arrows: true,
			appendArrows: $nav ? $nav : false,
			responsive: [{
	        breakpoint: 991,
	        settings: {
	          slidesToShow: 2,
	          slidesToScroll: 1,
	        }
	      },
	      {
	        breakpoint: 480,
	        settings: {
	          slidesToShow: 1,
	          slidesToScroll: 1,
	        }
	      },
	    ]
		});
	});

	// Products Widget Slick
	$('.products-widget-slick').each(function() {
		var $this = $(this),
				$nav = $this.attr('data-nav');

		$this.slick({
			infinite: true,
			autoplay: true,
			speed: 300,
			dots: false,
			arrows: true,
			appendArrows: $nav ? $nav : false,
		});
	});

	/////////////////////////////////////////
	// Product Main img Slick
	$('#product-main-img').slick({
    infinite: true,
    speed: 30,
    dots: false,
    arrows: true,
    fade: true,
    asNavFor: '#product-imgs',
  });

	// Product imgs Slick
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
	if (zoomMainProduct) {
		$('#product-main-img .product-preview').zoom();
	}

	/////////////////////////////////////////

	// Input number
	/*
	$('.input-number').each(function() {
		var $this = $(this),
		$input = $this.find('input[type="number"]'),
		up = $this.find('.qty-up'),
		down = $this.find('.qty-down');

		down.on('click', function () {
			var value = parseInt($input.val()) - 1;
			value = value < 1 ? 1 : value;
			$input.val(value);
			$input.change();
			updatePriceSlider($this , value)
		})

		up.on('click', function () {
			var value = parseInt($input.val()) + 1;
			$input.val(value);
			$input.change();
			updatePriceSlider($this , value)
		})
	});
*/
/*
const observer = new MutationObserver(function(mutations) {
	console.log('MutationObserver triggered', mutations); // Add this line

    mutations.forEach(function(mutation) {
        // Check if the mutation added a new element.

        if (mutation.addedNodes.length > 0) {
            mutation.addedNodes.forEach(function(node) {
                // Check if the added node is the modal or contains the modal content.
                if (node.classList && node.classList.contains('mfp-content')) {
                    // Re-initialize your script for the elements inside the modal.
                    const qtyUpButtons = node.querySelectorAll('.qty-up');
                    const qtyDownButtons = node.querySelectorAll('.qty-down');

// Listen for clicks on the entire document instead of a specific element.
qtyUpButtons.addEventListener('click', function(event) {
    // Check if the clicked element is a quantity-up button.
    if (event.target.classList.contains('qty-up')) {
        const container = event.target.closest('.input-number');
        const input = container.querySelector('input[type="number"]');
        let currentValue = parseInt(input.value);
        
        if (!isNaN(currentValue)) {
            input.value = currentValue + 1;
        }
    }

    // Check if the clicked element is a quantity-down button.
    if (event.target.classList.contains('qty-down')) {
        const container = event.target.closest('.input-number');
        const input = container.querySelector('input[type="number"]');
        let currentValue = parseInt(input.value);

        if (!isNaN(currentValue) && currentValue > 1) {
            input.value = currentValue - 1;
        } else if (currentValue === 1) {
            input.value = 1;
        }
    }
});
	            }
            });
        }
    });
});

/*
// Start observing the body for changes.
observer.observe(document.body, { childList: true, subtree: true });
*/
    $(document).on('click', '.qty-up, .qty-down', function(e) {
	console.log('triggered');
    if (e.target.classList.contains('qty-up')) {
        const container = e.target.closest('.input-number');
        const input = container.querySelector('input[type="number"]');
        let currentValue = parseInt(input.value);
        if (!isNaN(currentValue)) {
            input.value = currentValue + 1;
        }
    }

    if (e.target.classList.contains('qty-down')) {
        const container = e.target.closest('.input-number');
        const input = container.querySelector('input[type="number"]');
        let currentValue = parseInt(input.value);
        if (!isNaN(currentValue) && currentValue > 1) {
            input.value = currentValue - 1;
        } else if (currentValue === 1) {
            input.value = 1;
        }
    }
});

	var priceInputMax = document.getElementById('price-max'),
			priceInputMin = document.getElementById('price-min');

	priceInputMax.addEventListener('change', function(){
		updatePriceSlider($(this).parent() , this.value)
	});

	priceInputMin.addEventListener('change', function(){
		updatePriceSlider($(this).parent() , this.value)
	});

	function updatePriceSlider(elem , value) {
		if ( elem.hasClass('price-min') ) {
			console.log('min')
			priceSlider.noUiSlider.set([value, null]);
		} else if ( elem.hasClass('price-max')) {
			console.log('max')
			priceSlider.noUiSlider.set([null, value]);
		}
	}

	// Price Slider
	var priceSlider = document.getElementById('price-slider');
	if (priceSlider) {
		noUiSlider.create(priceSlider, {
			start: [1, 999],
			connect: true,
			step: 1,
			range: {
				'min': 1,
				'max': 999
			}
		});

		priceSlider.noUiSlider.on('update', function( values, handle ) {
			var value = values[handle];
			handle ? priceInputMax.value = value : priceInputMin.value = value
		});
	}

})(jQuery);
