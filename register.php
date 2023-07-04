<?php

include_once "connect.php";

session_start();
if (isset($_SESSION["loggedInUser"])) {
    header("Location: index.php");
    die();
}
if (isset($_POST["password"]) && isset($_POST["username"]) && $_SESSION["code"] ==  $_POST["code"]) {
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
            $sql = "INSERT INTO  users SET username=?, email=? password=?, friends='[]';";
            $pdo->prepare($sql)->execute([$username, $_GET['email'], $pass]);
            $stmt = $pdo->prepare(
                "SELECT * FROM users WHERE username = :username AND password = :password"
            );
            $stmt->execute(["username" => $username, "email" => $_GET['email'], "password" => $pass]);
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
    <form action="mail_sender.php" method="get">
        <input type="email" name="email" value="<?php if (isset($_GET['email'])){echo $_GET['email'];} else {echo 'email plz';}?>">
        <input style="<?php if (isset($_GET['email'])){echo "background-color: green;";}?>" type="submit" value="get code">    
    </form>
    <form method="post">
        <input name="code" type="text"> 
        <input name="username" type="text">
        <input name="password" type="password">
        <input type="submit" value="register!">    
    </form>
    <a href="login.php">login</a>
</body>
</html>