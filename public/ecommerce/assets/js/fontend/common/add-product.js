  // Handle color selection and update the displayed color name
  document.querySelectorAll('.color-ball').forEach(function(colorBall) {
    colorBall.addEventListener('click', function() {
        let color = this.getAttribute('data-color');


        document.getElementById('selectedColor').innerText = color;


        document.querySelectorAll('.color-ball').forEach(function(ball) {
            ball.classList.remove('active');
        });


        this.classList.add('active');
    });
});





function showSnackbar() {
    const snackbar = document.getElementById("snackbar");
    snackbar.className = "snackbar show";
    setTimeout(() => {
        snackbar.className = snackbar.className.replace("show", "");
    }, 3000); // Auto-hide after 3 seconds
}

function showInlineNotification(message, color = 'red') {
    // Create notification element
    const notificationArea = document.getElementById("notification-area");
    notificationArea.textContent = message;
    notificationArea.style.color = color;
    notificationArea.classList.add('show');


    setTimeout(() => {
        notification.style.opacity = '0';
        setTimeout(() => {
            notification.remove();
        }, 500);
    }, 3000);
}




function addToBag(productId) {
    // Get selected color
    const selectedColorElement = document.querySelector('.color-ball.active');
    const selectedColor = selectedColorElement ? {
        id: selectedColorElement.getAttribute('data-id')
    } : null;

    // Get selected size
    const sizeSelect = document.querySelector('#sizeSelect');
    const selectedSizeOption = sizeSelect && sizeSelect.options[sizeSelect.selectedIndex];
    const selectedSize = selectedSizeOption && selectedSizeOption.value !== 'Choose Size' ? {
        id: selectedSizeOption.getAttribute('data-id'),
    } : null;

    // Default values
    const quantity = 1;
    const campaignId = {{ json_encode(optional($product->campaigns->first())->id ?? null) }};
    const isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};

    // Check if user is logged in
    if (!isLoggedIn) {
        window.location.href = "{{ route('login') }}";
        return;
    }

    // Determine if attributes are available
    const hasColorAttribute = document.querySelector('.color-ball') !== null;
    const hasSizeAttribute = document.querySelector('#sizeSelect') !== null;
    console.log('Available attributes: Size -', hasSizeAttribute);
    console.log('Available attributes: Color -', hasColorAttribute);

    // Determine if attributes are available only if they exist
    if ((hasColorAttribute && (selectedColor === null || selectedColor === '')) &&
        (hasSizeAttribute && (selectedSize === null || selectedSize === ''))) {
        showInlineNotification('Please select at least one attribute: color or size.', 'red');
        return;
    }




    // Prepare the data object
    const data = {
        product_id: productId,
        quantity: quantity,
        campaign_id: campaignId,
        attributes: {
            color: selectedColor,
            size: selectedSize,
        },
    };

    // Small loader adjustment
    const addToBagButton = document.getElementById('addToBag');

    // Change button state to loading
    addToBagButton.innerText = 'Adding...'; // Loading text
    addToBagButton.style.backgroundColor = '#ccc'; // Lighter background
    addToBagButton.style.color = '#000'; // Dark text color
    addToBagButton.style.cursor = 'not-allowed'; // Not clickable
    addToBagButton.style.pointerEvents = 'none'; // Disable pointer events

    // Axios POST request to add item to the bag
        axios.post('/cart/add', data)
            .then(response => {
                // Handle success response
                console.log('Product added to cart:', response.data);
                showSnackbar(); // Show snackbar notification
                showInlineNotification('Your product has been added to the bag.');

                addToBagButton.innerText = 'Added to Bag';
                addToBagButton.style.backgroundColor = '#000'; // Black background
                addToBagButton.style.color = '#fff'; // White text color
                addToBagButton.disabled = true; // Disable button to prevent further clicks
            })
            .catch(error => {
                // Handle error response
                console.error('Error adding product to cart:', error);
                alert('There was an error adding the product. Please try again.');

                // Reset button state in case of error
                addToBagButton.innerText = 'Add to Bag'; // Reset text
                addToBagButton.style.backgroundColor = '#fff'; // Reset background
                addToBagButton.style.color = '#000'; // Reset text color
                addToBagButton.style.cursor = 'pointer'; // Reset cursor
                addToBagButton.style.pointerEvents = 'all'; // Re-enable pointer events
            });
    }
