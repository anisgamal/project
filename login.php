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
        include 'database.php'; // Include your database connection class

        if (isset($_POST['submit'])) {
            $database = new Database();
            $conn = $database->getConnection();

            $username = $_POST['username'];
            $password = $_POST['password'];

            // Verifying the user using prepared statements
            $stmt = $conn->prepare("SELECT * FROM users WHERE Username = :username AND Password = :password");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $_SESSION['valid'] = $row['Username'];
                $_SESSION['email'] = $row['Email'];
                $_SESSION['id'] = $row['Id'];
                $_SESSION['user_id'] = $row['Id']; // Ensuring user_id is set

                header("Location: index.php");
                exit;
            } else {
                echo "<div class='message'>
                        <p>Wrong Username or Password</p>
                      </div><br>";
                echo "<a href='login.php'><button class='btn'>Go Back</button></a>";
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

            <div class="link">
                Don't have an Account? <a href="register.php">Sign Up Now</a>
            </div>
        </form>
    </div>
    <?php } ?>
</div>
</body>
</html>