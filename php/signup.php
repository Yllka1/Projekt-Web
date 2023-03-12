<?php
    session_start();

    if( isset($_SESSION['user_id']) ){
        header("Location: /");
    }

    require 'includes/dbconnect.php';

    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $message = '';

        $sql = 'INSERT INTO users (name, email, password) VALUES (:name, :email, :password)';
        $query = $pdo->prepare($sql);
        $query->bindParam('name', $name);
        $query->bindParam('email', $email);
        $query->bindParam('password', $password);
        
        if($query->execute()) {
            $message = "Successfully created your account";
        } else {
            $message = "A problem occurred creating your account";
        }
    }
?>

<div class="mt-2">
    <div class="container">
        <?php 
            if(!empty($message)) {
                echo "<p>$message</p>";
            } 
        ?>
        <h1>Register</h1>
        <span>or <a href="login.php">login here</a></span>
        <form action="signup.php" method="post">
            <input type="text" name="name" placeholder="Enter your name"><br>
            <input type="text" name="email" placeholder="Enter your email"><br>
            <input type="password" name="password" placeholder="Enter your password"><br>
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
</div>