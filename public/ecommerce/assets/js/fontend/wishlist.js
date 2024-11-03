

// Add to wishlist function
async function addToWishlist(productId, buttonElement) {
    try {
        console.log(`Adding to wishlist for product ID: ${productId}`);
        const response = await $.ajax({
            url: `/wishlist/add/${productId}`,
            type: "POST",
        });

      
        // console.log('Response:', response);

        // Handle success response
        if (response.success) {
            // Change the heart icon's state based on whether the product was added or removed
            if (response.added) {
                $(buttonElement).addClass('added'); // Add class to indicate it was added
                $(buttonElement).find('i.fi-rs-heart').addClass('filled'); // Change color to indicate added
                await Swal.fire({
                    title: 'Success!',
                    text: response.message || 'Product added to wishlist!',
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false
                });
            } else {
                $(buttonElement).removeClass('added'); // Remove class to indicate it was removed
                $(buttonElement).find('i.fi-rs-heart').removeClass('filled'); // Change color to indicate removed
                await Swal.fire({
                    title: 'Removed!',
                    text: response.message || 'Product removed from wishlist!',
                    icon: 'info',
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        } else {
            // Check for redirect in case of non-success response
            if (response.redirect) {
                console.log('Redirecting to:', response.redirect);
                window.location.href = response.redirect;
            } else {
                await Swal.fire({
                    title: 'Oops!',
                    text: response.message || 'Something went wrong!',
                    icon: 'info',
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        }
    } catch (error) {
        console.error('Error in addToWishlist:', error);
        if (error.status === 401) {
            const redirectUrl = error.responseJSON?.redirect || '/login'; 
           
            await Swal.fire({
                title: 'Authentication Required',
                text: 'Please log in to continue.',
                icon: 'warning',
                showConfirmButton: false,
                timer: 1000 
            });
            // console.log('Redirecting to:', redirectUrl);
            window.location.href = redirectUrl;
        } else {
            const errorMessage = error.responseJSON?.message || 'Something went wrong! Please try again later.';
            await Swal.fire({
                title: 'Error!',
                text: errorMessage,
                icon: 'error',
                timer: 1500,
                showConfirmButton: false
            });
        }
    }
}



