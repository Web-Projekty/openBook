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
    <title>>_Open\|/Book - Register</title>
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
            <a href="login.php" class="link">
                <h2 id='login' onmouseenter="textAdd('login')" onmouseleave="stop_timeout()">
                    <?php
                    if ($_SESSION["logged_in"] == true) {
                        echo "username_here";
                    } else {
                        echo "log in";
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
                    <input type="submit" class="button" value=">_register">
                    <p style="display: none;" id="warning" class="center">
                        <?php
                        #hidden if js doesn't change dislay property 
                        if ($_GET["username"] != null) echo "this user stole your username: <a id='user_link' href= '' >" . $_GET["username"] . "</a>";

                        ?>
                    </p>
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


    if ($_GET["username"] == null || $_GET["password"] == null) {
        if ($_GET["username"] == null) {
            $_SESSION["msg"] .= "username, ";
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

        #username check
        $query = "SELECT userID FROM user WHERE userName = '$username'";
        #runs SQL query
        $query_return = mysqli_query($mySQL, $query);
        #makes associative array
        $query_result = mysqli_fetch_assoc($query_return);
        #user exists check
        if ($query_result != NULL) {
            #script for "this user stole your username" message
            $msg = "this user stole your username: ";
            echo "<script>
    var element1 = document.getElementById('form_border')
    element1.style.border = '2px red dashed'
    var element2 = document.getElementById('warning')
    element2.style.display = ''
    var element3 = document.getElementById('user_link')
    element3.href = '" ./*insert user page address -> */ "here/" . $query_result["userID"] . "'
</script>";
        } else {
            $query = "INSERT INTO `user` (`userID`, `userName`, `userImgID`, `password`) VALUES (NULL, '" . $username . "', NULL, '" . $password . "')";
            $query_return = mysqli_query($mySQL, $query);
        }
    }
    if ($_SESSION["msg"] != null) {
        #script for fucked up form
        echo "<script>
    var element1 = document.getElementById('form_border')
    element1.style.border = '2px red dashed'
    var element2 = document.getElementById('warning')
    element2.innerHTML = '>_missingElements[" . $_SESSION["msg"] . "]'
    element2.style.display = ''
</script>";
    }
}


?>

</html>