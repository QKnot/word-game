<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "wordGame";
    $connection = new mysqli($servername, $username, $password, $dbname);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $message = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = htmlspecialchars($_POST["name"]);
        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);
        $stmt = $connection->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $password);
        
        if ($stmt->execute()) {
            $message = "<p style='color: green; text-align: center;'>Registration successful!</p>";
            header('location:index.php');
            exit();
        } else {
            $message = "<p style='color: red; text-align: center;'>Error: " . $stmt->error . "</p>";
        }
        
        $stmt->close();
    }
        $connection->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registration Form</title>
<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: #f3f4f6;
        margin: 0;
        font-family: Arial, sans-serif;
        padding: 20px;
    }
    form {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 400px;
        max-width: 100%;
    }
    h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }
    input, textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box; /
    }
    input[type="file"] {
        padding: 5px;
    }
    button {
        width: 100%;
        padding: 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
    }
    button:hover {
        background-color: #45a049;
    }
    textarea {
        resize: vertical;
        font-family: Arial, sans-serif;
    }
</style>
</head>
<body>
<form method="POST">
    <h2>Registration Form</h2>
    <?php
    if (!empty($message)) {
        echo $message;
    }
    ?>
    <input type="text" name="name" placeholder="Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Register</button>
</form>
</body>
</html>