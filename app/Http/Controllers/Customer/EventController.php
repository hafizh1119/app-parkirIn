<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('is_active', true)
            ->where('status', 'active')
            ->orderBy('start_date', 'desc')
            ->paginate(9);

        return view('customers.events', compact('events'));
    }
}