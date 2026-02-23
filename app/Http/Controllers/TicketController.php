<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TicketController extends CrudController
{
    protected function model(): string { return Ticket::class; }
    protected function searchableFields(): array { return ['subject', 'contact_name', 'contact_email']; }

    public function publicCreate(Request $request): JsonResponse
    {
        $item = Ticket::create($this->parseInput($request->all()));
        return response()->json(self::formatItem($item), 201);
    }
}
