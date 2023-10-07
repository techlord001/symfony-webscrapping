<?php

declare(strict_types=1);

namespace App;

use Symfony\Component\DomCrawler\Crawler;

/**
 * Class Image
 *
 * Represents the image URL of a product.
 *
 * @package App
 */
final class Image
{
    private $url;

    public function __construct(Crawler $node)
    {
        $this->setUrl($node);
    }

    /**
     * Summary of getUrl
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url ?? null;
    }

    /**
     * Summary of setUrl
     * @param \Symfony\Component\DomCrawler\Crawler $node
     * @return void
     */
    private function setUrl(Crawler $node): void
    {
        $this->url = 'https://www.magpiehq.com/developer-challenge' . ltrim($node->filter('img')->attr('src'), '.') ?? null;
    }
}