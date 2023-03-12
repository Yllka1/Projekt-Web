<?php

    include 'config.php';
    session_start();

    $user_id = $_SESSION['user_id'];

    if(!isset($user_id)) {
        header('location:login.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Webpage Title -->
    <title>Our Story</title>

    <!-- Styles / CSS -->
    <link rel="stylesheet" href="./css/style.css">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>
<body>

    <!-- Header-i -->

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

    <main>
        <div class="second-page_container">
            <div class="main-s-p-pic">
                <img src="./assets/our-story-1img.jpg" alt="">
            </div>

            <div class="main-s-p-paraghraph">
                <h1>Eye Care Solution Since 2007</h1>
                <div class="p-description">
                    <p>FRAIS sunglasses for men and women - a revolving, eclectic collection of classic staples, like aviators and navigators, and bolder designs that are so futuristic.</p>
                </div>
            </div>
        </div>
    </main>

    <!-- Section one -->

    <section>
        <div class="section-one-s-p">
            <div class="section-one-s-p-display">
                <div class="section-one-s-p-caption">
                    <h3>MEET ALISON</h3>
                    <p>I'm a paragraph. Circa 2007: Optical pioneer Alison envisioned the future of eyewear. 
                    Fueled by the frustration of licensing existing brands at an absurd cost, Golden was intrigued by the idea of creating a proprietary, unique brand. She, along with his brother, Randal, and expert product development team, crafted an exclusive collection of high quality, one-of-a-kind styles priced at about half of similar luxury eyewear.
                    Today, FRAIS remains the “go to” locale for eyewear.</p>
                </div>

                <div class="section-one-s-p-img">
                    <!-- <img src="./assets/our-story-staf-pic1.jpg" alt=""> -->
                </div>
            </div>
        </div>
    </section>

    <!-- Section two -->

    <section>
        <div class="second-page-video">
            <video src="./assets/our-story-v1.mp4" autoplay loop muted></video>
        </div>
    </section>

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
                        <li><a href="#">EyeGlasses</a></li>
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

    <!-- Scripts -->
    <script src="./js/script.js"></script>
</body>
</html>