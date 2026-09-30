<?php

// Filter products by category
function filterProducts(array $products, string $category): array
{
    if ($category === "All") {
        return $products;
    }

    return array_filter(
        $products,
        fn($product) => $product["category"] === $category
    );
}


// Sort products
function sortProducts(array $products, string $sort): array
{
    switch ($sort) {

        case "name":

            usort(
                $products,
                fn($a, $b) => $a["name"] <=> $b["name"]
            );

            break;


        case "price_low":

            usort(
                $products,
                fn($a, $b) => $a["price"] <=> $b["price"]
            );

            break;


        case "price_high":

            usort(
                $products,
                fn($a, $b) => $b["price"] <=> $a["price"]
            );

            break;


        case "rating":

            usort(
                $products,
                fn($a, $b) => $b["rating"] <=> $a["rating"]
            );

            break;


        case "stock":

            usort(
                $products,
                fn($a, $b) => $b["stock"] <=> $a["stock"]
            );

            break;
    }

    return $products;
}


// Calculate average price
function calculateAveragePrice(array $products): float
{
    if (count($products) === 0) {
        return 0;
    }

    $prices = array_column($products, "price");

    return array_sum($prices) / count($prices);
}


// Calculate total stock
function calculateTotalStock(array $products): int
{
    return array_reduce(
        $products,
        fn($total, $product) => $total + $product["stock"],
        0
    );
}


// Calculate average rating
function calculateAverageRating(array $products): float
{
    if (count($products) === 0) {
        return 0;
    }

    $ratings = array_column($products, "rating");

    return array_sum($ratings) / count($ratings);
}


// Get stock status
function getStockStatus(int $stock): string
{
    if ($stock === 0) {
        return "Out of Stock";
    }

    if ($stock <= 5) {
        return "Low Stock";
    }

    return "In Stock";
}


// Display rating stars
function getRatingStars(float $rating): string
{
    $fullStars = (int) round($rating);

    return str_repeat("★", $fullStars)
        . str_repeat("☆", 5 - $fullStars);
}