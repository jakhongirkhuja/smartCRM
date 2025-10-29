<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Ticket;

class TicketService
{
    public function create($data)
    {
        $customer = Customer::firstOrCreate(
            ['email' => $data['email']],
            ['name' => $data['name'], 'phone' => $data['phone']]
        );

        $ticket = $customer->tickets()->create([
            'theme' => $data['subject'],
            'message' => $data['message'],
        ]);

        if (isset($data['files'])) {
            foreach ($data['files'] as $file) {
                $ticket->addMedia($file)->toMediaCollection();
            }
        }

        return $ticket;
    }
}
