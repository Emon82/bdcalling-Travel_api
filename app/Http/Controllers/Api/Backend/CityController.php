<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Str;


class CityController extends Controller
{
    public function getCityData($city)
    {
        $apiKey = env('OPEN_MAP_KEY');
        $client = new Client();

        try {
            // Fetch Attractions from OpenTripMap
            $responseAttractions = $client->get("https://api.opentripmap.com/0.1/en/places/geoname?name={$city}&apikey={$apiKey}");
            $attractionsData = json_decode($responseAttractions->getBody(), true);
            
            $popularAttractions = collect($attractionsData['features'] ?? [])
                ->map(fn($place) => $place['properties']['name'] ?? 'Unknown')
                ->toArray();

            // Fetch Description from Wikipedia
            $responseWiki = $client->get("https://en.wikipedia.org/w/api.php?action=query&titles={$city}&prop=extracts&format=json&exintro=true");
            $wikiData = json_decode($responseWiki->getBody(), true);
            $pageData = collect($wikiData['query']['pages'] ?? [])->first();
            $description = $pageData['extract'] ?? 'No description available';


            $description = strip_tags($pageData['extract'] ?? 'No description available');

            // Limit the description to 2 or 3 lines (approx. 300 characters)
            $shortDescription = Str::limit($description, 300, '...');
            return response()->json([
                "city" => $city,
                "description" => strip_tags($shortDescription),  // Remove HTML tags
                "popular_attractions" => $popularAttractions,
                "local_tips" => [
                    "Best time to visit: Spring and Fall",
                    "Use public transport for affordable travel.",
                    "Try local street food and famous restaurants."
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
