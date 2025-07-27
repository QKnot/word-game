<?php
session_start();
$servername = "localhost";
$user = "root";
$password = "";
$database = "wordGame";
$connection = mysqli_connect($servername, $user, $password, $database);
if(!$connection){
    echo "Not connected";
}
$message = "";
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "select * from users where email='$email' and password='$password'";
    $data = mysqli_query($connection, $query);
    $n = mysqli_num_rows($data);
    if($n == 1){
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        header('location:game.php');
        exit();
    }else if($n >= 1){
        $message = "Multiple User are there in the same name";
    }else{
        $message = "Invalid Password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f3f4f6;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 350px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box; 
        }
        button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            margin-bottom: 10px; 
            cursor: pointer;
        }
        .login-btn {
            background-color: #4CAF50;
            color: white;
        }
        .login-btn:hover {
            background-color: #45a049;
        }
        .register-btn {
            background-color: #2196F3;
            color: white;
        }
        .register-btn:hover {
            background-color: #1976D2;
        }
        .message {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <form method="POST">
        <h2>Login Page</h2>
        <?php
        if (!empty($message))
            echo "<div class='message'>$message</div>";
        ?>
        <input type="email" placeholder="Email" name="email" required>
        <input type="password" placeholder="Password" name="password" required>
        <button type="submit" name="submit" class="login-btn">Login</button>
        <button type="button" class="register-btn" onclick="window.location.href='registration.php'">Registration</button>
    </form>
</body>
</html>