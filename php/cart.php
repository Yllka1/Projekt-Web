<?php

    include 'config.php';
    session_start();

    $user_id = $_SESSION['user_id'];

    if(!isset($user_id)) {
        header('location:login.php');
    }

    if(isset($_POST['update_cart'])) {
        $cart_id = $_POST['cart_id'];
        $cart_quantity = $_POST['cart_quantity'];

        mysqli_query($conn, "UPDATE `cart` SET quantity = '$cart_quantity' WHERE id = '$cart_id'") or die('query failed');

        $message[] = 'Cart quantity updated!';
    }

    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        mysqli_query($conn, "DELETE FROM cart WHERE id = '$delete_id'") or die('query failed');
        header('location:cart.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Webpage Title -->
     <title>Cart</title>

     <!-- Styles / CSS -->
     <link rel="stylesheet" href="./css/style.css">
     <!-- Icons -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>
<body>

    <?php 
        if(isset($message)) {
            foreach($message as $message) {
                echo  '
                <div class="message">
                    <span>'.$message.'</span>
                    <i class="fas fa-times" onclick="this.parentElement.remove()"></i>
                </div>
                ';
            }
        }
    ?>

    <header>
        <!-- Navigacioni -->
        <nav>
            <ul>
                <li><a href="home.php">HOME</a></li>
                <li><a href="our-story.php">OUR STORY</a></li>
                <li><a href="contact.php">CONTACT</a></li>
                <li><a href="sale.php">SALE</a></li>
                <?php 
                    $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                    $cart_rows_number = mysqli_num_rows($select_cart_number);
                ?>
                <li><a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?php echo $cart_rows_number; ?>)</span></a></li>
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
            <div class="user-box">
                <p>Username : <span><?php echo $_SESSION['user_name']; ?></span></p>
                <p>Email : <span><?php echo $_SESSION['user_email']; ?></span></p>
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>
        </nav>
    </header>

    <div class="shoping__cart">
        <div class="shoping__cart_paragraph">
            <h1>Products Added</h1>
            <p>I'm a paragraph. Click here to add your own text and edit me.</p>
        </div>

        <div class="shoping__cart_form">
            <?php
                $grand_total = 0; 
                $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                if(mysqli_num_rows($select_cart) > 0) {
                    while($fetch_cart = mysqli_fetch_assoc($select_cart)) {
            ?>
            <div class="cart__item">
                <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="fas fa-times" onclick="return confirm('Delete this from cart?');"></a>
                <img src="uploaded_assets/<?php echo $fetch_cart['image']; ?>" alt="">
                <div class="name"><?php echo $fetch_cart['name']; ?></div>
                <div class="price">$<?php echo $fetch_cart['price']; ?></div>
                <form action="" method="post">
                    <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                    <input type="number" class="qty" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
                    <input type="submit" name="update_cart" value="Update" class="update_cart_btn">
                </form>
                <div class="sub__total">Sub Total : <span>$<?php echo $sub_total = ($fetch_cart['quantity'] * $fetch_cart['price']); ?> </span></div>
            </div>
            <?php 
            $grand_total += $sub_total;
                }
            } else {
                echo '<p class="empty">Your cart is empty!</p>';
            } 
            ?>
        </div>

    </div>

    <footer>
        <div class="boxes">
            <div class="box">
                <div class="logo">
                    <a href="home.php">FRAIS</a>
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
                        <li><a href="/our-story.php">OUR STORY</a></li>
                        <li><a href="/contact.php">CONTACT US</a></li>
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

    <script src="./js/script.js"></script>
</body>
</html>