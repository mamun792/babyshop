<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
   
public function index(Request $request)
{
    $userId = Auth::id();

  
    $query = Review::with(['product.brand'])
        ->where('user_id', $userId);

    
    if ($request->filled('search')) {
        $searchTerm = $request->search;
        $query->where(function ($q) use ($searchTerm) {
            $q->where('review_text', 'like', "%{$searchTerm}%")
                ->orWhereHas('product', function ($q) use ($searchTerm) {
                    $q->where('name', 'like', "%{$searchTerm}%");
                });
        });
    }

    
    $sortOption = $request->get('sort', 'latest');
    $this->applySorting($query, $sortOption);

  
    $reviews = $query->paginate(10);

    return view('web.dashboard.reviews.index', compact('reviews'));
}

private function applySorting($query, $sortOption)
{
    switch ($sortOption) {
        case 'highest':
            $query->orderBy('rating', 'desc');
            break;
        case 'lowest':
            $query->orderBy('rating', 'asc');
            break;
        default:
            $query->orderBy('created_at', 'desc');
    }
}




    public function edit()
    {
        return view('web.dashboard.reviews.review-edit');
    }

   

    



   

    public function getAllReviews() {
        $reviews = Review::with('user')->get(); 
        return response()->json($reviews);
    }


    public function addReview(Request $request, $productId)
    {
        try {
            // Check if the user is authenticated
            if (!auth()->check()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized. Please log in.'
                ], 401);
            }

            // Validate the incoming request data
            $validator = Validator::make($request->all(), [
                'comment' => 'required|string|max:500',
                'rating' => 'required|integer|between:1,5',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $userId = auth()->id();
            $reviewText = $validator->validated()['comment'];
            $rating = $validator->validated()['rating'];

           
            $product = Product::findOrFail($productId);

           
            $hasPurchased = DB::table('order_items')
                ->join('orders', 'order_items.order_id', '=', 'orders.id')
                ->where('orders.user_id', $userId)
                ->where('order_items.product_id', $productId)
                // ->where('orders.order_status', 'delivered') // Ensure the order is completed
                ->exists();

            Log::info('Has purchased', ['has_purchased' => $hasPurchased]);

            if (!$hasPurchased) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'You cannot review this product as you have not purchased it or the order is not completed.',
                ], 403);
            }

            // Check if the user has already reviewed this product
            $existingReview = Review::where('user_id', $userId)
                ->where('product_id', $productId)
                ->exists();

            Log::info('Existing review', ['existing_review' => $existingReview]);

            if ($existingReview) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'You have already reviewed this product. You cannot review it again.',
                ], 409);
            }

            // Save the review
            $review = Review::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'rating' => $rating,
                'review_text' => $reviewText,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Review added successfully',
                'data' => $review
            ]);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found.',
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An unexpected error occurred.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
    

}
