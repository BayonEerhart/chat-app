

<?php

include("connect.php");

function id_to_name($id, $pdo) 
{
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id =:id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result["username"];
}

$statement = $pdo->prepare("SELECT MAX(id) as max_id FROM messages");
$statement->execute();
$result = $statement->fetch(PDO::FETCH_ASSOC);
$big_id = $result['max_id'];




for ($i = 1; $i <= $big_id; $i++) {
    $stmt = $pdo->prepare("SELECT * FROM messages WHERE id = :id");
    $stmt->bindParam(":id", $i);
    $stmt->execute();
    $result = $stmt->fetch();
    if ($result["sender_id"] == $chater_id && $result["recipient_id"] == $user_id  || $result["sender_id"] == $user_id && $result["recipient_id"] == $chater_id) {
    ?>
    <script>console.log("<?= $result["content"] ?>")</script>

    <div class="flex-row ">
        <img class="list_php" src="pfp/<?=pfp(id_to_name($result["sender_id"], $pdo))?>" alt="">
        <div>
            <h3><?php echo id_to_name($result["sender_id"], $pdo)?></h3>
            <p ><?= $result["content"]; ?></p>
        </div>
    </div>
    <script>console.log(<?= $big_id?>)</script>
<?php }}?>

<script>let highest_id = <?= $big_id ?>;</script>

