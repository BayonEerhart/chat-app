<?php
include_once "connect.php";

session_start();

if (!isset($_SESSION["loggedInUser"])) {
    header("Location: login.php");
    die();
}
$stmt = $pdo->prepare("SELECT * FROM users WHERE username = :name");
$stmt->bindParam(":name", $_SESSION["username"]);
$stmt->execute();
$result = $stmt->fetch();

function pfp($id)
{
    if (file_exists("pfp/$id.png")) {
        return "$id.png";
    }
    return "none";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="login ">   
        <form  action="sent_pfp.php" method="post" enctype="multipart/form-data">
            <div class="upload">
                <input type="file" name="image">
                <input type="submit" value="change profiel picture">
            </div>
        </form>
    </div>
<form method="post" action="edit_profiel.php" class="login" style="margin-top: 2% ">
    <p>
        <?php if (isset($_GET["error"])) {
            echo $_GET["error"];
        } ?></p>
    <label for="username">username:</label>
    <input type="text" name="username" value=<?= $result["username"] ?>>
    <div>
        <a href="index.php" style="width: 100%;"><input style="width: 100%;" type="button" value="go back back"></a>
        <input type="submit" value="save">
    </div>
</form>


<script>
</body>
</html>
