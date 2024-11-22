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
        Schema::create('weather', function (Blueprint $table) {
            $table->id('increments');
            $table->timestamps();
            $table->timestamp('timestamp_dt')->nullable();
            $table->string('city_name');
            $table->float('min_tmp');
            $table->float('max_tmp');
            $table->float('wind_spd');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weather');
    }
};
