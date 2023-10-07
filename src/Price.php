<?php

declare(strict_types=1);

namespace App;

use Symfony\Component\DomCrawler\Crawler;

/**
 * Class Price
 *
 * Represents the price of a product. Currently only works for £ prices.
 *
 * @package App
 */
final class Price
{
    private $price;

    public function __construct(Crawler $node)
    {
        $this->setPrice($node);
    }

    /**
     * Summary of getPrice
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->price ?? null;
    }

    /**
     * Summary of setPrice
     * 
     * Currently only works for £ prices
     * 
     * @param \Symfony\Component\DomCrawler\Crawler $node
     * @return void
     */
    private function setPrice(Crawler $node): void
    {
        $this->price = floatval(str_replace('£', '', $node->filter('.product > div > div')->eq(1)->text())) ?? null;
    }
}