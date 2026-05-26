<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $tables = Table::all();
        return view('booking', compact('tables'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'table_id' => 'required|exists:tables,id',
            'customer_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'reservation_date' => 'required|date',
            'reservation_time' => 'required',
        ]);

        Reservation::create([
            'table_id' => $request->table_id,
            'customer_name' => $request->customer_name,
            'phone_number' => $request->phone_number,
            'reservation_date' => $request->reservation_date,
            'reservation_time' => $request->reservation_time,
            'guest_count' => $request->guest_count ?? 1,
        ]);

        return back()->with('success', 'Reservasi meja berhasil disimpan! Data sudah masuk ke admin ✨');
    }
}