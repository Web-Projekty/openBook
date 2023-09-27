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
                >_<a class="logo" href="/">Open\|/Book</a></div>
            <a href="register.php" class="link">
                <h2 id='login' onmouseenter="textAdd('login')" onmouseleave="stop_timeout()">
                    <?php
                    if (!empty($_SESSION["logged_in"])) {
                        if ($_SESSION["logged_in"] == true) {
                            echo $_SESSION["username"];
                        }
                    } else {
                        echo "register";
                    }

                    ?></h2>
            </a>

        </div>
        <div class="grid-item3"></div>
        <div class="grid-item4"></div>
        <div class="grid-item5">
            <div class="login" id="form_border" style="border-color: inherit;">
                <form method="get" class="login_form">
                    <input type="text" name="username" class="input" value="">
                    <input type="password" name="password" class="input">
                    <input type="submit" class="button" value=">_log in">
                    <p style="display: none;" id="warning" class="center"></p>
                </form>
            </div>
        </div>
        <div class="grid-item6"></div>
    </div>
</body>
<?php
#msg declare
$_SESSION["msg"] = "";
#form data check
if (!empty($_GET["username"]) || !empty($_GET["password"])) {
    #creates a message for user warning
    if ($_GET["username"] == null || $_GET["password"] == null) {
        if ($_GET["username"] == null) {
            $_SESSION["msg"] .= "username";
        }
        if ($_GET["password"] == null) {
            $_SESSION["msg"] .= "password";
        }
    } else {
        #import of mySQL config file
        include("db_config/mySQL_config.php");

        #mySQL connection
        $mySQL = mysqli_connect($host, $user, $password, $database);


        #form data handling
        $username = $_GET["username"];
        $password = hash("snefru", $_GET["password"]);
        //var_dump($password);
        //echo $password;
        #password select
        $query = "SELECT password, userID FROM user WHERE userName = '$username'";
        #runs SQL query
        $query_return = mysqli_query($mySQL, $query);
        #makes associative array
        $query_result = mysqli_fetch_assoc($query_return);
        if (isset($query_result["password"])) {
            if ($query_result["password"] == $password) {
                echo "
            <script>
                var element1 = document.getElementById('form_border')
                element1.style.border = '2px green dashed'
                var element2 = document.getElementById('warning')
                element2.innerHTML = '>_logged in succesfully'
                element2.style.display = ''
            </script>";
                $_SESSION["logged_in"] = true;
                $_SESSION["username"] = $username;
            } else {
                echo "
            <script>
                var element1 = document.getElementById('form_border')
                element1.style.border = '2px red dashed'
                var element2 = document.getElementById('warning')
                element2.innerHTML = '>_username & password dont match'
                element2.style.display = ''
            </script>";
            }
        } else {
            echo "
            <script>
                var element1 = document.getElementById('form_border')
                element1.style.border = '2px red dashed'
                var element2 = document.getElementById('warning')
                element2.innerHTML = '>_user doesnt exist'
                element2.style.display = ''
            </script>";
        }
    }
    if ($_SESSION["msg"] != null) {
        #script for fucked up form
        echo "
            <script>
                var element1 = document.getElementById('form_border')
                element1.style.border = '2px red dashed'
                var element2 = document.getElementById('warning')
                element2.innerHTML = '>_missingElements[" . $_SESSION["msg"] . "]'
                element2.style.display = ''
            </script>";
        unset($_SESSION["msg"]);
    }
}
?>

</html>