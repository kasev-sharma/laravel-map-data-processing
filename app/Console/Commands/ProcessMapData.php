<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ProcessMapData extends Command
{
    protected $signature = 'mapdata:process';
    protected $description = 'Process location and metadata JSON files';

    public function handle()
    {
        // Load JSON files
        $locations = json_decode(Storage::get('locations.json'), true);
        $metadata = json_decode(Storage::get('metadata.json'), true);

        // Merge data based on 'id'
        $mergedData = [];
        foreach ($locations as $loc) {
            foreach ($metadata as $meta) {
                if ($loc['id'] === $meta['id']) {
                    $mergedData[] = array_merge($loc, $meta);
                    break;
                }
            }
        }

        // Count valid points per type
        $typeCount = [];
        $ratings = [];
        $maxReviews = ["reviews" => 0, "location" => null];
        $incompleteData = [];

        foreach ($mergedData as $data) {
            // Count types
            $typeCount[$data['type']] = ($typeCount[$data['type']] ?? 0) + 1;
            
            // Calculate rating averages
            $ratings[$data['type']][] = $data['rating'];

            // Find highest reviews
            if ($data['reviews'] > $maxReviews['reviews']) {
                $maxReviews = ["reviews" => $data['reviews'], "location" => $data];
            }

            // Identify incomplete data
            if (!isset($data['type'], $data['rating'], $data['reviews'])) {
                $incompleteData[] = $data;
            }
        }

        // Calculate average ratings
        $averageRatings = [];
        foreach ($ratings as $type => $ratingList) {
            $averageRatings[$type] = array_sum($ratingList) / count($ratingList);
        }

        // Output results
        $this->info("Valid Points per Type: " . json_encode($typeCount, JSON_PRETTY_PRINT));
        $this->info("Average Ratings per Type: " . json_encode($averageRatings, JSON_PRETTY_PRINT));
        $this->info("Location with Highest Reviews: " . json_encode($maxReviews, JSON_PRETTY_PRINT));
        $this->info("Incomplete Data Entries: " . json_encode($incompleteData, JSON_PRETTY_PRINT));
    }
}
