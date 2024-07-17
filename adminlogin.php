<?php
 session_start();
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.4/css/all.css">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<section id="header">
		<a href="#"><img src="images/logo-removebg-preview.png" class="logo" alt="" id="logo"></a>
	</section>
    <div class="section-a1">
        <div class="box form-box">
        <?php
            include("php/config.php");

            if(isset($_POST['submit'])){
                $username = mysqli_real_escape_string($conn, $_POST['username']);
                $password = mysqli_real_escape_string($conn, $_POST['password']);

                // Verifying the user
                $result = mysqli_query($conn, "SELECT * FROM users WHERE Username='$username' AND Password='$password'") or die("Select Error");
                $row = mysqli_fetch_assoc($result);

                if(is_array($row) && !empty($row)){
                    $_SESSION['valid'] = $row['Username'];
                    $_SESSION['email'] = $row['Email'];
                    $_SESSION['id'] = $row['Id'];
                } else {
                    echo "<div class='message'>
                            <p>Wrong Username or Password</p>
                          </div> <br>";
                    echo "<a href='adminlogin.php'><button class='btn'>Go Back</button></a>";
                }
                if(isset($_SESSION['valid'])){
                    header("Location: admindashboard.php");
                }
            } else {
            ?>
            <header>Login</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required> 
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required> 
                </div>
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Login">
                </div>
            </form>
        </div>
        <?php } ?>