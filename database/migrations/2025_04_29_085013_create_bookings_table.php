<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // Relasi ke tabel users
            $table->foreignId('haircut_id')->constrained()->onDelete('cascade');  // Relasi ke tabel haircuts
            $table->string('status')->default('pending'); // Status pemesanan (pending, completed, canceled, etc.)
            $table->timestamp('booking_time')->nullable();  // Waktu pemesanan
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
