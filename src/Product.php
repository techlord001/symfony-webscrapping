<?php

declare(strict_types=1);

namespace App;

use Symfony\Component\DomCrawler\Crawler;

require 'src/UseStatements.php';

/**
 * Class Product
 *
 * Represents a product and its details, including title, price, image, capacity, colour,
 * availability, and shipping information. 
 *
 * @package App
 */
final class Product
{
    private $title;
    private $price;
    private $image;
    private $capacity;
    private $colour;
    private $availability;
    private $shipping;
    private $product;

    public function __construct(Crawler $node, int $colourIndex) 
    {
        $this->title = new Title($node);
        $this->price = new Price($node);
        $this->image = new Image($node);
        $this->capacity = new Capacity($node);
        $this->colour = new Colour($node, $colourIndex);
        $this->availability = new Availability($node);
        $this->shipping = new Shipping($node);
        $this->setProduct();
    }

    /**
     * Summary of getProduct
     * @return array
     */
    public function getProduct(): array
    {
        return $this->product ?? [];
    }

    /**
     * Summary of setProduct
     * @return void
     */
    private function setProduct(): void
    {
        $this->product = [
            'title' => $this->title->getTitle(),
            'price' => $this->price->getPrice(),
            'imageUrl' => $this->image->getUrl(),
            'capacityMB' => $this->capacity->getCapacityMB(),
            'colour' => $this->colour->getColour(),
            'availabilityText' => $this->availability->getText(),
            'isAvailable' => $this->availability->getIsAvailable(),
            'shippingText' => $this->shipping->getText(),
            'shippingDate' => $this->shipping->getDate(),
        ];
    }
}