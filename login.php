<!DOCTYPE html>
<html lang="en">

<head>
    <!-- import of set-up files -->
    <?php
    include("session/session_start.php");
    setPage(1);
    ?>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>>_Open\|/Book - Login</title>
    <link rel="shortcut icon" href="logo/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="style/style.css" />
    <script src="js/script.js"></script>
</head>

<body>
    <div class="grid">
        <div class="grid-item1"></div>
        <div class="grid-item2">
            <!-- Logo-->
            <div>
                >_<a class="logo">Open\|/Book</a></div>
            <a href="register.php" class="link">
                <h2 id='login' onmouseenter="textAdd('login')" onmouseleave="stop_timeout()">
                    <?php
                    if ($_SESSION["logged_in"] == true) {
                        echo "username_here";
                    } else {
                        echo "register";
                    }
                    ?></h2>
            </a>

        </div>
        <div class="grid-item3"></div>
        <div class="grid-item4"></div>
        <div class="grid-item5">
            <div class="login">
                <form method="get" class="login_form">
                    <input type="text" name="username" class="input">
                    <input type="password" name="password" class="input">
                    <input type="submit" class="button" value=">_login">
                </form>
            </div>
        </div>
        <div class="grid-item6"></div>
    </div>
</body>

</html>