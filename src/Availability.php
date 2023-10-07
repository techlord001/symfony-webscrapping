<?php

declare(strict_types=1);

namespace App;

use Symfony\Component\DomCrawler\Crawler;

/**
 * Class Availability
 *
 * Represents the availability text of a product and whether or not it is available.
 *
 * @package App
 */
final class Availability
{
    private $text;
    private $isAvailable;

    public function __construct(Crawler $node)
    {
        $this->setText($node);
        $this->setIsAvailable($node);
    }

    // GETTERS

    /**
     * Summary of getText
     * @return array|string|null
     */
    public function getText(): ?string
    {
        return $this->text ?? null;
    }

    /**
     * Summary of getIsAvailable
     * @return bool|null
     */
    public function getIsAvailable(): ?bool
    {
        return $this->isAvailable ?? null;
    }

    // SETTERS

    /**
     * Summary of setText
     * 
     * Checks for the string "Availability: " and removes it, returning the rest of the string.
     * 
     * @param \Symfony\Component\DomCrawler\Crawler $node
     * @return void
     */
    private function setText(Crawler $node): void
    {
        $this->text = preg_replace('/^Availability:\s+/', '', $node->filter('.product > div > div')->eq(2)->text()) ?? null;
    }

    /**
     * Summary of setIsAvailable
     * 
     * Checks for the string "In Stock" and returns true if found, false if not.
     * 
     * @param \Symfony\Component\DomCrawler\Crawler $node
     * @return void
     */
    private function setIsAvailable(Crawler $node): void
    {
        $this->isAvailable = preg_match('/\bIn Stock\b/i', $node->filter('.product > div > div')->eq(2)->text()) ? true : false;
    }
}