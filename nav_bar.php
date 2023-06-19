<nav>
    <h2 id="small-size-remove" class="side-bar-item1 white-text">welcome <?= $_SESSION["username"]?></h2>
    <a id="small-size-apear" class="nav-bar-settings" href="name_list.php">
        <div class="arrow-container">
            <img class="arrow-img" src="img/arrow.png" alt="arrow back">
        </div>
    </a>
    <h2 class="white-text" ><?= chat(); ?></h2>
    <div class="column arrow-container">
        <a href="login.php">logout</a>
        <a href="profiel.php">profiel</a>
        <a href="change_log.html">change log</a>
    </div>
</nav>








