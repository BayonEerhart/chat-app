<?php

include_once "connect.php";
session_start();


if (!isset($_SESSION["loggedInUser"])) {
    header("Location: login.php");
    die();
}


function pfp($id)
{
    if (file_exists("pfp/$id.png")) {
        return "$id.png";
    }
    return "none.png";
}
function name()
{
    if (isset($_GET["chat"])) {
        return $_GET["chat"];
    }
}
function chat()
{
    if (isset($_GET["chat"])) {
        $x = $_GET["chat"];
        return $x;
    } else {
        return "chat van:";
    }
}

if (!isset($_SESSION[chat()])){
    $_SESSION[chat()] = 0;
}
 

function error() 
{
    if (isset($_GET["error"]) && $_GET["error"]){
        return $_GET["error"];
    } else {
        return;
    }
}

$stmt = $pdo->prepare("SELECT id FROM users WHERE username = :name");
$stmt->bindParam(":name", $_SESSION["username"]);
$stmt->execute();
$result = $stmt->fetch();
$user_id = $result["id"];

$stmt = $pdo->prepare("SELECT id FROM users WHERE username = :name");
$stmt->bindParam(":name", $_GET["chat"]);
$stmt->execute();
$result = $stmt->fetch();
if (isset($result["id"])){
    $chater_id = $result["id"];
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>chat-app</title>
    <link rel="stylesheet" typle="text/css" href="style.css">
    <link rel="stylesheet" typle="text/css" href="scrol.css">
    <script src="script.js" defer></script>
    <script src="jquery.min.js"></script>

</head>
<body>
    <script>console.log($_SESSION[chat()])</script>
    <?php include_once("nav_bar.php")?>
    <div id="movingElement" class="flex-row">
        <div class="side-bar" id="small-size-remove">
            <form class="" action="add_friend.php?id=<?= $user_id; ?>&chat=<?= $_GET["chat"] ?>" method="post">
                <input  type="text" class="max-size" name="add_name" placeholder="add a name">
            </form>
            <p class="red"><?php echo  error()?></p>
            <div>
                <?php
                $stmt = $pdo->query(
                    "SELECT * FROM users ORDER BY `username` ASC;"
                );
                $result = $stmt->fetchAll();
                foreach ($result as $i) {
                    if (
                        in_array($user_id, json_decode($i["friends"], true)) || isset($_GET["show"])
                        )  {
                        if ($i["username"] != $_SESSION["username"]) { 
                            ?>
                            <a class="side-bar-items" href="index.php?chat=<?php echo $i["username"]; ?>">
                                <img class="list_php" src="pfp/<?php echo pfp($i["id"]); ?>" alt="pfp">
                                <p class="tekst-container somting"><?php echo $i["username"]; ?></p>
                            </a>
                    <?php }
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <div id="sceen-resize">
        <div id="chat-container"></div>

    </div>

    <script>
        $(document).ready(function() {
            setInterval(function() {
                $.ajax({
                    url: 'check-updates.php?id=<?php if (isset($_SESSION["highest_id"])) {echo $_SESSION["highest_id"];} ?>&chater_id=<?php if (isset($chater_id)) {echo $chater_id;} ?>&user_id=<?= $user_id ?>',
                    dataType: 'json',
                    success: function(data) {
                        
                    $(document).ready(function() {
                    $.ajax({
                        url: "massage.php?data=" + data[0] + "&sender=" + data[1] + "&chater_id=<?=$chater_id?>&chat_name=<?php echo chat()?>", 
                        type: "GET",
                        success: function(response) {
                            $("#chat-container").html(response);
                        }
                    }); 
                  });
                }
              });
          }, 1000);   
        });
        
    </script>
</body>
</html>