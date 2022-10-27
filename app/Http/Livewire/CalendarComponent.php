<?php

namespace App\Http\Livewire;

use App\Mail\ReservationConfirmation;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class CalendarComponent extends Component
{
    public $state = [];
    public $emails;

    public function render()
    {
        $today = Carbon::now();
        $modifiedToday = $today->add(-1, 'day');

        $rooms = Room::all();
        $reservations = Reservation::where('date', '>', $modifiedToday)->get()->map(function ($reservation) {
            $date = $reservation->date->format('Y-m-d');
            $start = $reservation->start_time->format('H:i');
            $end = $reservation->finish_time->format('H:i');
            return [
                'title' => $reservation->room->name,
                'start' => $date .' '. $start,
                'end' => $date .' '. $end,
                'url' => route('reservations.show', $reservation->id),
                'color' => $reservation->room->color,
                'allDay' => false,
            ];
        });

        return view('livewire.calendar-component', compact('rooms', 'reservations', 'modifiedToday'));
    }

    public function close()
    {
        $this->state = null;
        $this->dispatchBrowserEvent('reApplySelect2');
        $this->dispatchBrowserEvent('hide-modal');
    }

    public function addSchedule()
    {
        $data = Validator::make($this->state, [
            'room_id' => 'required|exists:rooms,id',
            'date' => 'required',
            'start_time' => 'required',
            'finish_time' => 'required|after:start_time',
            'remarks' => 'nullable',
        ],[
            'finish_time.after' => 'Finish time must be after start time.',
            'room_id.required' => 'Please select room.',
            'date.after' => 'The date must not later than today.'
            ])->validate();

        $bookDate = $data['date'];
        $room_id = $data['room_id'];
        $start = $data['start_time'];
        $end = $data['finish_time'];

        $conflict = DB::table('reservations')->where(function ($query) use ($bookDate, $room_id, $start, $end) {

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
            session()->flash('error', 'Sorry, The selected schedule is not available!.');
            return;
        }

        $reservation = new Reservation();
        $reservation->user_id = auth()->id();
        $reservation->date = $data['date'];
        $reservation->room_id = $data['room_id'];
        $reservation->start_time = $data['start_time'];
        $reservation->finish_time = $data['finish_time'];
        $reservation->remarks = $data['remarks'] ?? null;
        $reservation->save($data);

        $withCC = $this->emails == null ? 0 : 1;

        if($withCC == 1) {
            $originalText = str_replace(' ', '',$this->emails);
            $email = explode(',', $originalText);
            Mail::to($email)->send(new ReservationConfirmation($reservation));
        }

        $admin = User::all();
        Mail::to($admin)->send(new ReservationConfirmation($reservation));
        Alert::toast('Reservation was successfully created!', 'success');
        $this->close();
        return redirect()->route('dashboard');

    }


}
