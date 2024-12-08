<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GoogleTestController extends Controller
{
    // Route to get all available routes
    public function getRoutes(Request $request)
    {
        // Validate the input for 'from' and 'to' fields
        $validated = $request->validate([
            'from' => 'required|string', // Changed 'origin' to 'from'
            'to' => 'required|string',   // Changed 'destination' to 'to'
        ]);

        // Define the API endpoint and parameters
        $apiKey = env('GOOGLE_API_KEY'); // Store API key in .env file
        $from = $validated['from'];         // Changed variable name
        $to = $validated['to'];             // Changed variable name

        // Define all the modes we want to check
        $modes = ['driving', 'transit'];
        $travelData = [];

        // Loop through each mode and get the directions
        foreach ($modes as $mode) {
            $response = Http::get("https://maps.googleapis.com/maps/api/directions/json", [
                'origin' => $from, // Use 'from' as the origin
                'destination' => $to, // Use 'to' as the destination
                'mode' => $mode,
                'key' => $apiKey
            ]);

            // Check if the response is successful
            if ($response->failed()) {
                return response()->json([
                    'status' => false,
                    'message' => "Failed to fetch directions for mode: $mode",
                    'error' => $response->body(),
                ], 500);
            }

            // Extract and format the necessary data for each mode
            $modeData = $response->json();

            // Check if the response contains the required data for this mode
            if (isset($modeData['routes'][0]['legs'][0])) {
                // Pass the data to the formatTravelData function
                $formattedModeData = $this->formatTravelData($modeData, $mode, $from, $to);
                // Store the formatted data for each mode
                $travelData[] = $formattedModeData;
            } else {
                // If no valid data is returned for the mode, set N/A for this mode
                $travelData[] = [
                    'travelMode' => ucfirst($mode),
                    'duration' => 'N/A',
                    'distance' => 'N/A'
                ];
            }
        }

        // Return the combined response with the available modes
        return response()->json([
            'status' => true,
            'message' => 'Directions fetched successfully for all modes',
            'data' => $travelData,
        ]);
    }

    /**
     * Format the travel data for each mode.
     */
    private function formatTravelData($modeData, $mode, $from, $to)
    {
        $travelMode = '';
        $duration = '';
        $distance = '';

        // Check the mode type and create the appropriate travel description
        switch ($mode) {
            case 'driving':
            case 'walking':
            case 'bicycling':
                $distance = $modeData['routes'][0]['legs'][0]['distance']['text'];
                $duration = $modeData['routes'][0]['legs'][0]['duration']['text'];
                $travelMode = ucfirst($mode) . " from $from to $to";
                break;

            case 'transit':
                $distance = $modeData['routes'][0]['legs'][0]['distance']['text'];
                $duration = $modeData['routes'][0]['legs'][0]['duration']['text'];
                $travelMode = "Public transit from $from to $to";
                break;

            default:
                $travelMode = "Unknown mode from $from to $to";
                break;
        }

        // Return the formatted travel data
        return [
            'travelMode' => $travelMode,
            'duration' => $duration,
            'distance' => $distance
        ];
    }
}
