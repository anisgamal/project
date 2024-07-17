<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<section id="header">
        <a href="#"><img src="images/logo-removebg-preview.png" class="logo" alt="" id="logo"></a>
        <div>
            <ul id="navbar">
                <li><a class="active" href="index.php">Home</a></li>
                <li><a href="product.php">Product</a></li>
            </ul>
        </div>
    </section>
    <div class="section-a1">
        <h1>Add New Product</h1>
        <form action="insertproduct.php" class="box form-box"method="post" enctype="multipart/form-data">
            <label for="name">Product Name:</label><br>
            <input type="text" id="name" name="name" required><br><br>
                    
            <label for="category">Category:</label><br>
            <input type="text" id="category" name="category" required><br><br>
            
            <label for="price">Price:</label><br>
            <input type="text" id="price" name="price" required><br><br>
            
            <label for="image">Image:</label><br>
            <input type="file" id="image" name="image" required><br><br>
            
            <input type="submit" class="btn" value="Add Product">
        </form>
    </div>
</body>
</html>
