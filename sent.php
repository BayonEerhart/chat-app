<?php

include_once "connect.php";

session_start();

function name_to_id($pdo, $name)
{
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = :name");
    $stmt->bindParam(":name", $name);
    $stmt->execute();
    $result = $stmt->fetch();
    $matching_id = $result["id"];
    return $matching_id;
}

if (!isset($_SESSION["loggedInUser"])) {
    header("Location: login.php");
    die();
}
if (!isset($_GET["recipient_id"]) || $_GET["recipient_id"] == "" || $_GET["recipient_id"] == "chat van:") {
    header("location: index.php");
    die();
} elseif ($_POST["massage"] == "") {
    header("location: index.php?chat=" . $_GET["recipient_id"]);
    die();
} else {
    $sql =
        "INSERT INTO messages (sender_id, recipient_id, content) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $sender_id = name_to_id($pdo, $_SESSION["username"]);
    $recipient_id = name_to_id($pdo, $_GET["recipient_id"]);
    $content = $_POST["massage"];
    $stmt->execute([$sender_id, $recipient_id, $content]);
    header("location: index.php?chat=" . $_GET["recipient_id"]);
}








