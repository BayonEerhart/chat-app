<?php

session_start();
include_once "connect.php";
$stmt = $pdo->prepare("SELECT id FROM users WHERE username = :name");
$stmt->bindParam(":name", $_SESSION["username"]);
$stmt->execute();
$result = $stmt->fetch();
$user_id = $result["id"];
$target_dir = "pfp/"; 
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$target_file = $target_dir . $user_id . ".png";
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); 
if (
    $imageFileType != "jpg" &&
    $imageFileType != "png" &&
    $imageFileType != "jpeg"
) {
    header("Location: profiel.phpr");
    exit();
}

if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    echo "The file " .
        basename($_FILES["image"]["name"]) .
        " has been uploaded.";
    header("Location: profiel.php");
    die();
}
header("Location: profiel.php");
exit();
?>