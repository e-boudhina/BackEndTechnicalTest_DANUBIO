<?php

namespace Database\Seeders;

use App\Models\RealEstate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RealEstateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        RealEstate::create([
            'type' => 'House',
            'address' => '10 Downing Street, London, UK',
            'size' => 100.0,
            'size_unit' => 'm2',
            'bedrooms' => 3,
            'price' => 500000.00,
            'location' => DB::raw("ST_GeomFromText('POINT(51.5034 -0.1276)')")
        ]);

        RealEstate::create([
            'type' => 'Apartment',
            'address' => '221B Baker Street, London, UK',
            'size' => 85.0,
            'size_unit' => 'm2',
            'bedrooms' => 2,
            'price' => 400000.00,
            'location' => DB::raw("ST_GeomFromText('POINT(51.5238 -0.1586)')")
        ]);

        RealEstate::create([
            'type' => 'House',
            'address' => '1600 Pennsylvania Avenue, Washington, DC, USA',
            'size' => 300.0,
            'size_unit' => 'm2',
            'bedrooms' => 6,
            'price' => 2000000.00,
            'location' => DB::raw("ST_GeomFromText('POINT(38.8977 -77.0365)')")
        ]);

        RealEstate::create([
            'type' => 'Apartment',
            'address' => '5th Avenue, New York, USA',
            'size' => 75.0,
            'size_unit' => 'm2',
            'bedrooms' => 2,
            'price' => 750000.00,
            'location' => DB::raw("ST_GeomFromText('POINT(40.7757 -73.9653)')")
        ]);

        RealEstate::create([
            'type' => 'House',
            'address' => '742 Evergreen Terrace, Springfield, USA',
            'size' => 120.0,
            'size_unit' => 'm2',
            'bedrooms' => 4,
            'price' => 300000.00,
            'location' => DB::raw("ST_GeomFromText('POINT(39.7817 -89.6501)')")
        ]);

        RealEstate::create([
            'type' => 'Apartment',
            'address' => 'Champs-Élysées, Paris, France',
            'size' => 90.0,
            'size_unit' => 'm2',
            'bedrooms' => 3,
            'price' => 850000.00,
            'location' => DB::raw("ST_GeomFromText('POINT(48.8566 2.3522)')")
        ]);

        RealEstate::create([
            'type' => 'House',
            'address' => 'Schönbrunn Palace, Vienna, Austria',
            'size' => 200.0,
            'size_unit' => 'm2',
            'bedrooms' => 5,
            'price' => 1200000.00,
            'location' => DB::raw("ST_GeomFromText('POINT(48.1844 16.3122)')")
        ]);

        RealEstate::create([
            'type' => 'Apartment',
            'address' => 'Harrods, London, UK',
            'size' => 65.0,
            'size_unit' => 'm2',
            'bedrooms' => 1,
            'price' => 300000.00,
            'location' => DB::raw("ST_GeomFromText('POINT(51.4996 -0.1636)')")
        ]);

        RealEstate::create([
            'type' => 'House',
            'address' => 'Burj Khalifa, Dubai, UAE',
            'size' => 150.0,
            'size_unit' => 'm2',
            'bedrooms' => 4,
            'price' => 1800000.00,
            'location' => DB::raw("ST_GeomFromText('POINT(25.1972 55.2744)')")
        ]);

        RealEstate::create([
            'type' => 'Apartment',
            'address' => 'Shibuya Crossing, Tokyo, Japan',
            'size' => 50.0,
            'size_unit' => 'm2',
            'bedrooms' => 1,
            'price' => 400000.00,
            'location' => DB::raw("ST_GeomFromText('POINT(139.7005 35.6595)')")
        ]);

        RealEstate::create([
            'type' => 'House',
            'address' => '1 Infinite Loop, Cupertino, CA, USA',
            'size' => 2152.0, // SQFT
            'size_unit' => 'SQFT',
            'bedrooms' => 4,
            'price' => 1200000.00,
            'location' => DB::raw("ST_GeomFromText('POINT(-122.0312 37.3318)')")
        ]);

        RealEstate::create([
            'type' => 'Apartment',
            'address' => '1600 Amphitheatre Parkway, Mountain View, CA, USA',
            'size' => 950.0, // SQFT
            'size_unit' => 'SQFT',
            'bedrooms' => 2,
            'price' => 800000.00,
            'location' => DB::raw("ST_GeomFromText('POINT(-122.0841 37.4220)')")
        ]);

        RealEstate::create([
            'type' => 'House',
            'address' => '350 Fifth Avenue, New York, NY, USA',
            'size' => 3000.0, // SQFT
            'size_unit' => 'SQFT',
            'bedrooms' => 5,
            'price' => 2500000.00,
            'location' => DB::raw("ST_GeomFromText('POINT(40.748817 -73.985428)')")
        ]);

        RealEstate::create([
            'type' => 'Apartment',
            'address' => 'Hollywood Boulevard, Los Angeles, CA, USA',
            'size' => 750.0, // SQFT
            'size_unit' => 'SQFT',
            'bedrooms' => 1,
            'price' => 550000.00,
            'location' => DB::raw("ST_GeomFromText('POINT(-118.3269 34.1016)')")
        ]);

        RealEstate::create([
            'type' => 'House',
            'address' => '35 Hudson Yards, New York, NY, USA',
            'size' => 5500.0, // SQFT
            'size_unit' => 'SQFT',
            'bedrooms' => 4,
            'price' => 10000000.00,
            'location' => DB::raw("ST_GeomFromText('POINT(-74.0022 40.7590)')")
        ]);


        RealEstate::create([
            'type' => 'Apartment',
            'address' => 'Fisherman\'s Wharf, San Francisco, CA, USA',
            'size' => 1000.0, // SQFT
            'size_unit' => 'SQFT',
            'bedrooms' => 2,
            'price' => 950000.00,
            'location' => DB::raw("ST_GeomFromText('POINT(-122.4177 37.8080)')")
        ]);

        RealEstate::create([
            'type' => 'House',
            'address' => '10 Ocean Drive, Miami Beach, FL, USA',
            'size' => 3500.0, // SQFT
            'size_unit' => 'SQFT',
            'bedrooms' => 5,
            'price' => 4200000.00,
            'location' => DB::raw("ST_GeomFromText('POINT(25.7651 -80.1399)')")
        ]);

        RealEstate::create([
            'type' => 'Apartment',
            'address' => 'Downtown, Chicago, IL, USA',
            'size' => 950.0, // SQFT
            'size_unit' => 'SQFT',
            'bedrooms' => 2,
            'price' => 600000.00,
            'location' => DB::raw("ST_GeomFromText('POINT(41.8781 -87.6298)')")
        ]);

        RealEstate::create([
            'type' => 'House',
            'address' => 'The Hamptons, Long Island, NY, USA',
            'size' => 5000.0, // SQFT
            'size_unit' => 'SQFT',
            'bedrooms' => 6,
            'price' => 8000000.00,
            'location' => DB::raw("ST_GeomFromText('POINT(40.9634 -72.1848)')")
        ]);

        RealEstate::create([
            'type' => 'Apartment',
            'address' => 'Times Square, New York, NY, USA',
            'size' => 1250.0, // SQFT
            'size_unit' => 'SQFT',
            'bedrooms' => 3,
            'price' => 1200000.00,
            'location' => DB::raw("ST_GeomFromText('POINT(40.7580 -73.9855)')")
        ]);

    }
}
