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
        $x = " chat van: " . $_GET["chat"];
        return $x;
    } else {
        return "select a chat to start chating";
    }
}
function error() 
{
    if ($_GET["error"]){
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
    <title>Document</title>
    <link rel="stylesheet" typle="text/css" href="style.css">
    <link rel="stylesheet" typle="text/css" href="scrol.css">
    <script src="script.js" defer></script>
    <script src="jquery.min.js"></script>

</head>
<body>
    <?php include_once("nav_bar.php")?>
    <div id="movingElement" class="screen">
        <div class="side-bar" id="small-size-remove">
            <form class="" action="add_friend.php?id=<?= $user_id; ?>&chat=<?= $_GET["chat"] ?>" method="post">
                <input  type="text" class="max-size" name="add_name" placeholder="add a name">
            </form>
            <p class="red"><?= error()?></p>
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
        


    <div class="scrol-main-chat">
        <div>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>
            <p>kek</p>

        </div>       
    </div>





    <script>
        $(document).ready(function() {
            setInterval(function() {
                console.log("kek")
                $.ajax({
                    url: 'check-updates.php?id=<?php if (isset($highest_id)) {echo $highest_id;} ?>&chater_id=<?php if (isset($chater_id)) {echo $chater_id;} ?>&user_id=<?= $user_id ?>',
                  dataType: 'json',
                  success: function(data) {
                    console.log(data)
                    if (data == true){
                        location.reload();
                    }
                }
              });
          }, 500);   
        });
    </script>
</body>
</html>