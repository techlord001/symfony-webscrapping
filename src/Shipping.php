<?php

declare(strict_types=1);

namespace App;

use Symfony\Component\DomCrawler\Crawler;

/**
 * Class Shipping
 *
 * Represents the shipping text of a product and the date it will be shipped.
 *
 * @package App
 */
final class Shipping
{
    private $text;
    private $date;

    public function __construct(Crawler $node)
    {
        $this->setText($node);
        $this->setDate($node);
    }

    // GETTERS

    /**
     * Summary of getText
     * @return string|null
     */
    public function getText(): ?string
    {
        return $this->text ?? null;
    }

    /**
     * Summary of getDate
     * @return string|null
     */
    public function getDate(): ?string
    {
        return $this->date ?? null;
    }

    // SETTERS

    /**
     * Summary of setText
     * @param \Symfony\Component\DomCrawler\Crawler $node
     * @return void
     */
    private function setText(Crawler $node): void
    {
        if ($node->filter('.product > div > div')->eq(3)->count() === 0) {
            $this->text = null;
        } else {
            $this->text = $node->filter('.product > div > div')->eq(3)->text() ?? null;
        }    
    }
        
    /**
     * Summary of setDate
     * @param \Symfony\Component\DomCrawler\Crawler $node
     * @return void
     */
    private function setDate(Crawler $node): void
    {
        // This code matches dates in the following formats:
        // - 1st Jan
        // - 1st January
        // - 1st Jan 2017
        // - 1st January 2017
        // - 2017-01-01
        // - tomorrow
        $pattern = '/(?:(?:\d{1,2}(?:st|nd|rd|th)?\s+(?:Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec)|\d{4}-\d{2}-\d{2}|tomorrow))\b/';

        if (!$this->getText()) {
            $this->date = '';
        } else if (preg_match($pattern, $node->filter('.product > div > div')->eq(3)->text(), $matches)) {
            $dateTime = strtotime($matches[0]);
            $formattedDate = date('Y-m-d', $dateTime);
            $this->date = $formattedDate;
        }    
    }
}
