<?php

    include 'config.php';
    
    session_start();

    $user_id = $_SESSION['user_id'];

    if(!isset($user_id)) {
        header('location:login.php');
    }

    if(isset($_POST['send'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $msg = mysqli_real_escape_string($conn, $_POST['message']);

        $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND message = '$msg'") or die('query failed');

        if(mysqli_num_rows($select_message) > 0) {
            $message[] = 'Message sent already!';
        } else {
            mysqli_query($conn, "INSERT INTO `message`(user_id, name, email, message) VALUES('$user_id', '$name', '$email', '$msg')") or die('query failed');
            $message[] = 'Message sent successfully!';
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
    <title>Contact</title>

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
        <div class="third-page_container">
            <div class="main-th-p-pic">
                <img src="./assets/contact-1img.jpg" alt="">
            </div>

            <div class="main-th-p-paraghraph">
                <h1>GET IN TOUCH </h1>
                <div class="decription-display">
                    <div class="p-description">
                        <span>Opening Hours</span>
                        <p>Mon - Fri: 8am - 8pm</p>
                        <p>​​Saturday: 9am - 7pm</p>
                        <p>​Sunday: 9am - 8pm</p>
                    </div>

                    <div class="p-description">
                        <span>Address</span>
                        <p>Mon - Fri: 8am - 8pm</p>
                        <p>​​Saturday: 9am - 7pm</p>
                        <p>​Sunday: 9am - 8pm</p>
                    </div>
                </div>
                <span>info@frais.com</span>
            </div>
        </div>
    </main>



    <!-- Section one, Page Contact -->
    <section>
        <div class="section-one-th-p">
            <div class="section-one-th-p-display">
                <div class="section-one-th-p-form">
                    <div class="form-container">
                        <div class="info">
                            <h2>LET'S STAY CONNECTED</h2>
                            <p>If you have questions or special inquiries, you're welcome to contact us or fill out this form</p>
                        </div>
                        <h1 id="title">Get in touch</h1>
                        <form action="" method="post">
                            <div class="input-group">

                                <div class="input-field" id="nameField">
                                    <input type="text" name="name" placeholder="Name" required>
                                </div> 
                                <div class ="input-field" >
                                    <input type="email" name="email" placeholder="Email" id="email" required>
                                </div>
                                <div class="textarea-field">
                                    <textarea name="message" placeholder="Enter your message." id="" cols="30" rows="10"></textarea>
                                </div>
                            </div>

                            <div class ="btn-field">
                                <input type="submit" value="Send" name="send" class="send">
                            </div>
                            
                        </form>
                    </div>
                </div>
                
                <div class="section-one-th-p-img">
                    <!-- <img src="./assets/contact-2img(1).jpg" alt=""> -->
                    
                </div>
            </div>
        </div>
    </section>



    <!-- Section two -->

    <section>
        <div class="third-page-video" >
            <video src="./assets/contact-video.mp4" autoplay loop muted></video>
            
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