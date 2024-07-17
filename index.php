<?php
session_start();
include 'database.php'; // include your database connection class

$database = new Database();
$conn = $database->getConnection();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array(); // or $_SESSION['cart'] = []; for PHP 7.4+
}

if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $image = $_POST['image'];

    // Check if the product is already in the cart
    $product_exists = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['product_id'] == $product_id) {
            $item['quantity'] += 1;
            $product_exists = true;
            break;
        }
    }

    // If the product is not in the cart, add it
    if (!$product_exists) {
        $_SESSION['cart'][] = array(
            'product_id' => $product_id,
            'product_name' => $product_name,
            'price' => $price,
            'image' => $image,
            'quantity' => 1
        );
    }

    header('Location: product.php?added_to_cart=true');
    exit;
}

// Fetch products from the database
$sql = "SELECT id, name, category, price, image FROM products";
$stmt = $conn->prepare($sql);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.4/css/all.css">
    <title>Home</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="login">
    <section id="header">
        <a href="#"><img src="images/logo-removebg-preview.png" class="logo" alt="" id="logo"></a>
        <div>
            <ul id="navbar">
                <li><a class="active" href="index.php">Home</a></li>
                <li><a href="product.php">Product</a></li>
                <li><a href="about.html">About Us</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li id="lg-bag"><a href="cart.php"> <i class="fas fa-shopping-basket"></i> </a></li>
            </ul>
        </div>
    </section>
    <section id="hero">
        <h4> Offer! </h4>
        <h2> Super Value Deals</h2>
        <h1> On all Products</h1>
        <p> Save more with coupons & up to 20% off! </p>
        <button><a href="product.php" class="button">Shop Now</a></button>
    </section>
    <section id="product1" class="section-p1">
        <h2> Featured Products</h2>
        <div class="pro-container">
            <div class="pro">
                <img src="images/caramellatte.jpg" alt="">
                <div class="des">
                    <span>Coffee</span>
                    <h5>Caramel Latte</h5>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h4>RM9.90</h4>
                </div>
            </div>
            <div class="pro">
                <img src="images/icedmocha.jpg" alt="">
                <div class="des">
                    <span>Coffee</span>
                    <h5>Iced Mocha</h5>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h4>RM9.90</h4>
                </div>
            </div>
            <div class="pro">
                <img src="images/icedchoc.jpg" alt="">
                <div class="des">
                    <span>Non-Coffee</span>
                    <h5>Ice Chocolate</h5>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h4>RM9.90</h4>
                </div>
            </div>
            <div class="pro">
                <img src="images/matcha.jpg" alt="">
                <div class="des">
                    <span>Coffee</span>
                    <h5>Matcha Latte</h5>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h4>RM9.90</h4>
                </div>
            </div>
        </div>
    </section>
    <section id="banner" class="section-m1">
        <h4> KAW KAW DEALS </h4>
        <h2>Up to <span>50% off </span>- All Coffee</h2>
        <button class="normal"><a href="product.php"> Explore More</a></button>
    </section>
    <section id="product1" class="section-p1">
        <h2> New Arrival</h2>
        <div class="pro-container">
            <div class="pro">
                <img src="images/raspberry lemonade.jpg" alt="">
                <div class="des">
                    <span>Non-Coffee</span>
                    <h5>Raspberry Lemonade</h5>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h4>RM10.90</h4>
                </div>
            </div>
            <div class="pro">
                <img src="images/strawberry lemonade.jpg" alt="">
                <div class="des">
                    <span>Non-Coffee</span>
                    <h5>Strawberry Lemonade</h5>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h4>RM10.90</h4>
                </div>
            </div>
            <div class="pro">
                <img src="images/PeachTea.jpg" alt="">
                <div class="des">
                    <span>Non-Coffee</span>
                    <h5>Peach Tea</h5>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h4>RM9.90</h4>
                </div>
            </div>
        </div>
    </section>
    <section id="sm-banner" class="section-p1">
        <div class="banner-box">
            <h4>CRAZY DEALS</h4>
            <h2>Buy 1 Get 1 Free</h2>
            <span>For all drinks</span>
            <button class="normal"><a href="product.php">Learn More</a></button>
        </div>
    </section>
    <section id="newsletter" class="section-p1 section-m1">
        <div class="newstext">
            <h4>Sign Up for Newsletter</h4>
            <p>Get E-mail updates about our latest product and <span>special offers.</span></p>
        </div>
        <div class="form">
            <input type="text" placeholder="Your Email Address">
            <button class="normal"><a href="register.php">Sign Up</a></button>
        </div>
    </section>
		
	<footer class="section-p1"> 
		<div class="col">
			<img class="logo" src="images/logo-removebg-preview.png" class="logo">
			<h4 style="color: grey;">Contact</h4>
			<p><strong>Address:</strong> Jalan 6/91, Taman Shamelin Perkasa, 56100 Kuala Lumpur</p>
			<p><strong>Phone:</strong> 0136193369</p>
			<p><Strong>Hours:</Strong> 10.00 - 17.00. Mon - Fri</p>
			<div class="follow">
				<h4>Follow Us</h4>
				<div class="icon">
					<i class="fab fa-facebook-f"></i>
					<i class="fab fa-twitter"></i>
					<i class="fab fa-instagram"></i>
				</div>
			</div>
		</div>

		<div class="col">
			 <h4 style="color: grey;">About</h4>
			 <a href="about.html">About Us</a>
			 <a href="product.php">Product</a>
			 <a href="contact.php">Contact Us</a>
		</div>
		<div class="col">
			<h4 style="color: grey;">My Account</h4>
			<a href="login.php">Sign In</a>
			<a href="cart.html">View Cart</a>
			<a href="php/logout.php">Log out</a>
		</div>

	   <div class="pay">
		<p>Secured Payment Gateways</p>
		<img src="images/pay.png.png" alt="">
	   </div>
	</footer>
	<div class="copyright">
		<p style="color: lightgrey; text-align: center; width: 100%;">2024, Project SWC 3343</p>
	   </div>
								 
		
    </footer>
		<script src="script.js"></script>	
</body>
</html>