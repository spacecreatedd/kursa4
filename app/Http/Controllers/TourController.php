<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Tour;

class TourController extends Controller
{
    public function get_tour()
    {
        $user = Auth::user();

        $tours = Tour::all();

        return response()->json($tours);
    }
}
