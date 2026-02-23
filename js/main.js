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
 
	// 1. Initialize DOM references (Cache them)
    const selectors = {
        //button: $('.add-to-cart-btn'),
        //input: $('input.qty'),
        //container: $('.input-number'),
		custom_stock_div: $('.custom-stock'),
		add_to_cart_btn: $('.add-to-cart-btn'),
		qtyInput: $('input.number'),
		numberInput: $('.input-number input'),
		numberInputDiv: $('.input-number')
    };

	// Inserts stock HTML from woocommerce output inside our
	// .custom-stock DIV in single product excerpt Price DIV 
	// to display price inline with price
	$('form.variations_form').on('show_variation', function(event, variation){
        const stock_html = variation.availability_html;
        selectors.custom_stock_div.html(stock_html); // Replace your custom container
		// if variation is not in stock
		if ( ! variation.is_in_stock ) {
        // Disables the button and changes opacity
		// adds pointer-events: none class to disable hover effects if not in stock for Add to Cart button
        selectors.add_to_cart_btn.prop('disabled', true).css('opacity', '0.5');
		selectors.add_to_cart_btn.addClass('no-hover-allowed');
		 //var $qtyInput = jQuery('input.number');
		} 
		// variation is in stock
		else {
			// Re-enables Add to Cart button if they switch to an in-stock version
			selectors.add_to_cart_btn.prop('disabled', false).css('opacity', '1');
			// removes pointer-events: none class to re enable hover effects for Add to Cart button
			selectors.add_to_cart_btn.removeClass('no-hover-allowed');
			
			//selectors.numberInput.prop('disabled', false).css('opacity', '1');
			selectors.numberInput.prop('readonly', false).css('opacity', '1');
			// re enable input DIV for quantity if in stock.
			selectors.numberInputDiv.prop('disabled', false).css('opacity', '1');

			selectors.numberInput.on('change', function() {
				alert('hey');
				if (parseInt(selectors.numberInput.val()) > maxStock) {
					alert("Only " + maxStock + " units available!");
					selectors.numberInput.val(maxStock); // Reset to max available
				}
			}); // end quantity change event.
		}
    });
    
    

	 // When "Clear options" is clicked, empty the custom stock div
    $('form.variations_form').on('reset_data', function(){
        selectors.custom_stock_div.html(''); // clears the content
		// Disable Add to Cart button on page load until product selection is made.
		selectors.add_to_cart_btn.prop('disabled', true).css('opacity', '0.5');
		selectors.add_to_cart_btn.addClass('no-hover-allowed');
		//$('.input-number').prop('disabled', true).css('opacity', '0.5');
		//$('.input-number input').prop('readonly', true);
		selectors.numberInput.prop('readonly', true).css('opacity', '0.5');
		// re enable input DIV for quantity if in stock.
		//selectors.numberInputDiv.prop('disabled', true).css('opacity', '1');
    });

	if ($('.custom-stock:contains("Out of stock")').length > 0) {
        selectors.add_to_cart_btn.attr('disabled', 'disabled').css('pointer-events', 'none').css('opacity', '0.5');
		// disable input for quantity on product page.
		//$('.input-number').prop('disabled', true).css('opacity', '0.5');
		//$('.input-number input').prop('readonly', true);
		selectors.numberInput.prop('readonly', true).css('opacity', '0.5');
    }

	
	jQuery(document).ready(function($) {
    // If it is a variable product, the variation form exits.
	// Disable Add to Cart button on page load until product selection is made.
    if ( $('form.variations_form').length > 0 ) {
        selectors.add_to_cart_btn.prop('disabled', true).css('opacity', '0.5');
		selectors.add_to_cart_btn.addClass('no-hover-allowed');
		// disable input for quantity on initial loading of product page.
		//$('.input-number').prop('disabled', true).css('opacity', '0.5');
		//$('.input-number input').prop('readonly', true);
		selectors.numberInputDiv.prop('disabled', false).css('opacity', '1');
		
    }
})

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

	// + or - buttons are clicked on single product page to increase purchase quantity.
	
    $(document).on('click', '.qty-up, .qty-down', function(e) {
    if (e.target.classList.contains('qty-up')) {
        const container = e.target.closest('.input-number');
        const input = container.querySelector('input[type="number"]');
        let currentValue = parseInt(input.value);
		
		var stockVal = getStockStatus();
		// cannot be negative value or 0.
        if (!isNaN(currentValue)) {
			// increase quantity only if it is up to max stock available.
			if (currentValue < stockVal) {
            	input.value = currentValue + 1;
			}
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

function getStockStatus() {
    var stockVal = 0;
	// check if the DIV with class .custom-stock does not display 'Out of Stock'
	if ($('.custom-stock:contains("Out of stock")').length == 0) { 
		// get the string that displays the stock
		var stockString = jQuery('.custom-stock').text().trim();
		// return only the value = 2 and not '2 in stock'.
		stockVal = parseInt(stockString.replace(/\D/g, ""));
	}
    return stockVal; // This "spits out" the string
}

jQuery(document).on('input', '.input-number', function(e) {
    //var val = jQuery(this).val();
    var max = getStockStatus();

	// get the input container and the value typed.
	const container = e.target.closest('.input-number');
    const input = container.querySelector('input[type="number"]');
    let val = parseInt(input.value);

    // Example: Check if typed value exceeds stock
    if (max && parseInt(val) > parseInt(max)) {
        alert('You cannot exceed ' + max + ' items.');
        input.value= max; // Force the value back to the limit
		input.dispatchEvent(new Event('change', { bubbles: true })); 
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
