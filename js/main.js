(function($) {
	"use strict"

	// Mobile Nav toggle
	$('.menu-toggle > a').on('click', function (e) {
		e.preventDefault();
		$('#responsive-nav').toggleClass('active');
	});

	
	// 1. Initialize DOM references (Cache them)
    const selectors = {
		custom_stock_div: $('.custom-stock'),
		add_to_cart_btn: $('form.cart .add-to-cart-btn'),
		qtyInput: $('input.number'),
		numberInput: $('.input-number input'),
		numberInputDiv: $('.input-number')
    };

	/*******************************************************/
	/*************     Cart Section      *******************/
	/*******************************************************/

	// Fix cart dropdown from closing

	$('.cart-dropdown').on('click', function (e) {
		e.stopPropagation();
		//$('.cart-dropdown').addClass('show');
	});
	
	// Clicking the delete X in Cart dropdown DIV
	// for deleting an item.

	jQuery('.cart-dropdown').on('click', '.delete', function(e) {
    e.preventDefault(); // Stop the page from reloading
    e.stopPropagation(); // Keep the dropdown open
 	var isCartPage = jQuery('body').hasClass('woocommerce-cart'); // Check if on main cart page
	// gets the remove url to cart from <a href> in header.php for the delete cart item button.
	// removeURL is set in header.php.  We are only retrieving it here for that item.
    var removeUrl = jQuery(this).attr('href');

    if (removeUrl) {
        // 1. Visually hide the item immediately
		// removes the specific item from cart dropdown.
        jQuery(this).closest('.product-widget').fadeOut();

        // 2. Send the delete request in the background
		// The callback function runs after the response from Cart is received.
		// If on cart page, reload page to update cart.
		// Else refresh the dropdown by AJAX.
		// Then open the dropdown again.

        jQuery.get(removeUrl, function() {
			 if (isCartPage) {
                // On the cart page? Full reload to update totals/shipping
				// This is required by WC, a full reload of page.
                window.location.reload();
            } else {
				// 3. Refresh the cart fragments (header count, list, etc.)
				jQuery(document.body).trigger('wc_fragment_refresh');
				
				// 4. Force the dropdown to stay visible
				//jQuery('.cart-dropdown').addClass('show');
			}
        });
    }
});

	// THIS PART keeps cart dropdown in header open after the HTML is replaced by AJAX
	// if an item is removed or quantity updated in the cart.

	jQuery(document.body).on('removed_from_cart updated_wc_div updated_cart_totals', function() {
		// Re-add the class to the NEWLY created HTML
		//jQuery('.cart-dropdown').addClass('show');
		// This forces the header fragments (dropdown list, count, total) to update
		jQuery(document.body).trigger('wc_fragment_refresh');  
	});
	


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

			/**************************** This does not seem to do anything because it is working fine **************** */
			/* *************************** by checking stock further down for simple products ************************** */
			/******************************* maxStock undefined as well error. ****************************** */
		
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
	// Modify woocommerce form action url for custom Add to Cart button on 
	// Single Product page. It listens to amount change and updates add to cart url and <input type="number" value="1">
	// inside of form with productID and quantity automatically based on user input.
	// <input type="number" value="1"></input>

	var typingTimer;                // Timer identifier
	var doneTypingInterval = 1500;  // Time in ms (1.5 seconds)	
	
	// 1. Listen for changes on the quantity input
    //selectors.numberInput.on('change keyup', function() {
	
	//selectors.numberInput.on('input', function(e) {
	$(document).on('input change', '.input-number input', function() {

		// finds the form in which the input is in.

		var $form = $(this).closest('form');
		console.log('triggered');

		// gets the action url of the form
		
		var currentAction = $form.attr('action');

		// gets the quantity inserted by user in the input field.

        var qty = $(this).val();
		console.log(qty);

		// we are checking whether we are on cart page or Single Product.
		// Otherwise the baseUrl we are constructing for Single Product page 
		// to add to cart will not work as it does not have 'quantity'.
		
		const path = window.location.pathname;		// Result: "/cart/"
		
		if (!path.includes('cart'))  {
			
			// We are on Single Product page. Construct the Add to Cart url with ID and quantity.

			// 1. Remove the existing quantity parameter if it exists
			// This splits at either ?quantity= or &quantity=
		
			var baseUrl = currentAction.split(/([?&]quantity=[^&]*)/)[0];
			
			// 2. Check if the URL already has a '?'
			// If it does, use '&', otherwise use '?'
		
			var separator = baseUrl.indexOf('?') !== -1 ? '&' : '?';

			// 3. Set the new action
		
			var newAction = baseUrl + separator + 'quantity=' + qty;
			console.log(newAction);
			$form.attr('action', newAction);
		
			// Changes the attribute in the DOM for input.
			// Otherwise, add to cart will not consider Qty.
		
			var $input = $form.find('input');
			$input.attr('value', qty);
		}
	 	
		clearTimeout(typingTimer);
				
		// If we are on cart page and the user deletes the quantity before inserting a new one,
		// this will default to 0 immediately and delete the item in cart.
		// Hence, we check if it is not blank before updating cart.
		// We do not this code on Single Product page as user needs to click Enter or the Add to Cart button.

		if (parseInt(qty) && path.includes('cart')) {
		
			// Wait for 1.5s after each keystroke.  After that, run the function doneTyping to update cart.
			// Otherwise, the cart will refresh each time a key is pressed.
    	
			typingTimer = setTimeout(doneTyping, doneTypingInterval);
			console.log('clicking');
			//$("[name='update_cart']").prop("disabled", false).trigger("click");
		}
    });
	
	/*
	selectors.numberInput.on('keyup', function() {
		console.log('keyup');
		clearTimeout(typingTimer);
		if (parseInt (selectors.numberInput.val())) {
    		typingTimer = setTimeout(doneTyping, doneTypingInterval);
		}

	});
	*/

	// Clears the timer each time a key is pressed by user on Cart page 
	// when updating Quantity of item. This is to wait 1.5s again when the key is released,
	// handled above.

	selectors.numberInput.on('keydown', function () {
		console.log('keydown');
    	clearTimeout(typingTimer);
	});
	
	// When user has finished typing in quantity box on cart page after waiting for 1.5s for each keystroke.
	// Update cart automatically without clicking on WC Update Cart button manually.

	function doneTyping () {
		console.log('User finished typing, updating cart...');
		// Trigger the WooCommerce Update Cart button
		jQuery("[name='update_cart']").prop("disabled", false).trigger("click");
	}
	
	


	// seems to be redundant.  similar input event handler above.
	// try to merge. We only need to check stock on Single Product page.
	// On cart, the max value of the quantity input field is already set to max value = stock from Single Product.
	// WC is checking against this max value to limit user input range automatically.

	//jQuery(document).on('input', '.input-number', function(e) {
	selectors.numberInput.on('input', function(e) {
		var max = getStockStatus();

		// get the input container (DIV) and the input. 
		
		const container = e.target.closest('.input-number');
		const input = container.querySelector('input[type="number"]');
		
		// get the value typed in input field.
		var val = $(this).val();

		// Example: Check if typed value exceeds stock
		
		if (max && parseInt(val) > parseInt(max)) {
			alert('You cannot exceed ' + max + ' items.');
			input.value= max; // Force the value back to the limit
			input.dispatchEvent(new Event('change', { bubbles: true })); 
		}
		
		console.log( max);
		//$("[name='update_cart']").prop("disabled", false).trigger("click");
	});

	/*
	$(document).on('input change', '.input-number input', function() {
		//var $form = selectors.numberInput.closest('form');
		console.log('triggered');
		//var currentAction = $form.attr('action');
        var qty = $(this).val();
		console.log("quantity: " . qty);

		const path = window.location.pathname;
		// Result: "/cart/"
		if (!path.includes('cart'))  {
		// 1. Remove the existing quantity parameter if it exists
    	// This splits at either ?quantity= or &quantity=
    	var baseUrl = currentAction.split(/([?&]quantity=[^&]*)/)[0];
		
		// 2. Check if the URL already has a '?'
		// If it does, use '&', otherwise use '?'
		var separator = baseUrl.indexOf('?') !== -1 ? '&' : '?';

		// 3. Set the new action
		var newAction = baseUrl + separator + 'quantity=' + qty;
		console.log(newAction);
		$form.attr('action', newAction);
		}
	 	// Changes the attribute in the DOM for input.
		// Otherwise, add to cart will not consider Qty.
		//var $input = $form.find('input');
   		//$input.attr('value', qty);
		//	console.log('keyup');
		clearTimeout(typingTimer);
		if (parseInt(qty)) {
			
    		typingTimer = setTimeout(doneTyping, doneTypingInterval);
		}
		
		console.log('clicking');
		//$("[name='update_cart']").prop("disabled", false).trigger("click");

    });
	
	*/


	// + or - buttons are clicked on single product page to increase purchase quantity.	
    $(document).on('click', '.qty-up, .qty-down', function(e) {
		if (e.target.classList.contains('qty-up')) {

			const container = e.target.closest('.input-number');
			const input = container.querySelector('input[type="number"]');
			let currentValue = parseInt(input.value);
			var stockVal = getStockStatus();
			// This checks if we are on cart page.
			// If we are, then get the stock from the max value, updated by custom AJAX.
			if (isNaN(stockVal)) stockVal = input.max;
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
		// If we clicked +/- buttons, then update cart by sending update_cart click event to WC.
		// This will recalculate totals and update cart in AJAX.
		// 'update-cart' is the hidden button by WC.  We hid it manually via CSS and automatically clicking it 
		// otherwise client would need to click 'Update Cart' button after modifying cart.  
		$("[name='update_cart']").prop("disabled", false).trigger("click");
	});

	// works only on Single Product page
	// where there is the stock label displayed.
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

	
	//  When the cart is updated on the Cart page either by deleting an item and as a result the totals update,
	//  then invoke the wc_fragment_refresh event to run AJAX function and replace our custom snippets.

	jQuery( document.body ).on( 'removed_from_cart updated_cart_totals', function() {
		// This forces all fragments (header, mini-cart, etc.) to refresh
		jQuery( document.body ).trigger( 'wc_fragment_refresh' );
	});


})(jQuery);
