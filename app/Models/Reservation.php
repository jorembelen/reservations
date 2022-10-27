<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $dates = ['date', 'start_time', 'finish_time'];

    protected $fillable = [
        'user_id',
        'room_id',
        'date',
        'start_time',
        'finish_time',
        'remarks',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDateFormatAttribute()
    {
        return $this->date->format('M d, Y'). ' ('.$this->start_time->format('h:i') .' - '.$this->finish_time->format('h:i a') .')';
    }

}
