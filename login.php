<?php

include_once "connect.php";

session_start();
unset($_SESSION["loggedInUser"]);
unset($_SESSION["username"]);

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $pass = $_POST["password"];
    $stmt = $pdo->prepare(
        "SELECT * FROM users WHERE username = :username AND password = :password"
    );
    $stmt->execute(["username" => $username, "password" => $pass]);
    $user = $stmt->fetch();
    if ($user !== false) {
        $_SESSION["loggedInUser"] = $user["id"];
        $_SESSION["username"] = $username;
        header("Location: index.php");
        die();
    }
    echo "Gebruikersnaam of wachtwoord is ongeldig.";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" typle="text/css" href="style.css">
    <title>login</title>
</head>
<body>
    <div>
        <form method="post">
            <input name="username" type="text">
            <input name="password" type="password">
            <input type="submit" value="login!">    
        </form>
        <a href="register.php">register</a>
    </div>
</body>
</html>
