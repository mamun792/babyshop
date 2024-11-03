<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::latest()->paginate(5);
        return view('web.dashboard.comment.index', compact('comments'));
    }

    public function create()
    {
        return view('web.dashboard.comment.add-comment');
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            toastr()->error('Comment not found');
            return back();
        }

        $validated = $request->validate([
            'name' => 'required|max:255',
        ]);
        $comment->update($validated);
        toastr()->success('Comment updated successfully');
        return back();
    }

    public function delete($id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return response()->json(['success' => false, 'message' => 'Comment not found.'], 404);
        }

        $comment->delete();

        return response()->json(['success' => true, 'message' => 'Comment deleted successfully.']);
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|max:255',

        ]);
        $comment = Comment::create($validated);
        toastr()->success('Comment created successfully');
        return back();
    }


    public function edit($id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            toastr()->error('Comment not found');
            return back();
        }
        return view('web.dashboard.comment.edit-comment', compact('comment'));
    }

    public function toggleStatus(Request $request, $id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
          
            return response()->json(['success' => false, 'message' => 'Comment not found'], 404);
        }

        try {
            $comment->status = $comment->status === 'active' ? 'inactive' : 'active';
            $comment->save();

            return response()->json(['success' => true, 'message' => 'Comment status updated successfully']);
        } catch (\Exception $e) {
           
            return response()->json(['success' => false, 'message' => 'Failed to update comment status'], 500);
        }
    }

    public function getComments()
{
    try {
        $comments = Comment::where('status', 'active')->get(['id', 'name']);

        return response()->json($comments);
    } catch (\Exception $e) {
      
       
        return response()->json(['error' => 'Unable to fetch comments'], 500);
    }
}

}
