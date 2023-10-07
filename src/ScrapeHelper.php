<?php

declare(strict_types=1);

namespace App;

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

final class ScrapeHelper
{
    public static function fetchDocument(string $url): Crawler
    {
        $client = new Client();

        try {
            $response = $client->get($url);
            return new Crawler($response->getBody()->getContents(), $url);
        } catch (\Exception $e) {
            print("Error fetching document: Code " . $e->getCode());
            exit;
        }
    }

    /**
     * Summary of removeDuplicates
     * 
     * Remove duplicates based on the following criteria:
     * - title
     * - price
     * - capacityMB
     * - colour
     * 
     * @param array $products
     * @return array
     */
    public static function removeDuplicates(array $products): array 
    {
        $uniqueProducts = [];
        $seenProducts = [];

        // Iterate through the original array
        foreach ($products as $product) {
            // Define a hash for the current object based on selected keys
            $hash = $product["title"] . $product["price"] . $product["capacityMB"] . $product["colour"];

            // Check if the hash has been seen before, if not add to the unique products array
            if (!in_array($hash, $seenProducts)) {
                $seenProducts[] = $hash;
                $uniqueProducts[] = $product;
            }
        }

        return $uniqueProducts;
    }
}
