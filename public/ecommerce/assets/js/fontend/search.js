
// $(document).ready(function() {
    
//     var productDetailRoute = "{{ route('product-details', ['slug' => ':slug']) }}";

  
//     $('#search').on('keyup', function() {
//         let query = $(this).val();

       
//         if (query.length >= 1) {
//             $.ajax({
//                 url: "{{ route('search.product.suggestions') }}",
//                 type: "GET",
//                 data: {
//                     query: query
//                 },
//                 success: function(data) {
//                     let productList = $('#product-list');
//                     productList.empty(); 


//                     if (data.length > 0) {
//                         data.forEach(product => {
                        
//                             productList.append(
//                                 `<a href="${productDetailRoute.replace(':slug', product.slug)}" class="list-group-item search-item">
//                                     <img src="${product.featured_image}" alt="${product.name}" style="width: 100px; height: 100px; object-fit: cover;">
//                                     <div class="product-info">
//                                         <div class="product-name">${product.name}</div>
//                                         <div class="product-price">৳ ${product.price}</div>
//                                     </div>
//                                 </a>`
//                             );
//                         });

                       
//                         productList.append(
//                             `<a href="{{ route('search.product') }}?name=${query}" class="list-group-item text-center">View all results</a>`
//                         );
//                     } else {
//                         // Show a message if no products are found
//                         productList.append('<p class="list-group-item">No products found</p>');
//                     }
//                 },
//                 error: function(xhr, status, error) {
                   
//                     console.error("Search request failed: ", error);
//                 }
//             });
//         } else {
//             $('#product-list').empty(); 
//         }
//     });
// });



$(document).ready(function () {
    $('#search').on('keyup', function () {
        let query = $(this).val();

        // Only proceed if query length is greater than 1 character
        if (query.length >= 1) {
            $.ajax({
                url: window.productSearchRoute, 
                type: 'GET',
                data: {
                    query: query
                },
                success: function (data) {
                    let productList = $('#product-list');
                    productList.empty(); 

                    if (data.length > 0) {
                        data.forEach(product => {
                            productList.append(
                                `<a href="${window.productDetailRoute.replace(':slug', product.slug)}" class="list-group-item search-item">
                                    <img src="${product.featured_image}" alt="${product.name}" style="width: 50px; height: 50px; object-fit: cover;">
                                    <div class="product-info">
                                        <div class="product-name">${product.name}</div>
                                        <!-- <div class="product-price">৳ ${product.price}</div> -->
                                    </div>
                                </a>`
                            );
                        });

                        // Add "View all results" link at the bottom
                        // productList.append(
                        //     `<a href="{{ route('search.product') }}?name=${query}" class="list-group-item text-center">View all results</a>`
                        // );

                           productList
                            .append(
                                `<a href="${window.productSearchRoutet}?name=${query}" class="list-group-item text-center">View all results</a>`
                            );
                    } else {
                        // Show a message if no products are found
                        productList.append('<p class="list-group-item">No products found</p>');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Search request failed: ', error);
                }
            });
        } else {
            $('#product-list').empty(); 
        }
    });
});
