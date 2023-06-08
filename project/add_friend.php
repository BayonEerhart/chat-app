<?php

include_once "connect.php";

if (isset($_POST["add_name"])) {
    $name = $_POST["add_name"];
}else if (isset($_GET["add_name"])) {
    $name = $_GET["add_name"];
} else {
    header("Location: index.php");
    die();
}
$stmt = $pdo->prepare("SELECT id FROM users WHERE username = :name");
$stmt->bindParam(":name", $name);
$stmt->execute();
$result = $stmt->fetch();
var_dump($result);
if (isset($result["id"])){
    $chater_id = $result["id"];
} 
$stmt = $pdo->prepare("SELECT friends FROM users WHERE id = :id");
$stmt->bindParam(":id", $id);

$id = $_GET["id"];
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$friends_json = $result["friends"];

$friends_array = json_decode($friends_json, true);
if (!isset($chater_id)) {
    echo "try";
    header("Location: index.php?chat=" . $_GET["chat"] . "&error=user%20does%20not%20exist");
    die();
}
if (in_array($chater_id, $friends_array)) {
    header("Location: index.php?error=alrdy exist&chat=" . $_POST["add_id"]);
    die();
}
$friends_array[] = $chater_id;

$new_friends_json = json_encode($friends_array);

$sql = "UPDATE users SET friends = :new_friends_json WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":id", $id);
$stmt->bindParam(":new_friends_json", $new_friends_json);
$stmt->execute();

$stmt = $pdo->prepare("SELECT friends FROM users WHERE id = :id");
$stmt->bindParam(":id", $chater_id);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

$friends_json = $result["friends"];

$friends_array = json_decode($friends_json, true);

$friends_array[] = intval($_GET["id"]);

$new_friends_json = json_encode($friends_array);

$sql = "UPDATE users SET friends = :new_friends_json WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":id", $chater_id);
$stmt->bindParam(":new_friends_json", $new_friends_json);
$stmt->execute();
header("Location: index.php?chat=" . $name);
die();