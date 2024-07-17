<?php
session_start(); // Start the session to work with $_SESSION

// Check if the remove_index is set in POST
if (isset($_POST['remove_index'])) {
    $remove_index = $_POST['remove_index'];
    
    // Check if $_SESSION['cart'] is set and is an array
    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        // Remove item from cart based on $remove_index
        unset($_SESSION['cart'][$remove_index]);
        
        // Reset array keys to maintain continuous index if needed
        $_SESSION['cart'] = array_values($_SESSION['cart']);
        
        // Optionally, redirect to the cart page or refresh current page
        header('Location: cart.php');
        exit;
    } else {
        // Handle case where cart is empty or not initialized
        echo "Your cart is empty or not initialized.";
    }
} else {
    // Handle case where remove_index is not set
    echo "Invalid request.";
}
?>
