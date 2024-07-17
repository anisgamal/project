<?php
    include 'php/config.php';
    session_start();

    if (isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];   
    } else {
        $user_id = '';
    }

    if(isset($_POST['submit'])){
        $id = unique_id();
        $username = $_POST['username'];
        $username = filter_var($username, FILTER_SANITIZE_STRING);
        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);
        $password = $_POST['password'];
        $password = filter_var($password, FILTER_SANITIZE_STRING);
    
    }
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.4/css/all.css">
	<title>Register</title>
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
                $username =  $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];

                // Verifying the unique email
                $verify_query = mysqli_query($conn, "SELECT Email FROM users WHERE Email='$email'");
                if(mysqli_num_rows($verify_query) != 0){
                    echo "<div class='message'>
                            <p>This email is already used, try another one!</p>
                          </div> <br>";
                    echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";    
                } else {
                    mysqli_query($conn, "INSERT INTO users(Username, Email, Password) VALUES('$username','$email','$password')") or die("Error occurred");
                    
                    echo "<div class='message'>
                            <p>Registration Successful!</p>
                          </div> <br>";
                    echo "<a href='Successfull.php'><button class='btn'>Login Now</button></a>";
                }
            } else {
            ?>

            <header>Sign Up</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username"  autocomplete="off" required> 
                </div>
                <div class="field input">
                    <label for="username">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required> 
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password"  autocomplete="off" required> 
                </div>
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Register">
                </div>
                <div class="link">
                    Already a member? <a href="login.php">Login here</a>
                </div>
            </form>
        </div>
        <?php } ?>
    </div>
</body>
</html>
