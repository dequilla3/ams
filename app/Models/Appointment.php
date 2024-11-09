<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name',
        'appointment_date',
        'appointment_time',
        'created_by_id',
    ];

    // Define the relationship with the User model (assuming a user can have many appointments)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
