<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

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

}
