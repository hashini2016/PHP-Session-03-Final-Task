<?php

// Browser open use this link:
// http://localhost/PHP-Session-03-Final-Task/catalogue.php?category=All&sort=price_low

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include files
require_once "data/products.php";
require_once "functions/catalogue.php";


// Get selected category
$category = $_GET["category"] ?? "All";


// Get selected sorting option
$sort = $_GET["sort"] ?? "name";


// Filter products
$filteredProducts = filterProducts(
    $products,
    $category
);


// Sort products
$filteredProducts = sortProducts(
    $filteredProducts,
    $sort
);

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Product Catalogue</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f5f5f5;
        }

        h1 {
            color: #333;
        }

        h2 {
            margin-top: 30px;
        }

        form {
            background-color: white;
            padding: 20px;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            margin-right: 5px;
        }

        select {
            padding: 8px;
            margin-right: 20px;
        }

        button {
            padding: 8px 15px;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
        }

        th {
            background-color: #333;
            color: white;
            padding: 12px;
        }

        td {
            border: 1px solid #ddd;
            padding: 10px;
        }

        .statistics {
            background-color: white;
            padding: 20px;
        }

    </style>

</head>


<body>


<h1>
    University Bookstore - Product Catalogue
</h1>


<!-- Filter and Sort Form -->

<form method="GET">


    <label for="category">
        Category:
    </label>


    <select name="category" id="category">

        <option value="All"
            <?= $category === "All" ? "selected" : "" ?>>
            All
        </option>


        <option value="Books"
            <?= $category === "Books" ? "selected" : "" ?>>
            Books
        </option>


        <option value="Electronics"
            <?= $category === "Electronics" ? "selected" : "" ?>>
            Electronics
        </option>


        <option value="Stationery"
            <?= $category === "Stationery" ? "selected" : "" ?>>
            Stationery
        </option>

    </select>


    <label for="sort">
        Sort By:
    </label>


    <select name="sort" id="sort">


        <option value="name"
            <?= $sort === "name" ? "selected" : "" ?>>
            Name
        </option>


        <option value="price_low"
            <?= $sort === "price_low" ? "selected" : "" ?>>
            Price - Low to High
        </option>


        <option value="price_high"
            <?= $sort === "price_high" ? "selected" : "" ?>>
            Price - High to Low
        </option>


        <option value="rating"
            <?= $sort === "rating" ? "selected" : "" ?>>
            Rating
        </option>


        <option value="stock"
            <?= $sort === "stock" ? "selected" : "" ?>>
            Stock
        </option>


    </select>


    <button type="submit">
        Apply
    </button>


</form>



<!-- Statistics -->

<h2>
    Statistics
</h2>


<div class="statistics">


    <p>

        <strong>
            Number of Products:
        </strong>

        <?= count($filteredProducts) ?>

    </p>


    <p>

        <strong>
            Average Price:
        </strong>

        Rs.

        <?= number_format(
            calculateAveragePrice($filteredProducts),
            2
        ) ?>

    </p>


    <p>

        <strong>
            Total Stock:
        </strong>

        <?= calculateTotalStock($filteredProducts) ?>

    </p>


    <p>

        <strong>
            Average Rating:
        </strong>

        <?= number_format(
            calculateAverageRating($filteredProducts),
            2
        ) ?>

    </p>


</div>



<!-- Product Table -->

<h2>
    Products
</h2>


<table>


    <tr>

        <th>ID</th>

        <th>Name</th>

        <th>Category</th>

        <th>Price</th>

        <th>Stock</th>

        <th>Status</th>

        <th>Rating</th>

    </tr>


    <?php foreach ($filteredProducts as $product): ?>


        <tr>


            <td>
                <?= $product["id"] ?>
            </td>


            <td>
                <?= $product["name"] ?>
            </td>


            <td>
                <?= $product["category"] ?>
            </td>


            <td>
                Rs.
                <?= number_format(
                    $product["price"],
                    2
                ) ?>
            </td>


            <td>
                <?= $product["stock"] ?>
            </td>


            <td>
                <?= getStockStatus(
                    $product["stock"]
                ) ?>
            </td>


            <td>

                <?= getRatingStars(
                    $product["rating"]
                ) ?>

                (<?= $product["rating"] ?>)

            </td>


        </tr>


    <?php endforeach; ?>


</table>


</body>

</html>