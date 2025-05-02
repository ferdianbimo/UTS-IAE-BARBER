<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHaircutsTable extends Migration
{
    public function up()
    {
        Schema::create('haircuts', function (Blueprint $table) {
            $table->id();
            $table->string('name');  // Nama layanan (Potong rambut, Cukur, dll.)
            $table->text('description');  // Deskripsi layanan
            $table->decimal('price', 8, 2);  // Harga layanan
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('haircuts');
    }
}
