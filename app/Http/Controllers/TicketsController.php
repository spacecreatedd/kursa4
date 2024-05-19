<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Ticket_Owner;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class TicketsController extends Controller
{
    public function get_ticket()
    {
        $user = Auth::user();
    
        $tickets = Ticket_Owner::where('user_id', $user->id)->get();
    
        $ticketDetails = [];
    
        foreach ($tickets as $ticketOwner) {
            $ticket = Ticket::find($ticketOwner->ticket_id);
            if ($ticket) {
                $ticketDetails[] = $ticket;
            }
        }
    
        return response()->json($ticketDetails);
    }

    public function remove_ticket(Request $request, $id)
    {
        $user = Auth::user();
        
        $ticket = Ticket_Owner::where('user_id', $user->id)->where('ticket_id', $id)->first();

        if ($ticket) {
            $ticket->delete();
            return response()->json(['success' => true, 'message' => 'Ticket removed successfully'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Ticket not found'], 404);
        }
    }

    public function add_ticket($id)
    {
        $user = Auth::user();

        Ticket_Owner::create([
            'user_id' => $user->id,
            'ticket_id' => $id
        ]);

        return response([
            'success' => 'added to basket'
        ],201);
    }

    public function get_one_owner($id)
    {
        $user = Auth::user();

        $id = (int)$id;

        $ticket = Ticket_Owner::where('user_id', $user->id)->where('ticket_id', $id)->first();

        return response()->json($ticket);
    }
}
