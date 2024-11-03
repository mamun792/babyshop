document.addEventListener('DOMContentLoaded', function() {
    const BASE_URL = '/wishlist/remove'; 
    const wishlistContainer = document.querySelector('.favourites-section');

    wishlistContainer.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-link')) {
            e.preventDefault(); 
            const productId = e.target.getAttribute('data-id'); 
            const itemToRemove = e.target.closest('.favourite-item'); 
            
            // Show loading spinner on the remove link
            showLoadingIndicator(e.target);

            // Remove item from wishlist
            removeFromWishlist(productId, itemToRemove); 
        }
    });

    function showLoadingIndicator(targetElement) {
        // Create spinner element
        const spinner = document.createElement('span');
        spinner.className = 'spinner-border spinner-border-sm'; // Bootstrap spinner class
        targetElement.innerHTML = ''; // Clear the current link text
        targetElement.appendChild(spinner); // Append spinner to the link
        targetElement.style.pointerEvents = 'none'; // Disable clicking on the link
    }

    function removeFromWishlist(productId, itemElement) {
        axios.delete(`${BASE_URL}/${productId}`)
            .then(response => {
                // Successfully removed
                itemElement.classList.add('fade-out'); // Add class for fade-out effect
                setTimeout(() => {
                    itemElement.remove(); // Remove after animation
                    updateWishlistCount(); 
                }, 300); // Match this duration with the CSS transition time
                showNotification('Item removed from wishlist!', 'success');
            })
            .catch(error => {
                // Handle error
                showNotification('Failed to remove item. Please try again.', 'error');
                resetRemoveLink(itemElement.querySelector('.remove-link')); // Reset link
            });
    }

    function resetRemoveLink(removeLink) {
        removeLink.innerHTML = 'Remove'; // Reset link text
        removeLink.style.pointerEvents = 'auto'; // Re-enable clicking
    }

    function updateWishlistCount() {
        const currentCount = document.querySelector('.favourites-section h5 span');
        const countText = currentCount.textContent.match(/(\d+)/); 
        if (countText) {
            const newCount = Math.max(0, parseInt(countText[0]) - 1); 
            currentCount.textContent = `You have ${newCount} / 150 items saved`;
        }
    }

    function showNotification(message, type) {
        Swal.fire({
            icon: type,
            title: message,
            showConfirmButton: false,
            timer: 1500,
            position: 'top-end',
            toast: true,
        });
    }
});

// CSS for fade-out effect

