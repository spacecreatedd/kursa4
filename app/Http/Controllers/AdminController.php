<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Country;
use App\Models\Hotel;
use App\Models\Ticket;
use App\Models\Tour_Operator;
use App\Models\Tour;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    public function createCountry(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized. Not admin'], 403);
        }

        $request->validate([
            'name' => 'required|string',
            'vise' => 'required|string',
        ]);

        $country = Country::create([
            'name' => $request->name,
            'vise' => $request->vise,
        ]);

        return response()->json(['message' => 'Country created successfully', 'data' => $country], 201);
    }

    public function createHotel(Request $request){
        $user = Auth::user();

        if ($user->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized. Not admin'], 403);
        }


        $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'info' => 'required|string',
        ]);

        $hotel = Hotel::create([
            'name' =>  $request->name,
            'address' =>  $request->address,
            'info' =>  $request->info,
        ]);

        return response()->json(['message' => 'Hotel created successfully', 'data' => $hotel], 201);
    }

    public function createTicket(Request $request){
        $user = Auth::user();

        if ($user->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized. Not admin'], 403);
        }


        $request->validate([
            'name' => 'required|string',
            'date' => 'required|date',
            'place' => 'required|string',
        ]);

        $ticket = Ticket::create([
            'name' =>  $request->name,
            'date' =>  $request->date,
            'place' =>  $request->place,
        ]);

        return response()->json(['message' => 'Ticket created successfully', 'data' => $ticket], 201);
    }

    public function createTourOperator(Request $request)
    {
        try {
            $user = Auth::user();
    
            if ($user->role !== 'admin') {
                return response()->json(['error' => 'Unauthorized. Not admin'], 403);
            }
    
            $validatedData = $request->validate([
                'name' => 'required|string',
                'surname' => 'required|string',
                'patronym' => 'required|string',
                'contacts' => 'required|string',
            ]);
    
            $tourOperator = Tour_Operator::create([
                'name' => $validatedData['name'],
                'surname' => $validatedData['surname'],
                'patronym' => $validatedData['patronym'],
                'contacts' => $validatedData['contacts'],
            ]);
    
            return response()->json(['message' => 'Tour operator created successfully', 'data' => $tourOperator], 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    public function createTour(Request $request)
    {
        try {
            $user = Auth::user();
    
            if ($user->role !== 'admin') {
                return response()->json(['error' => 'Unauthorized. Not admin'], 403);
            }
    
            $request->validate([
                'country_id' => 'required|integer',
                'route' => 'required|string',
                'ticket_id' => 'required|integer',
                'description' => 'required|string',
                'tour_operator_id' => 'required|integer',
                'hotel_id' => 'required|integer',
                'img' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);
    
            $imagePath = $request->file('img')->store('public/images/products');
    
            $imagePath = str_replace('public/', '', $imagePath);
    
            $tour = Tour::create([
                'country_id' =>  $request->country_id,
                'route' =>  $request->route,
                'ticket_id' =>  $request->ticket_id,
                'description' =>  $request->description,
                'tour_operator_id' =>  $request->tour_operator_id,
                'hotel_id' =>  $request->hotel_id,
                'img' =>  $imagePath
            ]);
    
            return response()->json(['message' => 'Tour created successfully', 'data' => $tour], 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }


    public function get_country()
    {
        $countries = Country::all();

        return response()->json($countries);
    }
    
    public function get_ticket()
    {
        $tickets = Ticket::all();

        return response()->json($tickets);
    }
    
    public function get_hotel()
    {
        $hotels = Hotel::all();
    
        return response()->json($hotels);
    }

    public function get_tour_operators()
    {
        $operators = Tour_Operator::all();

        return response()->json($operators);
    }
}
