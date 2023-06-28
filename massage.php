<?php

// include_once "connect.php";
// $user_id = $_GET["user_id"];
// $chater_id = $_GET["chater_id"];
// $old_id = $_GET["id"];

// $stmt = $pdo->prepare("SELECT * FROM messages ORDER BY id DESC");
// $stmt->execute();
// $rows = $stmt->fetchAll();

// foreach ($rows as $row) {
//     if (
//         ($row["sender_id"] == $user_id && $row["recipient_id"] == $chater_id) ||
//         ($row["sender_id"] == $chater_id && $row["recipient_id"] == $user_id)
//     ) {
//         if ($row["id"] > $old_id) {
//             $list = [$row["content"], $row["sender_id"]];
//             echo json_encode($list);
//             die();
//         }
//         echo json_encode(false);
//         die();
//     }
// }
?>


<div class="flex-row">
    <img class="list_php" src="pfp/none.png" alt="">
    <div>
        <h3>name2</h3>
        <p>hi</p>
    </div>
</div>