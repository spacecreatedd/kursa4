<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comparison;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ComparisonController extends Controller
{
    public function get_comparison()
    {
        $user = Auth::user();

        $comparisons = Comparison::where('user_id', $user->id)->get();

        Log::info('User comparisons: ' . json_encode($comparisons));

        return response()->json($comparisons);
    }

    public function remove_comparison(Request $request, $id)
    {
        $user = Auth::user();

        $id = (int)$id;
        
        $comparison = Comparison::where('user_id', $user->id)->where('tour_id', $id)->first();

        if ($comparison) {
            $comparison->delete();
            return response()->json(['success' => true, 'message' => 'Comparison removed successfully'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Comparison not found'], 404);
        }
    }

    public function add_comparison(Request $request, $id)
    {
        $user = Auth::user();

        Comparison::create([
            'user_id' => $user->id,
            'tour_id' => $id
        ]);

        return response()->json(['success' => true, 'message' => 'Comparison added successfully'], 201);
    }

    public function get_one_comparison($id)
    {
        $user = Auth::user();

        $comparison = Comparison::where('user_id', $user->id)->where('tour_id', $id)->first();

        return response()->json($comparison);
    }
}
