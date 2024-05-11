<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Ticket__owner;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class TicketsController extends Controller
{
    public function get_ticket()
    {
        $user = Auth::user();
    
        $tickets = Ticket__owner::where('user_id', $user->id)->get();
    
        $ticketDetails = [];
    
        foreach ($tickets as $ticketOwner) {
            $ticket = Ticket::find($ticketOwner->ticket_id);
            if ($ticket) {
                $ticketDetails[] = $ticket;
            }
        }
    
        Log::info('User tickets: ' . json_encode($ticketDetails));
    
        return response()->json($ticketDetails);
    }

    public function remove_ticket(Request $request, $id)
    {
        $user = Auth::user();
        $ticket = Ticket__owner::where('user_id', $user->id)->where('id', $id)->first();

        if ($ticket) {
            $ticket->delete();
            return response()->json(['success' => true, 'message' => 'Ticket removed successfully'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Ticket not found'], 404);
        }
    }

    public function add_ticket(Request $request, $id)
    {
        $user = Auth::user();

        Ticket__owner::create([
            'user_id' => $user->id,
            'ticket_id' => $id
        ]);

        return response([
            'success' => 'added to basket'
        ],201);
    }
}
