<?php

namespace App\Repositories;

use App\Models\Ticket;

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
}
