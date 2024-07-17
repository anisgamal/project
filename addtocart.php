<?php
session_start();

if (isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];

    // Example: Add product to session cart (you can modify this to fit your database schema)
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Check if product already exists in cart
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]++;
    } else {
        $_SESSION['cart'][$productId] = 1;
    }

    echo "Product added to cart.";
} else {
    echo "Invalid request.";
}
?>
