<?php

include_once "connect.php";

function id_to_name($id, $pdo) 
{
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id =:id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result["username"];
}

$user_id = $_GET["user_id"];
$chater_id = $_GET["chater_id"];  #
$old_id = $_GET["id"];            #

$highest_id_of_x = "highest_id_of_" . id_to_name($old_id, $pdo);

$stmt = $pdo->prepare("SELECT * FROM messages ORDER BY id DESC");
$stmt->execute();
$rows = $stmt->fetchAll();

foreach ($rows as $row) {
    if (    
        ($row["sender_id"] == $user_id && $row["recipient_id"] == $chater_id) ||
        ($row["sender_id"] == $chater_id && $row["recipient_id"] == $user_id)
    ) {
        if ($row["id"] > $old_id) {
            echo json_encode([$row["content"], id_to_name($row["sender_id"], $pdo), $row["id"]]);
            die();
        }
    }
}
?>
