<?php

session_start();
include_once "connect.php";

if (!isset($_POST["username"])) {
    header("Location: index.php");
    die();
} else if (
    strlen($_POST["username"]) <= 1 &&
    strlen($_POST["username"]) >= 99
) {
    header(
        "location: profiel.php?error=the name or password is to big or small". strlen($_POST["username"])
    );
    die();
}
echo "kek";
$username = $_POST["username"];
$stmt = $pdo->prepare("SELECT * FROM users WHERE username=?");
$stmt->execute([$username]);
$user = $stmt->fetch();
if (isset($user)) {
    header("location: profiel.php?error=name is alrdy used");
}

$stmt = $pdo->prepare("SELECT id FROM users WHERE username = :name");
$stmt->bindParam(":name", $_SESSION["username"]);
$stmt->execute();
$result = $stmt->fetch();
$user_id = $result["id"];

$new_name = $_POST["username"];
$sql = "UPDATE `users` SET `username` = ? WHERE `users`.`id` = ?;";
$stmt = $pdo->prepare($sql);
$stmt->execute([$new_name, $user_id]);

$_SESSION["username"] = $new_name;
header("Location: index.php");
die();