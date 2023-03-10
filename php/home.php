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
    <title>Home</title>

    <!-- Styles / CSS -->
    <link rel="stylesheet" href="./css/style.css">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>
<body>

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

    <!-- Main Look -->

    <main>
        <div class="container">
            <div class="main-pic">
                <img src="./assets/Main-home-Img.jpg" alt="Main Picture">
            </div>

            <div class="main-paragraph">
                <h1>Shop Frames Anytime Anywhere</h1>
                <p>STYLE YOURSELFT WITH THE BEST LENS</p>
                <a href="#">Shop Now</a>
            </div>
        </div>
    </main>

    <!-- Section One -->

    <section>
        <div class="section-one">

            <div class="s-o-f">
                <span>SHOP OUR FAVORITES</span>
            </div>

            <div class="s-o-display">
                <div class="s-o-caption">
                    <span>Whatever You See Can Inspire You</span>

                    <p>Every pair of FRAIS glasses comes with anti-reflective, scratch-resistant lenses that block 100% of UV rays. Pick from a range of lens options to fit your vision needs.</p>

                    <div class="shop-glasses">
                        <a href="#">Shop Glasses</a>
                    </div>
                </div>

                <div class="s-o-video">
                    <video src="./assets/first-video.mp4" autoplay loop muted></video>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Two -->

    <section>
        <div class="section-two">
            <div class="s-t-display">
                    <div class="s-t-img">
                        <img src="./assets/Section-two-img.jpg" alt="">
                    </div>

                
                    <div class="s-t-caption">
                        <span>Lenses with benefits</span>

                        <p>EXTENDED VISION READING GLASSES ALLOW YOU TO READ YOUR PHONE, YOUR BOOK, OR YOUR COMPUTER AND, AT THE SAME TIME, CLEARLY SEE THE SPACE AND PEOPLE AROUND YOU.

                            SHOP NOW LEARN MORE</p>

                        <a href="#">Shop Glasses</a>
                    </div>
            </div>
        </div>
    </section>

    <!-- Section Three -->

    <section>
        <div class="home__slider">
            <div class="section-three">
                <h1>MOST POPULAR</h1>
                
                <div class="conainer-box">
                    
                    <div class="testimonial">
                        <div class="slider-row" id="slide">
                            <div class="slider-col">
                                <div class="user-text">
                                    <p>The &5 Extended Vision??? Reading Glasses feature a subtle feminine cateye style with thinner proportions that is perfect for smaller faces.   
                                        Frame Measurements: 50 ??? 19 ??? 136 Learn how to measure your existing frames to compare</p>
                                    <h3>MATTE BLACK</h3>
                                    <div class="last-price">
                                        <span>$360.00</span>
                                    </div>
                                    <span>$277.75</span>
                                </div>
                                <div class="user-img">
                                    <img src="./assets/Slider-Img-1.jpg" alt="">
                                </div>
                            </div>
            
                            <div class="slider-col">
                                <div class="user-text">
                                    <p>The &7 Extended Vision??? Reading Glasses feature a unisex design with strong angles creating a bold and beautiful rectangular shape that is lightweight and sized to fit smaller to medium faces. </p>
                                    <h3>ANTIQUE GOLD</h3>
                                    <span>$85.00</span>
                                </div>
                                <div class="user-img">
                                    <img src="./assets/Slider-Img-2.jpg" alt="">
                                </div>
                            </div>
            
                            <div class="slider-col">
                                <div class="user-text">
                                    <p>The &6 Extended Vision??? Reading Glasses are built on a chassis of feather-light, semi-rimless, titanium frames with filigreed temples handcrafted in Japan. 
                                        Frame Measurements: 47 ??? 21 ??? 143 Learn how to measure your existing frames to compare</p>
                                    <h3>GREEN MATTE</h3>
                                    <div class="last-price">
                                        <span>$170.00</span>
                                    </div>
                                    <span>$140.25</span>
                                </div>
                                <div class="user-img">
                                    <img src="./assets/Slider-Img-3.jpg" alt="">
                                </div>
                            </div>
            
                            <div class="slider-col">
                                <div class="user-text">
                                    <p>The &3 Extended Vision??? Reading Glasses make their statement with strong angles and the longer endpieces produce a more relaxed fit for medium to larger faces.</p>
                                    <h3>TRANSPARENT</h3>
                                    <div class="last-price">
                                        <span>$190.00</span>
                                    </div>
                                    <span>$119.50</span>
                                </div>
                                <div class="user-img">
                                    <img src="./assets/Slider-Img-4.jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="indicator">
                        <span class="btn active"></span>
                        <span class="btn"></span>
                        <span class="btn"></span>
                        <span class="btn"></span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Section Four -->

    <section>
        <div class="section-four">
                <h2>
                    <span>NATURALLY SIMPLE</span>
                </h2>

            <div class="section-four-display">
                <div class="s-f-caption">
                    <p>Born in the ???80s and donned by inspirational thinkers and visionaries ever since. Carry the legacy forward with a Sunglass Hut limited-edition: the FREIS New Clubmaster in an exclusive colorway</p>
                    <div class="our-story-btn">
                        <a href="/our-story.html">Our Story</a>
                    </div>
                </div>
                <div class="s-f-img">
                    <div class="bg-img">
                        <img src="./assets/background-img.webp" alt="">
                    </div>
                    <div class="o-s-img">
                        <img src="./assets/section-four-img (1).jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Five -->

    <section>
        <div class="section-five">
            <h2>
                <span>THE FRAIS BLOG</span>
            </h2>

            <div class="cards">
                <div class="card">
                    <div class="card-img">
                        <img src="./assets/s5.jpg" alt="">
                    </div>
                    <div class="card-content">
                        <h3>
                            <span>Your Face Is Your Art</span>
                        </h3>
                        <p>Create a blog post subtitle that summarizes your post in a few short, punchy sentences and entices your audience to continue reading....</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-img">
                        <img src="./assets/section-five-2img.jpg" alt="">
                    </div>
                    <div class="card-content">
                        <h3>
                            <span>Style Is What You
                                <br> 
                            Wear</span>
                        </h3>
                        <p>Create a blog post subtitle that summarizes your post in a few short, punchy sentences and entices your</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-img">
                        <img src="./assets/section5.jpg" alt="">
                    </div>
                    <div class="card-content">
                        <h3>
                            <span>5 Ways to Take Care of Your Glasses</span>
                        </h3>
                        <p>Create a blog post subtitle that summarizes your post in a few short, punchy sentences and entices your</p>
                    </div>
                </div>
            </div>

            <div class="learn-more-btn">
                <a href="#">Learn More</a>
            </div>
        </div>
    </section>

    <!-- Footer-i -->

    <footer>
        <div class="boxes">
            <div class="box">
                <div class="logo">
                    <a href="home.html">FRAIS</a>
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
                        <li><a href="/our-story.html">OUR STORY</a></li>
                        <li><a href="/contact.html">CONTACT US</a></li>
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
        <span>?? 2023 by Frais. Powered and secured by Students</span>
    </div>

            

    




    <!-- Scripts -->
    <script src="./js/script.js"></script>
    <script src="./js/slider.js"></script>
</body>
</html>