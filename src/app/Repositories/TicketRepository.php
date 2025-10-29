<?php

namespace App\Repositories;

use App\Models\Ticket;
use Carbon\Carbon;

class TicketRepository
{
    public function filter($filters)
    {
        $tickets = Ticket::with('customer')->latest();

        if (!empty($filters['email'])) {
            $tickets->whereHas('customer', function ($q) use ($filters) {
                $q->where('email', 'like', "%{$filters['email']}%");
            });
        }

        if (!empty($filters['phone'])) {
            $tickets->whereHas('customer', function ($q) use ($filters) {
                $q->where('phone', 'like', "%{$filters['phone']}%");
            });
        }

        if (!empty($filters['status'])) {
            $tickets->where('status', $filters['status']);
        }

        if (!empty($filters['from']) && !empty($filters['to'])) {
            $tickets->whereBetween('created_at', [$filters['from'], $filters['to']]);
        }

        return $tickets->paginate(10);
    }
    public function getStatistics()
    {

        $todayCount = Ticket::whereDate('created_at', Carbon::today())->count();
        $weekCount = Ticket::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $monthCount = Ticket::whereMonth('created_at', Carbon::now()->month)->count();
        return [
            'today' => $todayCount,
            'week' => $weekCount,
            'month' => $monthCount,
        ];
    }
}
