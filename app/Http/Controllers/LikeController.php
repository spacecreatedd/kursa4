<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Tour;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LikeController extends Controller
{
    public function get_like()
    {
        $user = Auth::user();

        $likes = Like::where('user_id', $user->id)->get();
        
        return response()->json($likes);
    }

    public function add_like($id)
    {
        $user = Auth::user();

        Like::create([
            'user_id' => $user->id,
            'tour_id' => $id
        ]);


        return response()->json(['success' => true, 'message' => 'Like added successfully'], 200);
    }

    public function remove_like($id)
    {
        $user = Auth::user();
        $like = Like::where('user_id', $user->id)->where('id', $id)->first();

        if ($like) {
            $like->delete();
            return response()->json(['success' => true, 'message' => 'Like removed successfully'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Like not found'], 404);
        }
    }
}
