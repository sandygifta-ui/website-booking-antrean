<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'table_id',
        'customer_name',
        'phone_number',
        'reservation_date',
        'reservation_time',
        'guest_count'
    ];

    // Relasi ini yang membuat data meja bisa terbaca di admin dan tamu
    public function table()
    {
        return $this->belongsTo(Table::class);
    }
}