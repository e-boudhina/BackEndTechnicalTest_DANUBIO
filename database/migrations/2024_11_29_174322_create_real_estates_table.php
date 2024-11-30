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
        Schema::create('real_estates', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['House', 'Apartment']);
            $table->string('address');
            $table->decimal('size', 8, 2); // Store size as a decimal number
            $table->enum('size_unit', ['SQFT', 'm2']); // Store size unit (either SQFT or m2)
            $table->integer('bedrooms');
            $table->decimal('price', 10, 2); // price in your preferred currency

            //Geolocation columns
            $table->point('location')->nullable();
            // adding index to speed up geospatial queries
            $table->index('location', 'location_index');

            //$table->timestamps();

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('real_estates');
    }
};
