<?php
    include 'config.php';

    session_start();

    $user_id = $_SESSION['user_id'];

    if(!isset($user_id)){
    header('location:login.php');
    }

    if(isset($_POST['add_to_cart'])){

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    if(mysqli_num_rows($check_cart_numbers) > 0){
        $message[] = 'Already added to cart!';
    }else{
        mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
        $message[] = 'Product added to cart!';
    }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Webpage Title -->
      <title>Sale</title>

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


    <!-- Implementimi i Header-it -->

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

    <div class="sale__container">
        <div class="sale__paragraph">
            <h1>SALE</h1>
            <p>I'm a paragraph. Click here to add your own text and edit me.</p>
        </div>

        <div class="sale__items">
        <?php
                $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('query failed');
                if(mysqli_num_rows($select_products) > 0) {
                    while($fetch_products = mysqli_fetch_assoc($select_products)) {
            ?>
            <form action="" method="post" class="item">
                <img src="uploaded_assets/<?php echo  $fetch_products['image']; ?>" alt="">
                <div class="name"><?php echo $fetch_products['name']; ?></div>
                <div class="price">$<?php echo $fetch_products['price']; ?></div>
                <input type="number" min="1" name="product_quantity" value="1" class="qty">
                <input type="hidden" name="product_name" value="<?php echo  $fetch_products['name']; ?>">
                <input type="hidden" name="product_price" value="<?php echo  $fetch_products['price']; ?>">
                <input type="hidden" name="product_image" value="<?php echo  $fetch_products['image']; ?>">
                <input type="submit" value="Add to cart" name="add_to_cart" class="add_to_cart">
            </form>
                        
            <?php
                    }
                } else {
                    echo '<p class="empty">No products added yet!</p>';
                }
            ?>
        </div>
    </div>


    <!-- Footer-i -->

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

    <div class="powerd-by">
        <span>© 2023 by Frais. Powered and secured by Students</span>
    </div>

    <script src="./js/script.js"></script>
</body>
</html>