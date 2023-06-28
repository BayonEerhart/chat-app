<?php

session_start();
include("connect.php");
function error() 
{
    if (isset($_GET["error"]) && $_GET["error"]){
        return $_GET["error"];
    } else {
        return;
    }
}
function pfp($id)
{
    if (file_exists("pfp/$id.png")) {
        return "$id.png";
    }
    return "none.png";
}
if (!isset($_SESSION["loggedInUser"])) {
    header("Location: login.php");
    die();
}
$stmt = $pdo->prepare("SELECT id FROM users WHERE username = :name");
$stmt->bindParam(":name", $_SESSION["username"]);
$stmt->execute();
$result = $stmt->fetch();
$user_id = $result["id"];
?>  
  
  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>list of names</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body class="friend-list">
        <div >
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
</body>
</html>