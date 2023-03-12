<?php

    include 'config.php';

    session_start();
    
    $admin_id = $_SESSION['admin_id'];

    if(!isset($admin_id)) {
        header('location:login:php');
    }

    if(isset($_GET['delete'])) {
        $delete_id = $_GET['delete'];
        mysqli_query($conn, "DELETE FROM `users` WHERE id = '$delete_id'") or die('query failed');
        header('location:admin_users.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Webpage Title -->
    <title>Admin Users</title>

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



    <section class="users">
        
        <h1 class="title">All Users</h1>

        <div class="box__users">

            <?php
                $select_users = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
                while($fetch_users = mysqli_fetch_assoc($select_users)) {
            ?>

            <div class="box__user">
                    <p> Username : <span><?php echo $fetch_users['name']; ?></span></p>
                    <p> Email : <span><?php echo $fetch_users['email']; ?></span></p>
                    <p> User Type : <span><?php echo $fetch_users['user_type']; ?></span></p>
                    <a href="admin_users.php?delete=<?php echo $fetch_users['id']; ?>" onclick="return confirm('Delete this User?');" class="user_delete_btn">Delete</a>
            </div>

            <?php
                };
            ?>
        </div>
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