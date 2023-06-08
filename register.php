<?php

include_once "connect.php";

session_start();
if (isset($_SESSION["loggedInUser"])) {
    header("Location: index.php");
    die();
}
if (isset($_POST["password"]) && isset($_POST["username"])) {
    if (
        strlen($_POST["username"]) <= 99 &&
        strlen($_POST["username"]) >= 1 &&
        strlen($_POST["password"]) <= 99 &&
        strlen($_POST["password"]) >= 1
    ) {
        $username = $_POST["username"];
        $pass = $_POST["password"];
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username=?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        if (!$user) {
            $sql =
                "INSERT INTO  users SET username=?, password=?, friends='[]';";
            $pdo->prepare($sql)->execute([$username, $pass]);
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
        } else {
            $massage = "user name alrdy exist";
        }
    } else {
        $massage = "the name or password is to big or small";
    }
}
if (isset($massage)){
    echo "<p>". $massage . "</p>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" typle="text/css" href="style.css">
    <title>resgister</title>
</head>
<body>
    <form method="post">
        <input name="username" type="text">
        <input name="password" type="password">
        <input type="submit" value="register!">    
    </form>
    <a href="login.php">login</a>
</body>
</html>