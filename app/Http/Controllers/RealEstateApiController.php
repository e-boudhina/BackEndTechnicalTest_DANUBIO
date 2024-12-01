<?php

namespace App\Http\Controllers;

use App\Models\RealEstate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Nette\Schema\ValidationException;
use Illuminate\Support\Facades\Log;

class RealEstateApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all real estate properties from the database with location as POINT
        $properties = RealEstate::select('*')
            ->selectRaw("ST_AsText(location) as location_text") // Get location as readable text (e.g., POINT(lon lat))
            ->get();

        if ($properties->isEmpty()) {
            return response()->json([
                'message' => 'No properties found.',
                'data' => []
            ], 404);
        }

        // Convert the collection to an array before applying array_map
        $properties = $properties->toArray();

        // Format each property, especially the location field
        $properties = array_map(function ($property) {
            // Check if the location field exists and is not null
            if (isset($property['location_text']) && $property['location_text'] !== null) {
                $locationText = $property['location_text'];

                // If the location is a spatial point (e.g., POINT(lon lat)), extract latitude and longitude
                if (preg_match('/POINT\(([-\d.]+) ([-\d.]+)\)/', $locationText, $matches)) {
                    $property['location'] = [
                        'latitude' => $matches[2], // Latitude
                        'longitude' => $matches[1] // Longitude
                    ];
                } else {
                    // Handle invalid or unexpected location data
                    $property['location'] = null;
                }
            } else {
                // Handle missing location data
                $property['location'] = null;
            }

            // Apply utf8 encoding to each string in the property
            return array_map(function ($value) {
                return is_string($value) ? utf8_encode($value) : $value;
            }, $property);
        }, $properties);

        // Return the response with the properly formatted data
        return response()->json([
            'message' => 'Properties fetched successfully.',
            'data' => $properties
        ], 200);
    }




    /**
     * Store a newly created resource in storage.
     */
    // Store new real estate property
    public function store(Request $request)
    {
        try {
            // Validate input data to ensure 'type' is either 'House' or 'Apartment'
            $validated = $request->validate([
                'type' => 'required|in:House,Apartment', // Only 'House' or 'Apartment' is allowed
                'address' => 'required|string',
                'size' => 'required|numeric', // Size must be numeric
                'size_unit' => 'required|in:SQFT,m2', // Size unit must be either 'SQFT' or 'm2'
                'bedrooms' => 'required|integer',
                'location' => 'required|array', // Ensure 'location' is an array
                'location.lat' => 'required|numeric|between:-90,90', // Validate latitude
                'location.lon' => 'required|numeric| between:-180,180', // Validate longitude
                'price' => 'required|numeric',
            ], [
                    // Custom error messages for validation
                    'type.in' => 'The type must be either "House" or "Apartment".',
                    'size_unit.in' => 'The size unit must be either "SQFT" or "m2".',
            ]);

            // Create a new RealEstate instance
            $property = new RealEstate();
            $property->type = $validated['type'];
            $property->address = $validated['address'];
            $property->size = $validated['size'];
            $property->size_unit = $validated['size_unit'];
            $property->bedrooms = $validated['bedrooms'];
            $property->price = $validated['price'];
            // Set the location as a POINT (longitude, latitude)
            $longitude = $validated['location']['lon'];
            $latitude = $validated['location']['lat'];

            // Use DB::raw to correctly insert the POINT with longitude and latitude
            $property->location = DB::raw('POINT(' . $longitude . ',' . $latitude . ')'.'');

            // Save the property to the database
            $property->save();
            // Return a success response
            return response()->json([
                'message' => 'Property created successfully!',
                'data' => $property
            ], 201
            );

        } catch (\Exception $e) {
            // Return custom error response for validation failure
            return response()->json([
                'Message' => 'Validation failed',
                'errors' => $e->getMessage(),
            ], 422);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    // Update an existing real estate property
    public function update(Request $request, $id)
    {

        // Find the property by ID
        $property = RealEstate::find($id);

        // If not found, return an error response
        if (!$property) {
            return response()->json(['message' => 'Property not found!'], 404);
        }

        // Validate the incoming data
        $validated = $request->validate([
            'type' => 'required|in:House,Apartment',
            'address' => 'required|string',
            'size' => 'required|numeric',
            'bedrooms' => 'required|integer',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        // Update the property with the validated data
        $property->update($validated);

        return response()->json(['message' => 'Property updated successfully!', 'data' => $property]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        // Find the property by ID
        $property = RealEstate::find($id);

        // If not found, return an error response
        if (!$property) {
            return response()->json(['message' => 'Property not found!'], 404);
        }

        // Delete the property
        $property->delete();

        return response()->json(['message' => 'Property deleted successfully!']);
    }

    // Search real estate properties by query parameters
    public function search(Request $request)
    {
        $query = RealEstate::query(); // Start building the query

        // Add conditions based on the search filters

        if ($request->has('type')) {
            $query->where('type', $request->type); // Filter by type (House or Apartment)
        }

        if ($request->has('address')) {
            $query->where('address', 'like', '%' . $request->address . '%'); // Filter by address (partial match)
        }

        $sizeMin = $request->input('size_min');
        $sizeMax = $request->input('size_max');
        $sizeUnit = $request->input('size_unit');

        // Validate size_min and size_max logic
        if ($sizeMin && $sizeMax && $sizeMin > $sizeMax) {
            return response()->json([
                'message' => 'Invalid size range: "min_size" cannot be greater than "max_size". Please fix the values.',
            ], 422);
        }

        // Ensure size_unit is provided if size_min or size_max is sent and validate its value
        if (($sizeMin || $sizeMax) && (!$sizeUnit || !in_array($sizeUnit, ['SQFT', 'm2']))) {
            return response()->json([
                'message' => 'Size unit must be provided and must be either "SQFT" or "m2" when filtering by size.',
            ], 422);
        }

        // Filter by size (interval-based)
        if ($sizeMin) {
            $query->where('size', '>=', $sizeMin);
        }
        if ($sizeMax) {
            $query->where('size', '<=', $sizeMax);
        }
        // Ensure size_unit matches if filtering by size
        if ($sizeUnit) {
            $query->where('size_unit', $sizeUnit);
        }

        if ($request->has('size_unit')) {
            $query->where('size_unit', $request->size_unit); // Filter by size unit (m2 or SQFT)
        }

        if ($request->has('bedrooms')) {
            $query->where('bedrooms', $request->bedrooms); // Filter by the number of bedrooms
        }

        // Validate price_min and price_max logic
        $priceMin = $request->input('price_min');
        $priceMax = $request->input('price_max');

        if ($priceMin && $priceMax && $priceMin > $priceMax) {
            return response()->json([
                'message' => 'Invalid price range: "price_min" cannot be greater than "price_max". Please fix the values.',
            ], 422);
        }

        // Filter by price (interval-based)
        if ($priceMin) {
            $query->where('price', '>=', $priceMin);
        }
        if ($priceMax) {
            $query->where('price', '<=', $priceMax);
        }

        // Query the database and fetch the results
        $properties = $query->select('*')
            ->selectRaw("ST_AsText(location) as location_text") // Get readable location
            ->get();

        // Check if properties exist
        if ($properties->isEmpty()) {
            return response()->json([
                'message' => 'No properties found matching the search criteria.',
                'data' => []
            ], 404);
        }

        // Format the properties
        $properties = $properties->toArray();

        // Format each property and ensure UTF-8 encoding
        $properties = array_map(function ($property) {
            // Ensure the location is correctly parsed
            if (isset($property['location_text']) && $property['location_text'] !== null) {
                $locationText = $property['location_text'];

                // Extract the latitude and longitude
                if (preg_match('/POINT\(([-\d.]+) ([-\d.]+)\)/', $locationText, $matches)) {
                    $property['location'] = [
                        'latitude' => $matches[2], // Latitude
                        'longitude' => $matches[1] // Longitude
                    ];
                } else {
                    $property['location'] = null;
                }
            }

            // Ensure all string values are UTF-8 encoded
            return array_map(function ($value) {
                return is_string($value) ? utf8_encode($value) : $value;
            }, $property);
        }, $properties);

        // Return the response with properly encoded data
        return response()->json([
            'message' => 'Properties found matching the search criteria.',
            'data' => $properties
        ], 200);
    }

    public function searchByLocationAndRadius(Request $request)
    {
        Log::info("Inside ===> searchByLocationAndRadius - Start<===");

        $userLat = $request->input('lat'); // User's latitude
        $userLon = $request->input('lon'); // User's longitude
        $radius = $request->input('radius'); // Radius in kilometers

        //adding basic validation
        // Validate latitude and longitude ranges
        if ($userLat < -90 || $userLat > 90) {
            return response()->json([
                'message' => 'Invalid latitude value. Latitude must be between -90 and 90.',
            ], 400);
        }

        if ($userLon < -180 || $userLon > 180) {
            return response()->json([
                'message' => 'Invalid longitude value. Longitude must be between -180 and 180.',
            ], 400);
        }

        // Convert radius to meters for MySQL query
        $radiusInMeters = $radius * 1000;

        // Query the real_estates table for properties within the specified radius
        $properties = RealEstate::select('*')
            ->selectRaw("ST_AsText(location) as location_text") // Add readable location format
            ->whereRaw("ST_Distance_Sphere(location, POINT(?, ?)) <= ?", [$userLon, $userLat, $radiusInMeters])
            ->get();

        Log::info("test"); // Log it

        if ($properties->isEmpty()) {
            return response()->json([
                'message' => 'No properties found within the specified area.',
                'data' => []
            ], 404);
        }

        // Convert the collection to an array before applying array_map
        $properties = $properties->toArray();

        // Format each property, especially the location field
        $properties = array_map(function ($property) {
            // Check if the location_text field exists and is not null
            if (isset($property['location_text']) && $property['location_text'] !== null) {
                // If the location is a spatial point (e.g., POINT(lon lat)), extract latitude and longitude
                if (preg_match('/POINT\(([-\d.]+) ([-\d.]+)\)/', $property['location_text'], $matches)) {
                    $property['location'] = [
                        'latitude' => $matches[2], // Latitude
                        'longitude' => $matches[1] // Longitude
                    ];
                } else {
                    // Handle invalid or unexpected location data
                    $property['location'] = null;
                }
            } else {
                // Handle missing location data
                $property['location'] = null;
            }

            // Apply utf8 encoding to each string in the property
            return array_map(function ($value) {
                return is_string($value) ? utf8_encode($value) : $value;
            }, $property);
        }, $properties);

        Log::info("Inside ===> searchByLocationAndRadius - E <===");

        // Return the response with the properly encoded data
        return response()->json([
            'message' => 'Properties found within the specified area.',
            'data' => $properties
        ], 200);
    }




}
