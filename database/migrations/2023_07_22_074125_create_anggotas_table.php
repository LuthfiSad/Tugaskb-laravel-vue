<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('anggotas', function (Blueprint $table) {
            $table->id();
            $table->String('name');
            $table->String('nim')->unique();
            $table->String('no_hp')->nullable();
            $table->String('email')->unique();
            $table->unsignedBigInteger('id_angkatan');
            $table->foreign('id_angkatan')->references('id')->on('angkatans')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggotas');
    }
};
