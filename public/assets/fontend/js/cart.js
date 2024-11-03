function updateCartUI(cartData) {
    // Update cart count
    updateCartCount(cartData.count);
    updateModalTitle(cartData.count);
    
    // Render cart items and calculate total
    const total = renderCartItems(cartData.items);
   
    // Update cart total
    const cartTotalElement = document.getElementById('cart-total');
    if (cartTotalElement) {
        cartTotalElement.innerText = `£${total.toFixed(2)}`;
        console.log('Total Price displayed:', cartTotalElement.innerText); 
    }
}

function updateCartCount(count) {
    const cartCountElement = document.getElementById('cart-count');
    if (cartCountElement) {
        cartCountElement.innerText = count;
    }
}

function updateModalTitle(count) {
    const modalTitle = document.querySelector('.modal-title');
    if (modalTitle) {
        modalTitle.innerText = `${count} Items in Bag`;
    }
}

function renderCartItems(items) {
    const cartItemsContainer = document.querySelector('.modal-body');
    let total = 0; // Initialize total
    console.log('Cart items data:', items); // Debugging line

    if (cartItemsContainer) {
        cartItemsContainer.innerHTML = ''; // Clear existing items

        items.forEach(item => {
            const itemPrice = parseFloat(item.price);
            const itemQuantity = item.quantity || 1; // Default to 1 if quantity is not defined
            const fixedDiscount = item.discount || 0; // Get any applicable discount
            const effectivePrice = Math.max(0, itemPrice ); // Ensure price does not go below 0
            const itemTotal = effectivePrice ; // Calculate total for this item
            
            console.log(`Item: ${item.name}, Price: £${itemPrice}, Discount: £${fixedDiscount}, Quantity: ${itemQuantity}, Item Total: £${itemTotal}`); // Debugging line
            
            total += itemTotal; // Add to the overall total
            const itemHTML = createCartItemHTML(item, effectivePrice);
            cartItemsContainer.insertAdjacentHTML('beforeend', itemHTML);
        });
    }

    console.log('Calculated Total:', total);
    document.getElementById('cart-total-show').innerHTML=`£${total}`
    return total; // Return calculated total
}


function createCartItemHTML(item, effectivePrice) {
    const featuredImage = item.featured_image || 'default_image_url.jpg';
    const name = item.name || 'Product Name';
    const size = item.size || 'N/A';
    const quantity = item.quantity || 1;
    const price = (effectivePrice).toFixed(2); // Calculate price for the displayed quantity
    const fullImageUrl = `${window.location.origin}/${featuredImage}`;

    return `
        <div class="modal-bag-items">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-5">
                    <div class="modal-bag-image text-center">
                        <img class="img-responsive" src="${fullImageUrl}" alt="${name}" 
                             onerror="this.onerror=null; this.src='default_image_url.jpg';">
                    </div>
                </div>
                <div class="col-lg-6 col-md-3 col-sm-6">
                    <div class="modal-bag-items-details">
                        <div class="item-title">
                            <h6>${name}</h6>
                        </div>
                       
                        <span>Quantity: ${quantity}</span>
                        <span style="color: green;">In Stock</span>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="modal-price">
                        <h6>£${price}</h6>
                    </div>
                </div>
            </div>
        </div>
    `;
}

function updateCartTotal(total) {
    const cartTotalElement = document.getElementById('cart-total');
    if (cartTotalElement) {
        cartTotalElement.innerText = `£${total.toFixed(2)}`; 
        console.log('Total Price displayed:', cartTotalElement.innerText); 
    }
}
