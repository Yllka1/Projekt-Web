<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)) {
    header('location:login.php');
};

if(isset($_POST['add_product'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price =  $_POST['price'];
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name =  $_FILES['image']['tmp_name'];
    $image_folder =  'uploaded_assets/'.$image;

    $select_product_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name = '$name'") or die('query failed');

    if(mysqli_num_rows($select_product_name) > 0) {
        $message[] = 'Product name already added';
    } else {
        $add_product_query = mysqli_query($conn, "INSERT INTO `products`(name, price, image) VALUES('$name', '$price', '$image')") or die('query failed');

        if($add_product_query) {
            if($image_size > 2000000) {
                $message[] = 'Image size is to large';
            }
            move_uploaded_file($image_tmp_name, $image_folder);
            $message = 'Product added successfully!';
        } else {
            $message = 'Product could not be added!';
        }
    }
}

if(isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_image_query = mysqli_query($conn, "SELECT image FROM `products` WHERE id = '$delete_id'") or die('quqery failed');
    $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
    unlink('uploaded_assets/'.$fetch_delete_image['image']);
    mysqli_query($conn, "DELETE FROM `products` WHERE id = '$delete_id'") or die('quqery failed');
    header('location:admin_sale.php');
}

if(isset($_POST['update_product'])) {

    $update_p_id = $_POST['update_p_id'];
    $update_name = $_POST['update_name'];
    $update_price = $_POST['update_price'];

    mysqli_query($conn, "UPDATE `products` SET name = '$update_name', price = '$update_price' WHERE id = '$update_p_id'") or die('query failed');

    $update_image = $_FILES['update_image']['name'];
    $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
    $update_image_size = $_FILES['update_image']['size'];
    $update_foder = 'uploaded_assets/' .$update_image;
    $update_old_image = $_POST['update_old_image'];

    if(!empty($update_image)) {
        if($update_image_size > 2000000) {
            $message[] = 'Image file size is too large';
        } else {
            mysqli_query($conn, "UPDATE `products` SET image = '$update_image' WHERE id = '$update_p_id'") or die('query failed');
            move_uploaded_file($update_image_tmp_name, $update_foder);
            unlink('uploaded_assets/'.$update_old_image);
        }
    }

    header('location:admin_sale.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Webpage Title -->
    <title>Admin Products</title>

    <!-- Styles / CSS -->
    <link rel="stylesheet" href="./css/admin-style.css">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>
<body>

    <!-- Implementimi i Header-it -->

    <header>
        <!-- Navigacioni -->
        <nav>
            <ul>
                <li><a href="admin_home.php">HOME</a></li>
                <li><a href="admin_users.php">USERS</a></li>
                <li><a href="admin_sale.php">PRODUCTS</a></li>
                <li><a href="admin_contact.php">CONTACT</a></li>
            </ul>
        
            <!-- Logo -->
            <div class="logo">
                <a href="home.php">FRAIS</a>
            </div>

            <!-- Ikonat e nevojshme -->
            <div class="users-icons">
                <div id="user-btn" class="fas fa-user"></div>
                <div id="menu-btn" class="fas fa-bars"></div>
                <div class="input-field">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="search" placeholder="Search...">
                </div>
            </div>

            <!-- User Infos -->
            <div class="account-box">
                <p>Username : <span><?php echo $_SESSION['admin_name']; ?></span></p>
                <p>Email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>
        </nav>
    </header>

    <!-- Product section starts -->

    <section class="add-products">

        <h1 class="shop-products-title">Shop Products</h1>

        <form action="" method="post" enctype="multipart/form-data">
            <h3>Add Products</h3>
            <input type="text" name="name" class="add_products__box" placeholder="Enter product name" required>
            <input type="number" min="0" name="price" class="add_products__box" placeholder="Enter product price" required>
            <input type="file" name="image" accept="image/jpg, image/jpeg, image/png, image/webp" class="add_products__box" required>
            <input type="submit" value="Add Prouct" name="add_product" class="add_product__btn">
        </form>

        
        
    </section>

    

    <!-- Product section ends -->

    <!-- Show Products -->

    <section class="show__products">

        <div class="products__box_container">

            <?php 
                $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
                if(mysqli_num_rows($select_products) > 0) {
                    while($fetch_products = mysqli_fetch_assoc($select_products)){     
            ?>
            
            <div class="change__box">
                <div class="item"><img src="uploaded_assets/<?php echo $fetch_products['image']; ?>" alt=""></div>
                <div class="name"><?php echo $fetch_products['name']; ?></div>
                <div class="price">$<?php echo $fetch_products['price']; ?>/-</div>
                <a href="admin_sale.php?update=<?php echo $fetch_products['id']; ?>" class="option_btn">Update</a>
                <a href="admin_sale.php?delete=<?php echo $fetch_products['id']; ?>" class="delete_btn" onclick="return confirm('Delete this product?');">Delete</a>
            </div>

            <?php
                    }
                } else {
                    echo '<p class="empty">No product added yet!</p>';
                }
            ?>
        </div>

    </section>

    <section class="edit__product_form">
        <?php
            if(isset($_GET['update'])) {
                $update_id = $_GET['update'];
                $update_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$update_id'") or die('query failed');
                if(mysqli_num_rows($update_query) > 0) {
                    while($fetch_update = mysqli_fetch_assoc($update_query)) {

                    
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
            <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
            <img src="uploaded_assets/<?php echo $fetch_update['image']; ?>" alt="">
            <input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" required placeholder="Enter product name">
            <input type="number" name="update_price" value="<?php echo $fetch_update['price']; ?>" min="0" required placeholder="Enter product price">
            <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png, image/webp">
            <input type="submit" name="update_product" value="Update">
            <input type="reset" name="cancel" id="close-update">
        </form>
        <?php 
                }
            }
            } else {
                echo '<script>document.querySelector(".edit__product_form").style.display = "none";</script>';
            }
        ?>
    </section>           


    <!-- Footer-i -->
    <footer>
        <div class="boxes">
            <div class="box">
                <div class="logo">
                    <a href="admin_home.php">FRAIS</a>
                </div>
            </div>

            <div class="box">
                <div class="box-one">
                    <p>SHOP</p>
                    <ul>
                        <li><a href="#">Eyeglasses</a></li>
                        <li><a href="#">Frames</a></li>
                        <li><a href="#">SALE</a></li>
                    </ul>
                </div>
                <div class="box-two">
                    <p>HELP</p>
                    <ul>
                        <li><a href="#">TERMS & CONDITIONS</a></li>
                        <li><a href="#">PRIVACY POLICY</a></li>
                        <li><a href="#">SHIPPING & RETURNS</a></li>
                    </ul>
                </div>
            </div>

            <div class="box">
                <div class="box-one">
                    <p>FRAIS</p>
                    <ul>
                        <li><a href="#">OUR STORY</a></li>
                        <li><a href="/admin_contact.php">CONTACT US</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div>
                <div class="box-two">
                    <p>CONTACT US</p>
                    <ul>
                        <li>123-456-7890</li>
                        <li>INFO@MYSITE.COM</li>
                    </ul>
                    
                    <div class="footer__icons">
                        <span><a href="#"><i class="fa-brands fa-facebook-f d-p"></i></a></span>
                        <span><a href="#"><i class="fa-brands fa-instagram d-p"></i></a></span>
                        <span><a href="#"><i class="fa-brands fa-twitter d-p"></i></a></span>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="./js/admin.js"></script>
</body>
</html>