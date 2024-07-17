<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.4/css/all.css">
    <title>Contact Us</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <section id="header">
        <a href="#"><img src="images/logo-removebg-preview.png" class="logo" alt="" id="logo"></a>
        <div>
            <ul id="navbar">
                <li><a href="index.php">Home</a></li>
                <li><a href="product.php">Product</a></li>
                <li><a href="about.html">About Us</a></li>
                <li><a class="active" href="contact.php">Contact</a></li>
                <li id="lg-bag"><a href="cart.php"><i class="fas fa-shopping-basket"></i></a></li>
            </ul>
        </div>
    </section>
    <section id="page-header" class="about-header" style="background-color: #015652;">
        <h2>Lets Talk</h2>
        <p>Leave a Message. We love to hear from you!</p>
    </section>

    <section id="contact-details" class="section-p1">
        <div class="details">
            <span>Get in Touch</span>
            <h2>Visit one of our shop locations or contact us today</h2>
            <h3>Head Office</h3>
            <div>
                <li>
                    <i class="fal fa-map"></i>
                    <p>Jalan 6/91, Taman Shamelin Perkasa, 56100 Kuala Lumpur.</p>
                </li>
                <li>
                    <i class="far fa-envelope"></i>
                    <p>KL2311014736@student.uptm.edu.my</p>
                </li>
                <li>
                    <i class="fas fa-phone-alt"></i>
                    <p>+60 136193369</p>
                </li>
                <li>
                    <i class="far fa-clock"></i>
                    <p>Monday-Saturday: 9.00am to 10.00pm</p>
                </li>
            </div>
        </div>
        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3983.8738902619284!2d101.73480567577532!3d3.1280242968474763!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc374119aeec81%3A0xa023551a33256eb1!2sUniversiti%20Poly-Tech%20Malaysia!5e0!3m2!1sen!2smy!4v1719725648955!5m2!1sen!2smy" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>

    <section id="form-details">
        <form action="contact.php" method="POST">
            <span>Leave a Message</span>
            <h2>We love to hear from you</h2>
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <textarea name="message" cols="30" rows="10" placeholder="Your Message" required></textarea>
            <button type="submit" name="submitbtn" class="normal">Send Message</button>
        </form>
        <?php
            if(isset($_POST['submitbtn'])){
                include 'php/message.php';
                $obj = new Contact();
                $res = $obj->messages($_POST);
                if($res == true){
                    echo "<script>alert('Message Successfully Submitted. Thank you!')</script>";
                } else {
                    echo "<script>alert('Something Went Wrong!')</script>";
                }
            }
        ?>
        <div class="people">
            <div>
                <img src="images/people1.png" alt="">
                <p><span>Anis Qistina</span>Senior Marketing Manager<br>Phone: +60 136193369<br>Email: anisgamal27@gmail.com</p>
            </div>
            <div>
                <img src="images/people2.png" alt="">
                <p><span>Izzah Akmal</span>IT Consultation<br>Phone: +60 104590783<br>Email: Izzahakmal@gmail.com</p>
            </div>
            <div>
                <img src="images/people3.png" alt="">
                <p><span>Laila Jamri</span>Outlet Manager<br>Phone: +60 1164388793<br>Email: LailaJamri@gmail.com</p>
            </div>
        </div>
    </section>

    <section id="newsletter" class="section-p1 section-m1">
        <div class="newstext">
            <h4>Sign Up for Newsletter</h4>
            <p>Get E-mail updates about our latest product and <span>special offers.</span></p>
        </div>
        <div class="form">
            <input type="text" placeholder="Your Email Address">
            <button class="normal">Sign Up</button>
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
            <a href="php/logout.php">Logout</a>
        </div>

        <div class="pay">
            <p>Secured Payment Gateways</p>
            <img src="images/pay.png.png" alt="">
        </div>
    </footer>
    <div class="copyright">
        <p style="color: lightgrey; text-align: center; width: 100%;">2024, Project SWC 3343</p>
    </div>
    <script src="script.js"></script>
    <?php include 'php/alert.php';?>
</body>
</html>
