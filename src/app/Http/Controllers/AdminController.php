<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatusEditRequest;
use App\Models\Ticket;
use App\Repositories\TicketRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct(protected TicketRepository $tickets) {}
    public function tickets(Request $request)
    {
        $data = $this->tickets->filter($request->only(['email', 'phone', 'status', 'from', 'to']));
        return view('admin.tickets', ['tickets' => $data]);
    }
    public function ticketEach($id)
    {
        $ticket = Ticket::with('customer')->findOrFail($id);
        return view('admin.tickets_show', compact('ticket'));
    }
    public function ticketStatus(StatusEditRequest $request, Ticket $ticket)
    {

        $ticket->update([
            'status' => $request->status,
            'responded_at' => Carbon::now(),
            'manager_id' => Auth::id()
        ]);
        return back()->with('success', 'Статус обновлён');
    }
    public function statistics()
    {
        return view('admin.statistics');
    }
}
