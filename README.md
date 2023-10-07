# Mobile Phone Data Scraper

This project is a web scraper designed to retrieve information about mobile phones from a specific webpage. It makes use of the [Symfony DomCrawler](https://symfony.com/doc/current/components/dom_crawler.html) component to navigate and manipulate the DOM of the webpage, allowing for efficient and effective data extraction.

## Data Structure

The scraper is designed to extract the following data structure for each mobile phone:

```json
{
    "title": "iPhone 11 Pro 64GB",
    "price": 123.45,
    "imageUrl": "https://example.com/image.png",
    "capacityMB": 64000,
    "colour": "red",
    "availabilityText": "In Stock",
    "isAvailable": true,
    "shippingText": "Delivered from 25th March",
    "shippingDate": "2021-03-25"
}
```

## Running the Scraper

To run the scraper, execute the following command:

```bash
php src/Scrape.php
```

This command initiates the scraping process, and the extracted data is stored in a JSON file named `output.json`.

## Code Structure

The project consists of multiple PHP files, each serving a specific purpose in the data extraction process:

- `Scrape.php`: The main file that initiates the scraping process.
- `Product.php`: Represents a product and its details.
- `Availability.php`: Handles the availability text and status of a product.
- `Capacity.php`: Handles the storage capacity of a product.
- `Colour.php`: Handles the colour information of a product.
- `Image.php`: Handles the image URL of a product.
- `Price.php`: Handles the price information of a product.
- `ScrapeHelper.php`: Provides helper functions for the scraping process.
- `Shipping.php`: Handles the shipping information of a product.
- `Title.php`: Handles the title information of a product.

## Dependencies

This project requires the installation of the Symfony DomCrawler component. You can install it via Composer:

```bash
composer require symfony/dom-crawler
```

## Usage

1. Clone this repository to your local machine.
2. Navigate to the project directory.
3. Install the required dependencies using Composer.
4. Run the scraper using the command provided above.
5. Check the `output.json` file for the extracted data.

## Disclaimer

Ensure you have the necessary permissions to scrape the target website, and adhere to its `robots.txt` file and terms of service.

---

Feel free to modify this README to better fit your project's specific needs and details!