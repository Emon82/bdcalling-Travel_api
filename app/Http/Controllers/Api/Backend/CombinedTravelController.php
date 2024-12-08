<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Http\Controllers\Api\Backend\TravelController;
use App\Http\Controllers\Api\Backend\GoogleTestController;
use Illuminate\Support\Str;


class CombinedTravelController extends Controller
{
    private $travelController;
    private $googleTestController;

    public function __construct(TravelController $travelController, GoogleTestController $googleTestController)
    {
        $this->travelController = $travelController;
        $this->googleTestController = $googleTestController;
    }

    public function getCombinedTravelInfo(Request $request)
    {
        // Validate input data
        $validatedData = $request->validate([
            'from' => 'required|string',
            'to' => 'required|string',
            'date' => 'nullable|date',
        ]);

        $toCity = $validatedData['to'];
        $client = new Client();

        try {
            // Fetch Attractions and Description for the "to" city from OpenTripMap
            $apiKey = env('OPEN_MAP_KEY');

            $responseAttractions = $client->get("https://api.opentripmap.com/0.1/en/places/geoname?name={$toCity}&apikey={$apiKey}");
            $attractionsData = json_decode($responseAttractions->getBody(), true);

            $popularAttractions = collect($attractionsData['features'] ?? [])
                ->map(fn($place) => $place['properties']['name'] ?? 'Unknown')
                ->toArray();

            // Fetch city description from Wikipedia
            $responseWiki = $client->get("https://en.wikipedia.org/w/api.php?action=query&titles={$toCity}&prop=extracts&format=json&exintro=true");
            $wikiData = json_decode($responseWiki->getBody(), true);
            $pageData = collect($wikiData['query']['pages'] ?? [])->first();
            $description = $pageData['extract'] ?? 'No description available';

            // Call TravelController to search flights
            $flightDataResponse = $this->travelController->searchFlights($request);

            // Call GoogleTestController to get travel routes
            $googleRoutesResponse = $this->googleTestController->getRoutes($request);

            // Combine data if both responses are successful
            if ($flightDataResponse->getStatusCode() == 200 && $googleRoutesResponse->getStatusCode() == 200) {
                $combinedData = array_merge(
                    $flightDataResponse->getData(true)['data'],
                    $googleRoutesResponse->getData(true)['data']
                );


            
                $description = strip_tags($pageData['extract'] ?? 'No description available');

                // Limit the description to 2 or 3 lines (approx. 300 characters)
                $shortDescription = Str::limit($description, 300, '...');

                return response()->json([
                    'status' => true,
                    'message' => 'Travel data fetched successfully',
                    'data' => [
                        'combined_travel_data' => $combinedData,

                        'city' => $toCity,
                        'description' => strip_tags($shortDescription),
                        'popular_attractions' => $popularAttractions,
                        'local_tips' => [
                            'Best time to visit: Spring and Fall',
                            'Use public transport for affordable travel.',
                            'Try local street food and famous restaurants.'
                        ],
                    ]
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Failed to fetch travel data from one or more services'
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
