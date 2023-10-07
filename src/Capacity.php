<?php

declare(strict_types=1);

namespace App;

use Symfony\Component\DomCrawler\Crawler;

/**
 * Class Capacity
 *
 * Represents the storage capacity of a product in megabytes (MB).
 *
 * @package App
 */
final class Capacity
{
    private $capacityMB;

    public function __construct(Crawler $node)
    {
        $this->setCapacityMB($node);
    }

    /**
     * Summary of getCapacityMB
     * @return int|null
     */
    public function getCapacityMB(): ?int
    {
        return $this->capacityMB ?? null;
    }

    /**
     * Summary of setCapacityMB
     * @param \Symfony\Component\DomCrawler\Crawler $node
     * @return void
     */
    private function setCapacityMB(Crawler $node): void
    {
        $capacity = $node->filter('.product-capacity')->text();

        if (stristr($capacity, 'GB')) {
            $this->capacityMB = (int)preg_replace('/GB$/', '', $capacity) * 1000;
        }

        if (stristr($capacity, 'MB')) {
            $this->capacityMB = (int)preg_replace('/MB$/', '', $capacity);
        }
    }
}