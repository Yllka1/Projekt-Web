<?php 

    include 'config.php';

    if(isset($_POST['submit'])){

        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
        $cpass = mysqli_real_escape_string($conn, md5($_POST['password']));
        $user_type = $_POST['user_type'];
     
        $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');
     
        if(mysqli_num_rows($select_users) > 0){
           $message[] = 'User already exist!';
        }else{
           if($pass != $cpass){
              $message[] = 'confirm password not matched!';
           }else{
              mysqli_query($conn, "INSERT INTO `users`(name, email, password, user_type) VALUES('$name', '$email', '$cpass', '$user_type')") or die('query failed');
              $message[] = 'Registered successfully!';
           }
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
     <title>Register</title>

    <!-- Styles / CSS -->
    <link rel="stylesheet" href="./css/login__register.css">
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

    <div class="register__form">
        <form action="" method="post">
            <h3>Register Now</h3>
            <input type="text" name="name" placeholder="Name" required class="box" id="name">
            <input type="email" name="email" placeholder="Email" required class="box" id="email"> 
            <input type="password" name="password" placeholder="Password" required class="box" id="password"> 
            <input type="password" name="confirm_password" placeholder="Confirm your Password" required class="box" id="confirm_password"> 
            <select name="user_type" class="box" id="choose" required>
                <option value=""></option>
                <option value="user">User</option>
                <option value="admin" >Admin</option>
            </select>
            <input type="submit" name="submit" value="Register Now" class="btn" id="register_now">
            <p>Alreadry have an account? <a href="login.php">Login now!</a></p>
        </form>
    </div>


    <script src="./js/form_validation.js"></script>
</body>
</html>