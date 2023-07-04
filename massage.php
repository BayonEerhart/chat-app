

<?php
function pfp($id)
{
    if (file_exists("pfp/$id.png")) {
        return "$id.png";
    }
    return "none.png";
}


session_start();
if ($_GET['sender'] != $_SESSION["username"]) {?>
    <div class="flex-row ">
        <img class="list_php" src="pfp/<?=pfp($_GET["chater_id"])?>" alt="">
        <div>
            <h3><?=$_GET["chat_name"]?></h3>
            <p class=><?=$_GET["data"]?></p>
        </div>
    </div>
<?php } else { ?>
    <div class="flex-row ">
        <img class="list_php" src="pfp/<?=pfp($user_id)?>" alt="">
        <div>
            <h3><?=$_SESSION["username"]?></h3>
            <p><?=$_GET["data"]?></p>
        </div>
    </div>

<?php }?>

 