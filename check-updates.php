<?php

include_once "connect.php";
$user_id = $_GET["user_id"];
$chater_id = $_GET["chater_id"];
$old_id = $_GET["id"];

$stmt = $pdo->prepare("SELECT * FROM messages ORDER BY id DESC");
$stmt->execute();
$rows = $stmt->fetchAll();

foreach ($rows as $row) {
    if (
        ($row["sender_id"] == $user_id && $row["recipient_id"] == $chater_id) ||
        ($row["sender_id"] == $chater_id && $row["recipient_id"] == $user_id)
    ) {
        if ($row["id"] > $old_id) {
            echo json_encode(true);
            die();
        }
        die();
    }
}
?>
<script>

'check-updates.php?id=<?php if (isset($highest_id)) {echo $highest_id;} ?>&chater_id=<?php if (isset($chater_id)) { $chater_id;} ?>&user_id=<?= $user_id ?>',

</script>
