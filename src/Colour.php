<?php

declare(strict_types=1);

namespace App;

use Symfony\Component\DomCrawler\Crawler;

/**
 * Class Colour
 *
 * Represents the colour of a product. Set the colour based on a proivded index.
 *
 * @package App
 */
final class Colour
{
    private $colour;

    public function __construct(Crawler $node, int $colourIndex)
    {
        $this->setColour($node, $colourIndex);
    }

    /**
     * Summary of getColour
     * @return string|null
     */
    public function getColour(): ?string
    {
        return $this->colour ?? null;
    }

    /**
     * Summary of setColour
     * 
     * @param \Symfony\Component\DomCrawler\Crawler $node
     * @param int $colourIndex
     * @return void
     */
    private function setColour(Crawler $node, int $colourIndex): void
    {
        $this->colour = $node->filter('.product > div > div > div > div > span')->eq($colourIndex)->attr('data-colour') ?? null;

    }
}