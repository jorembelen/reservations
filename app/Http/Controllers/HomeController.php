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
        $reservations = Reservation::latest()->get();

        return view('home', compact('rooms', 'reservations', 'modifiedToday'));
    }

    public function index()
    {
        return view('dashboard');
    }
}
