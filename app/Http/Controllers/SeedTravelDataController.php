<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TravelData;

class SeedTravelDataController extends Controller
{
    /**
     * Search for travel data based on input parameters.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        try {
            // Retrieve input parameters
            $from = $request->input('from');
            $to = $request->input('to');
            $type = $request->input('type');

            // Log the received parameters for debugging
            \Log::info('Search Parameters:', compact('from', 'to', 'type'));

            // Build the query with filters
            $query = TravelData::query();

            if ($from) {
                $query->where('from', $from);
            }

            if ($to) {
                $query->where('to', $to);
            }

            if ($type) {
                $query->where('type', $type);
            }

            // Execute the query and fetch results
            $results = $query->get();

            // Log the results count for debugging
            \Log::info('Search Results Count: ' . $results->count());

            // Return results or a not found message
            if ($results->isEmpty()) {
                return response()->json(['message' => 'No results found.'], 404);
            }

            return response()->json($results, 200);

        } catch (\Exception $e) {
            // Handle exceptions and log the error
            \Log::error('Search Error: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }
}
