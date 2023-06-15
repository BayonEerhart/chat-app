<?php


include_once "connect.php";
$user_id = $_GET["user_id"];
$chater_id = $_GET["chater_id"];  #
$old_id = $_GET["id"];            #

$stmt = $pdo->prepare("SELECT * FROM messages ORDER BY id DESC");
$stmt->execute();
$rows = $stmt->fetchAll();

foreach ($rows as $row) {
    if (    
        ($row["sender_id"] == $user_id && $row["recipient_id"] == $chater_id) ||
        ($row["sender_id"] == $chater_id && $row["recipient_id"] == $user_id)
    ) {
        echo json_encode("kek");
        die();
        if ($row["id"] > $old_id) {

            echo json_encode("hi");
            die();
        }
    }
}
?>

