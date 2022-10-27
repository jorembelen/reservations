<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $today = Carbon::now();
        $modifiedToday = $today->add(-1, 'day');

        $rooms = Room::all();
        $reservations = Reservation::where('date', '>', $modifiedToday)->get()->map(function ($reservation) {
            $date = $reservation->date->format('Y-m-d');
            $start = $reservation->start_time->format('h:i');
            $end = $reservation->finish_time->format('h:i');
            return [
                'title' => $reservation->room->name,
                'start' => $date .' '. $start,
                'end' => $date .' '. $end,
                'url' => route('reservations.show', $reservation->id),
                'color' => $reservation->room->color,
                'allDay' => false,
            ];
        });

        return view('home', compact('rooms', 'reservations', 'modifiedToday'));
    }

    public function index()
    {
        return view('dashboard');
    }
}
