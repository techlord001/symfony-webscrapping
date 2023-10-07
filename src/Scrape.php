<?php

declare(strict_types=1);

namespace App;

use Symfony\Component\DomCrawler\Crawler;

require 'vendor/autoload.php';

final class Scrape
{
    private $products = [];

    private function scrapeProducts(Crawler $document): void
    {
        $document = $document->filter('.product')->each(function (Crawler $node) {

            // Determine how many colour variations are available for the product
            $numberOfColourVariations = $node->filter('.product > div > div > div > div > span')->count();

            // Loop through each colour variation
            for ($i=0; $i < $numberOfColourVariations; $i++) { 
                $newProduct = new Product($node, $i);

                $this->products[] = $newProduct->getProduct();
            }

        });
    }

    public function run(): void
    {
        $document = ScrapeHelper::fetchDocument('https://www.magpiehq.com/developer-challenge/smartphones');

        // Check for any pagination
        $pages = $document->filter('#pages > div > a')->count();

        // Start at the first page
        $currentPage = 1;

        // Loop through all pages
        do {
            // Scrape the products
            $this->scrapeProducts($document);

            // Increment the current page
            $currentPage++;

            // If we're at the last page, break the loop
            if ($currentPage > $pages) {
                break;
            }

            // Fetch the next page
            $document = ScrapeHelper::fetchDocument('https://www.magpiehq.com/developer-challenge/smartphones/?page=' . $currentPage);
        } while (true);

        $this->products = ScrapeHelper::removeDuplicates($this->products);

        file_put_contents('output.json', json_encode($this->products, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
    }
}

$scrape = new Scrape();
$scrape->run();
