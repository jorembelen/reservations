<?php

namespace App\Http\Livewire;

use App\Mail\ReservationConfirmation;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class ReservationsComponent extends Component
{
    public $reservationId;
    public $emails;
    public $showTable = false;
    public $state = [];
    protected $listeners = ['delete', 'deleteCancelled'];

    public function render()
    {
        $rooms = Room::query()->get();
        $reservations = Reservation::query()->latest()->get();

        return view('livewire.reservations-component', compact('reservations', 'rooms'));
    }

    public function close() 
    {
        $this->dispatchBrowserEvent('showTable');
        $this->dispatchBrowserEvent('hide-modal');
        $this->showTable = false;
        $this->reservationId = null;
        $this->state = null;
        $this->resetValidation();
    }
    
    public function create() 
    {
        $this->showTable = true;
        $this->dispatchBrowserEvent('show-modal');
    }

    public function edit(Reservation $reservation) 
    {
        $this->dispatchBrowserEvent('show-modal');
        $this->showTable = true;
        $this->state = $reservation->toArray();
        $this->state['date'] = $reservation->date->format('Y-m-d');
        $this->state['start_time'] = $reservation->start_time->format('h:i a');
        $this->state['finish_time'] = $reservation->finish_time->format('h:i a');
        $this->reservationId = $reservation->id;
    }

    public function submit($reservationId) 
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
    
            $reservation = $reservationId ? Reservation::find($reservationId) : new Reservation();
            $reservation->user_id = auth()->id();
            $reservation->date = $data['date'];
            $reservation->room_id = $data['room_id'];
            $reservation->start_time = $data['start_time'];
            $reservation->finish_time = $data['finish_time'];
            $reservation->remarks = $data['remarks'] ?? null;
            $reservation->save($data);
    
            $withCC = $this->emails == null ? 0 : 1;
    
            // if($withCC == 1) {
            //     $originalText = str_replace(' ', '',$this->emails);
            //     $email = explode(',', $originalText);
            //     Mail::to($email)->send(new ReservationConfirmation($reservation));
            // }
    
            $admin = User::all();
            // Mail::to($admin)->send(new ReservationConfirmation($reservation));
            $this->close();
    }

    public function getAlert($msg) 
    {
        $this->dispatchBrowserEvent('swal:modal',[
            'type' => 'success',
            'title' => 'Success',
            'text' => $msg
        ]);
        $this->showTable = true;
    }

    public function deleteCancelled()
    {
        $this->showTable = false;
        // $this->dispatchBrowserEvent('showTable');
    }

       /**
     * show confirmation on delete
     *
     * @param  mixed $id
     * @return void
     */
    public function confirmDelete($id)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'message' => 'Are you sure?',
            'text' => 'Are you sure? Please confirm to proceed.',
            'id' => $id
        ]);
    }

    public function delete(Reservation $reservation) 
    {
        $reservation->delete();
        $this->getAlert('Reservation was successfully deleted!', 'success');
        $this->close();
    }

}
