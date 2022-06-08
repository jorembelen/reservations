<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationStoreRequest;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;
use App\Notifications\AdminNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::all();
        $reservations = Reservation::all();

        return view('reservations.index', compact('reservations', 'rooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReservationStoreRequest $request)
    {
        $greetings = "";
        date_default_timezone_set('Asia/Riyadh');

        /* This sets the $time variable to the current hour in the 24 hour clock format */
        $time = date("H");

        /* Set the $timezone variable to become the current timezone */
        $timezone = date("e");

        /* If the time is less than 1200 hours, show good morning */
        if ($time < "12") {
            $greetings = "Good Morning!";
        } else

        /* If the time is grater than or equal to 1200 hours, but less than 1700 hours, so good afternoon */
        if ($time >= "12" && $time < "17") {
            $greetings = "Good Afternoon!";
        } else

        /* Should the time be between or equal to 1700 and 1900 hours, show good evening */
        if ($time >= "17" && $time < "19") {
            $greetings = "Good Evening!";
        } else

        /* Finally, show good night if the time is greater than or equal to 1900 hours */
        if ($time >= "19") {
            $greetings = "Good Night!";
        }

        $bookDate = $request->date;
        $room_id = $request->room_id;
        $start = $request->start_time;
        $end = $request->finish_time;

        $today = Carbon::now();
        $modifiedToday = $today->add(-1, 'day');

     if($request->date <= $modifiedToday){
        Alert::error('Error', 'Sorry, schedule date should not less than today!');
        return redirect()->back();
     } else {
        $conflict = \DB::table('reservations')->where(function ($query) use ($bookDate, $room_id, $start, $end) {

            $query->where(function ($q) use ($bookDate, $room_id, $start, $end) {
                $q->where('start_time', '>=', $start)
                   ->where('finish_time', '<', $end)
                   ->where('date',  $bookDate)
                   ->where('room_id',  $room_id);

            })->orWhere(function ($q) use ($bookDate, $room_id, $start, $end) {
                $q->where('start_time', '<=', $start)
                   ->where('finish_time', '>', $end)
                   ->where('date',  $bookDate)
                   ->where('room_id',  $room_id);

            })->orWhere(function ($q) use ($bookDate, $room_id, $start, $end) {
                $q->where('finish_time', '>', $start)
                   ->where('finish_time', '<=', $end)
                   ->where('date',  $bookDate)
                   ->where('room_id',  $room_id);

            })->orWhere(function ($q) use ($bookDate, $room_id, $start, $end) {
                $q->where('start_time', '>=', $start)
                   ->where('finish_time', '<=', $end)
                   ->where('date',  $bookDate)
                   ->where('room_id',  $room_id);
            });

        })->exists();
        if ($conflict) {
            Alert::error('Error', 'Sorry, selected schedule is not available!.');
            return redirect()->back();
        }
     }

     $creator = 'Reserved by: ' .auth()->user()->name;
     $location = 'Facility: ' .Room::find($request->room_id)->name;
     $schedule = 'Reserved on: '.date('M-d-Y', strtotime($request->date)).', '.date('h:i A', strtotime($request->start_time)).' to '.date('h:i A', strtotime($request->finish_time));
     $notes = 'Meeting Description: '.$request->remarks;

     $admin = User::whererole(1)->get();
    //  $admin = User::all();
     $user = auth()->user();

         $details = [
             'greeting' => $greetings,
             'body' => 'Your reservation was successfully created as per details below.',
             'user' =>  $creator,
             'location' =>  $location,
             'schedule' =>  $schedule,
             'notes' =>  $notes,
         ];

         $adminDetails = [
             'greeting' => $greetings,
             'body' => 'New reservation was created. Please check the details below.',
             'user' =>  $creator,
             'location' =>  $location,
             'schedule' =>  $schedule,
             'notes' =>  $notes,
         ];

        Reservation::create($request->all());
        Alert::toast('Reservation was created successfully!', 'success');

        \Notification::send($admin, new AdminNotification($adminDetails));

       return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reservation = Reservation::findOrFail($id);

        return view('reservations.view', compact('reservation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rooms = Room::all();
        $reservation = Reservation::findOrFail($id);

        return view('reservations.edit', compact('reservation', 'rooms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReservationStoreRequest $request, $id)
    {
        $data = $request->all();
        $client = Reservation::findOrFail($id);
        $client->update($data);

        Alert::toast('Client was successfully updated!', 'success');

        return redirect('/reservations');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        Alert::success('Success', 'Reservation was successfully deleted!');

        return back();
    }
}
