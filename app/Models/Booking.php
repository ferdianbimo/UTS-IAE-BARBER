<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['user_id', 'haircut_id', 'check_in', 'check_out'];  // Correcting to 'haircut_id'

    // Definisikan relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);  // Relasi user dengan booking
    }

    // Definisikan relasi ke Haircut (not 'room')
    public function haircut()
    {
        return $this->belongsTo(Haircut::class);  // Relasi haircut dengan booking
    }
}
