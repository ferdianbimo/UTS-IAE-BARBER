<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Haircut;
use App\Models\User;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // Membuat pemesanan baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'haircut_id' => 'required|exists:haircuts,id',
            'booking_time' => 'required|date',
            'status' => 'required|string|in:pending,completed,canceled',
        ]);
    
        try {
            // Membuat booking baru
            $booking = Booking::create($data);
            return response()->json($booking, 201);  // Status code 201 Created
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while processing the request.',
                'error' => $e->getMessage()
            ], 500);  // Status code 500 Internal Server Error
        }
    }
    
    // Mengambil daftar semua pemesanan
    public function index()
    {
        $bookings = Booking::with(['user', 'haircut'])->get();  // Mengambil semua data pemesanan dengan relasi user dan layanan
        return response()->json($bookings);
    }

    // Mengambil data pemesanan berdasarkan ID
    public function show($id)
    {
        $booking = Booking::with(['user', 'haircut'])->find($id);  // Mencari pemesanan berdasarkan ID

        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);  // Status code 404 Not Found
        }

        return response()->json($booking);
    }

    // Mengupdate status pemesanan
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'status' => 'required|string|in:pending,completed,canceled', // Validasi status pemesanan
        ]);

        $booking = Booking::findOrFail($id); // Mencari pemesanan berdasarkan ID
        $booking->update($data);

        return response()->json($booking);
    }

    // Menghapus pemesanan
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id); // Mencari pemesanan berdasarkan ID
        $booking->delete();

        return response()->json(['message' => 'Booking deleted successfully']);
    }
}
