<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\Country;
use App\Models\Hotel;
use App\Models\Ticket;
use App\Models\Tour_Operator;

class TourController extends Controller
{
    public function get_tour()
    {
        $tours = Tour::all();

        foreach($tours as $tour)
        {
            $tour->country_id = Country::where('id', $tour->country_id)->first();
            $tour->ticket_id = Ticket::where('id', $tour->ticket_id)->first();
            $tour->hotel_id = Hotel::where('id', $tour->hotel_id)->first();
            $tour->tour_operator_id = Tour_Operator::where('id', $tour->tour_operator_id)->first();
        }


        return response()->json($tours);
    }

    public function get_country()
    {
        $countries = Country::all();

        return response()->json($countries);
    }
    
    public function get_hotel()
    {
        $hotels = Hotel::all();
    
        return response()->json($hotels);
    }
    
    public function get_operator()
    {
        $operators = Tour_Operator::all();
    
        return response()->json($operators);
    }

    public function get_ticket()
    {
        $tickets = Ticket::all();
    
        return response()->json($tickets);
    }

    public function search_tour(Request $request)
    {
        $search = $request->input('search');

        if (is_array($search)) {
            $search = implode(',', $search);
        }

        if(is_string($search)) {
            $tours = Tour::where('route', 'like', '%' . $search . '%')->get();

            foreach($tours as $tour)
            {
                $tour->country_id = Country::where('id', $tour->country_id)->first();
                $tour->ticket_id = Ticket::where('id', $tour->ticket_id)->first();
                $tour->hotel_id = Hotel::where('id', $tour->hotel_id)->first();
                $tour->tour_operator_id = Tour_Operator::where('id', $tour->tour_operator_id)->first();
            }

            return response()->json($tours);
        } else {
            return response()->json(['error' => 'Search parameter should be a string'], 400);
        }
    }

    public function get_one_tour($id)
    {
        $tour = Tour::where('id', $id)->first();

        $tour->country_id = Country::where('id', $tour->country_id)->first();
        $tour->ticket_id = Ticket::where('id', $tour->ticket_id)->first();
        $tour->hotel_id = Hotel::where('id', $tour->hotel_id)->first();
        $tour->tour_operator_id = Tour_Operator::where('id', $tour->tour_operator_id)->first();
        
        return response()->json($tour);
    }
}
