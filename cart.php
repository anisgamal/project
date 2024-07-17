<?php
session_start();

if (isset($_POST['remove_index'])) {
    $index = $_POST['remove_index'];
    unset($_SESSION['cart'][$index]);
    $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex the array
}

$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['quantity'];
}
$_SESSION['total_amount'] = $total;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<section id="header">
        <a href="index.php"><img src="images/logo-removebg-preview.png" class="logo" alt="" id="logo"></a>
        <ul id="navbar">
            <li><a href="index.php">Home</a></li>
            <li><a href="product.php">Product</a></li>
            <li><a href="about.html">About Us</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li id="lg-bag"><a href="cart.php" class="active" > <i class="fas fa-shopping-basket"></i> </a></li>
        </ul>
    </section>
    <section id="page-header">
        <h2>Shopping Cart</h2>
    </section>
    <section id="cart" class="section-p1">
        <table width="100%">
            <thead>
                <tr>
                    <th>Remove</th>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                    <?php foreach ($_SESSION['cart'] as $key => $item): ?>
                    <tr>
                        <td>
                            <form method="post" action="cart.php">
                                <input type="hidden" name="remove_index" value="<?php echo $key; ?>">
                                <button type="submit"><i class="far fa-times-circle"></i></button>
                            </form>
                        </td>
                        <td><img src="<?php echo $item['image']; ?>" alt=""></td>
                        <td><?php echo $item['product_name']; ?></td>
                        <td>RM<?php echo $item['price']; ?></td>
                        <td><input type="number" value="<?php echo $item['quantity']; ?>" readonly></td>
                        <td>RM<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6"><p>Your cart is empty.</p></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </section>
    <section id="cart-add" class="section-p1">
        <div id="subtotal">
            <h3>Cart Totals</h3>
            <table>
                <tr>
                    <td>Cart Subtotal</td>
                    <td>RM<?php echo number_format($total, 2); ?></td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td>RM3.00</td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong>RM<?php echo number_format($total + 3.00, 2); ?></strong></td>
                </tr>
            </table>
            <button class="normal"><a href="checkout.php">Proceed to checkout</a></button>
        </div>
    </section>
    <!-- Footer remains the same -->
</body>
</html>