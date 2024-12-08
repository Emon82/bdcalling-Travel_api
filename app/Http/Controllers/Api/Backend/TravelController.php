<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class TravelController extends Controller
{
    // Define the IATA code to city name mapping
    private $iataToCity = [
        // Germany
        'BER' => 'Berlin',
        'FRA' => 'Frankfurt',
        'MUC' => 'Munich',
        'HAM' => 'Hamburg',
        'CGN' => 'Cologne',
        'STR' => 'Stuttgart',
        'DUS' => 'Düsseldorf',
        'HAJ' => 'Hannover',
        'LEJ' => 'Leipzig',
        'TXL' => 'Berlin Tegel',
    
        // Bangladesh
        'DAC' => 'Dhaka',
        'CTG' => 'Chittagong',
        'SYL' => 'Sylhet',
        'RJH' => 'Rajshahi',
        'Jess' => 'Jessore',
        'TKR' => 'Tangkura',
    ];

    /**
     * Get the access token from Amadeus API.
     *
     * @return string
     */
    public function getAccessToken()
    {
        if (Cache::has('amadeus_token')) {
            return Cache::get('amadeus_token');
        }

        $response = Http::asForm()->post('https://test.api.amadeus.com/v1/security/oauth2/token', [
            'grant_type' => 'client_credentials',
            'client_id' => env('AMADEUS_CLIENT_ID'),
            'client_secret' => env('AMADEUS_CLIENT_SECRET'),
        ]);

        if ($response->successful()) {
            $tokenData = $response->json();
            $token = $tokenData['access_token'];
            $expiresIn = $tokenData['expires_in'];

            Cache::put('amadeus_token', $token, $expiresIn - 60);

            return $token;
        }

        return response()->json(['error' => 'Failed to retrieve access token'], 500);
    }

    /**
     * Search for flights using the Amadeus API.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchFlights(Request $request)
    {
        $accessToken = $this->getAccessToken();

        // Validate the incoming request
        $validatedData = $request->validate([
            'from' => 'required|string',
            'to' => 'required|string',
            'date' => 'nullable|date',
        ]);

        $date = $validatedData['date'] ?? Carbon::now()->toDateString();

        // Resolve city names to IATA codes
        $originCode = $this->getIataCode($accessToken, $validatedData['from']);
        $destinationCode = $this->getIataCode($accessToken, $validatedData['to']);

        if (!$originCode || !$destinationCode) {
            return response()->json(['error' => 'Failed to resolve city names to IATA codes'], 400);
        }

        // Proceed with flight search
        $response = Http::withToken($accessToken)->post('https://test.api.amadeus.com/v2/shopping/flight-offers', [
            "originDestinations" => [
                [
                    "id" => "1",
                    "originLocationCode" => $originCode,
                    "destinationLocationCode" => $destinationCode,
                    "departureDateTimeRange" => [
                        "date" => $date
                    ]
                ]
            ],
            "travelers" => [
                [
                    "id" => "1",
                    "travelerType" => "ADULT"
                ]
            ],
            "sources" => ["GDS"]
        ]);

        if ($response->successful()) {
            $flights = $response->json();

            $formattedData = [];

            foreach ($flights['data'] as $flight) {
                foreach ($flight['itineraries'] as $itinerary) {
                    foreach ($itinerary['segments'] as $segment) {
                        $formattedData[] = [
                            'travelMode' => 'Flight from ' . $validatedData['from'] . ' to ' . $validatedData['to'],
                            'duration'   => $this->convertDuration($segment['duration']),
                            'price'      => $flight['price']['total'] ?? 'N/A',
                        ];
                    }
                }
            }

            $formattedData = array_slice($formattedData, 0, 2);

            return response()->json([
                'status'  => true,
                'message' => 'Flight offers fetched successfully',
                'data'    => $formattedData,
            ]);
        }

        return response()->json(['error' => 'Failed to retrieve flight offers'], 500);
    }

    /**
     * Resolve city name to IATA code using Amadeus API.
     *
     * @param  string  $accessToken
     * @param  string  $cityName
     * @return string|null
     */
    private function getIataCode($accessToken, $cityName)
    {
        // Check local mapping first
        $iataCode = array_search($cityName, $this->iataToCity);
        if ($iataCode) {
            return $iataCode;
        }

        // Fallback to Amadeus API if not found locally
        $response = Http::withToken($accessToken)->get('https://test.api.amadeus.com/v1/reference-data/locations', [
            'keyword' => $cityName,
            'subType' => 'CITY',
        ]);

        if ($response->successful()) {
            $data = $response->json();
            if (isset($data['data'][0]['iataCode'])) {
                return $data['data'][0]['iataCode'];
            }
        }

        return null;
    }

    /**
     * Convert flight duration from ISO 8601 to a human-readable format.
     *
     * @param  string  $duration
     * @return string
     */
    private function convertDuration($duration)
    {
        preg_match('/PT(?:(\d+)H)?(?:(\d+)M)?/', $duration, $matches);

        $hours = isset($matches[1]) ? $matches[1] : 0;
        $minutes = isset($matches[2]) ? $matches[2] : 0;

        return "{$hours} hours {$minutes} minutes";
    }
}
