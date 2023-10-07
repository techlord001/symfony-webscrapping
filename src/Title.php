<?php

declare(strict_types=1);

namespace App;

use Symfony\Component\DomCrawler\Crawler;

/**
 * Class Title
 *
 * Represents the name of a product. This is produced from two elements, the product name and the product capacity.
 *
 * @package App
 */
final class Title
{
    private $title;

    public function __construct(Crawler $node)
    {
        $this->setTitle($node);
    }

    /**
     * Summary of getTitle
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title ?? null;
    }

    /**
     * Summary of setTitle
     * @param \Symfony\Component\DomCrawler\Crawler $node
     * @return void
     */
    private function setTitle(Crawler $node): void
    {
        $this->title = $node->filter('.product-name')->text() . ' ' . $node->filter('.product-capacity')->text();
    }
}