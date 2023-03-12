<?php 

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)) {
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
    <title>Admin Home Panel</title>

    <!-- Styles / CSS -->
    <link rel="stylesheet" href="./css/admin-style.css">
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

    <!-- Admin dashboard section starts -->

    <section class="dashboard">
        <h1 class="dashboard__title">Dashboard</h1>

        <div class="dashboard-container">

            <div class="dashboard-box">
                <?php
                    $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
                    $number_of_products = mysqli_num_rows($select_products);
                ?>
                <h3><?php echo $number_of_products; ?></h3>
                <p>Products Added</p>
            </div>
            
            <div class="dashboard-box">
            <?php 
                $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'user'") or die('query failed');
                $number_of_users = mysqli_num_rows($select_users);
            ?>
            <h3><?php echo $number_of_users; ?></h3>
                <p>Normal Users</p>
            </div>

            <div class="dashboard-box">
                <?php
                    $select_admins = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'admin' ") or die('query failed');
                    $number_of_admins = mysqli_num_rows($select_admins);
                ?>
                <h3><?php echo $number_of_admins; ?></h3>
                <p>Admin Users</p>
            </div>

            <div class="dashboard-box">
                <?php
                    $select_account = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
                    $number_of_account = mysqli_num_rows($select_account);
                ?>
                <h3><?php echo $number_of_account; ?></h3>
                <p>Total Users</p>
            </div>

            <div class="dashboard-box">
                <?php
                    $select_messages = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
                    $number_of_messages = mysqli_num_rows($select_messages);
                ?>
                <h3><?php echo $number_of_messages; ?></h3>
                <p>New Messages</p>
            </div>

    </section>

    <!-- Admin dashboard section ends -->































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