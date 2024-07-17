<?php
session_start();
include 'database.php'; // include your database connection class

$database = new Database();
$conn = $database->getConnection();

if (isset($_POST['checkout'])) {
    // Ensure user_id and total_amount are set in the session
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['total_amount'])) {
        die("Error: User ID or total amount not set in session.");
    }

	   // Capture additional checkout fields
	   $name = $_POST['name'];
	   $address = $_POST['address'];
	   $phone = $_POST['phone'];

    // Process the checkout
    $user_id = $_SESSION['user_id']; // Assuming user is logged in and user_id is stored in session
    $total_amount = $_SESSION['total_amount']; // Total amount to be paid
    $order_date = date('Y-m-d H:i:s');

    // Insert order into the orders table
    // Adjust the SQL statement according to your table's actual structure
    $sql = "INSERT INTO orders (user_id, total_amount, name, address, phone) VALUES (:user_id, :total_amount, :name, :address, :phone)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':total_amount', $total_amount);
	$stmt->bindParam(':name', $name);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':phone', $phone);

    if ($stmt->execute()) {
        $order_id = $conn->lastInsertId();

        // Insert order details into the order_items table
        foreach ($_SESSION['cart'] as $item) {
            $product_id = $item['product_id'];
            $quantity = $item['quantity'];
            $sql = "INSERT INTO order_items (order_id, product_id, quantity) VALUES (:order_id, :product_id, :quantity)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':order_id', $order_id);
            $stmt->bindParam(':product_id', $product_id);
            $stmt->bindParam(':quantity', $quantity);
            $stmt->execute();
        }

        // Clear the cart
        unset($_SESSION['cart']);
        unset($_SESSION['total_amount']);

        echo "Checkout successful! Your order has been placed.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->errorInfo()[2];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <style>

*{
	margin: 0;
	padding: 0;
	box-sizing: border-box;
	font-family: "Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, "sans-serif";
}

.logo{
	height: 80px;
}

h1{
	font-size: 50px;
	line-height: 64px;
	color: #000000;
}

h2{
	font-size: 46px;
	line-height: 54px;
	color: #000000;
}
h4{
	font-size: 20px;
	color: #000000;
}
h6{
	font-weight: 700;
	font-size: 12px;
}
p{
	font-size: 16px;
	color: #444242;
	margin: 15px 0 20px 0;
}

.section-p1{
	padding: 40px 80px;
	margin-top: 40px;
	margin-left: 500px;
}

.section-p2{
	padding: 40px 80px;
}

.section-m1{
	margin: 40px 0;
}

.section-a1{
	display: flex;
	align-items: center;
	justify-content: center;
	min-height: 90vh;
}
#product1{
	text-align: center;
}
button.normal{
	font-size: 14px;
	font-weight: 600;
	padding: 15px 30px;
	color: #000;
	background-color: #fff;
	border-radius: 4px;
	cursor: pointer;
	border: none;
	outline: none;
	transition: 0.2s;
	
}
body{
	width: 100%;
}

/* header start */

#header{
	display: flex;
	align-items: center;
	justify-content: space-between;
	padding: 10px 60px;
	background: #E3E6F3;
	box-shadow: 0 5px 15px rgba(0, 0, 0, 0.06);
	z-index: 999;
	position: sticky;
	top: 0;
	left: 0;
}

#navbar{
	display: flex;
	align-items: center;
	justify-content: center;
	transition: 0.5s;
}

#navbar li{
	list-style: none;
	padding: 0 20px;
	position: relative;
}

#navbar li a{
	text-decoration: none;
	font-size:16px;
	font-weight: 600;
	color: #1a1a1a;
	transition:  0.3s ease;
}

#navbar li a:hover{
	color: #088178;
}

#navbar li a:hover, #navbar li a.active{
	color: #088178;
}

#navbar li a.active::after, #navbar li a:hover::after{
	content: "";
	width: 30%;
	height: 2px;
	background: #088178;
	position: absolute;
	bottom: -4px;
	left: 20px;
}
.login .icons{
	display: flex;
}
.login .icons i{
margin-left: 1rem;
font: 1.5rem;
cursor: pointer;
}
/* homepage */
#hero{
background-image: url("../images/landscape.jpg");
	height: 60vh;
	min-height: 120%;
	background-size: cover;
	background-position: top 25% right 0;
	padding: 0 80px;
	display: flex;
	flex-direction: column;
	align-items: flex-start;
	justify-content: center;
}
	

#hero h4{
	color: #FFFBFB;
	padding-bottom: 15px;
}

#hero h1{
	color: #FFFBFB;
}

#hero h2{
	color: #FFFBFB;
}

#hero p{
	color: #F9FF00;
}

#hero button{
	background-color: #088178;
	font-size: 14px;
	font-weight: 600;
	padding: 15px 30px;
	color: #000;
	border-radius: 4px;
	cursor: pointer;
	border: none;
	outline: none;
	transition: 0.2s;
}
#page-header{
	background-color: #544949;
	width: 100%;
	height: 20vh;
	background-size: cover;
	display: flex;
	justify-content: center;
	text-align: center;
	flex-direction: column;
	padding: 14px;
 }

 #page-header p{
	color: whitesmoke;
 }
        .container {
            margin-left: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

         form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .field.input {
            display: flex;
            flex-direction: column;
        }
        .field.input input {
            margin-bottom: 10px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .btn{
	height: 35px;
	background: #088178;
	border: 0;
	border-radius: 5px;
	color: #fff;
	font-size: 15px;
	cursor: pointer;
	transition: all .3s;
	margin-top: 10px;
	padding: 0px 10px;
}
.btn:hover{
	opacity: 0.82;
}
.submit{
	width: 100%;
}

        #newsletter{
	display: flex;
	justify-content: space-between;
	flex-wrap: wrap;
	align-items: center;
	background-image: url("img/banner2");
	background-position: 50% 50%;
	background-color: #041e42;
}

#newsletter h4{
	font-size: 22px;
	font-weight: 700;
}

#newsletter p {
	font-size: 14px;
	font-weight: 600;
	color: #818ea0;
}
#newsletter p span{
	color: #fffb00;
}

#newsletter .form{
	display: flex;
	width: 40%;
}

#newsletter input{
	height: 3.125rem;
	padding: 0 1.25em;
	font-size: 14px;
	width: 100%;
	border: 1px solid transparent;
	border-radius: 4px;
	outline: none;
	border-top-right-radius: 0;
	border-bottom-right-radius: 0;
}

#newsletter button{
background-color: #088178;
color:#ffffff;
white-space: nowrap;
border-top-left-radius: 0;
border-bottom-left-radius: 0;
outline: none;


}

footer{
display: flex;
flex-wrap: wrap;
justify-content: space-between;

}

footer .col{
	display: flex;
	flex-direction: column;
	align-items: flex-start;
	margin-bottom: 20px;

	
	}

footer .logo{
	margin-bottom: 30px;

}

footer h4{
	font-size: 14px;
	padding-bottom: 20px;
}

footer p{
	font-size: 13px;
	margin: 0 0 8px 0;
}
footer a{
	font-size: 13px;
	text-decoration: none;
	color: #222;
	margin: 10px;
}

footer .follow{
	margin-top: 20px;
}

footer .follow i{
	color: #465b52;
	padding-right: 4px;
	cursor: pointer;

}
 footer .follow i:hover, footer a:hover{
	color: #088178;
 }


</style>
</head>
<body>
<section id="header">
        <a href="index.php"><img src="images/logo-removebg-preview.png" class="logo" alt="" id="logo"></a>
        <ul id="navbar">
            <li><a href="index.php">Home</a></li>
            <li><a href="product.php">Product</a></li>
            <li><a href="about.html">About Us</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li id="lg-bag"><a href="cart.php"> <i class="fas fa-shopping-basket"></i> </a></li>
        </ul>
    </section>
    <section id="page-header">
        <h4>Checkout</h4>
    </section>
    <form method="post" action="checkout.php" class="section-p1">
        <div class="field input">
            <input type="text" name="name" class="name" placeholder="Your Name">
            <br>
            <input type="text" name="address" placeholder="Your Address">
            <br>
            <input type="text" name="phone" placeholder="Your Phone Number">
            <br>
            <button type="submit" name="checkout" class="btn">Checkout</button>
        </div>
    </form>   
	<section id="newsletter" class="section-p2 section-m1">
        <div class="newstext">
            <h4>Sign Up for Newsletter</h4>
            <p>Get E-mail updates about our latest product and <span>special offers.</span></p>
        </div>
        <div class="form">
            <input type="text" placeholder="Your Email Address">
            <button class="normal"><a href="register.php">Sign Up</a></button>
        </div>
    </section>
		
	<footer class="section-p2"> 
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