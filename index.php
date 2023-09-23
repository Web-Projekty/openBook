<!DOCTYPE html>
<html lang="cs">

<head>
    <!-- import of set-up files -->
    <?php
    include("session/session_start.php");
    ?>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>>_Open\|/Book - Home</title>
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
                >_<a class="logo">Open\|/Book
                </a></div>
            <a href="login.php" class="link"><h2 id='login' onmouseenter="text_add('login')" onmouseleave="stop_timeout()">
                <?php
                if ($_SESSION["logged_in"] == true) {
                    echo "log in";
                } else {
                    echo "register";
                }
                ?></h2></a>

        </div>
        <div class="grid-item3"></div>
        <div class="grid-item4"></div>
        <!-- !!POST template!!
             <div class="content">
            <div class="post_container">
                <img src="img/profile/profile_x.png" alt="user_logo" class="profile_logo">
                <h3 class="username">username</h3>
                <h4>post_descripiton</h4>
                <img class="post" src="img/post/post_x.png" alt="post_img">
            </div>
-->
        <div class="content">
            <?php

            #import of mySQL config file
            include("db_config/mySQL_config.php");

            #mySQL connection and data SELECT
            $mySQL = mysqli_connect($host, $user, $password, $database);
            $query = "SELECT * FROM post ORDER BY date DESC";
            $query_return = mysqli_query($mySQL, $query);

            #mySQL data output
            while ($query_result = mysqli_fetch_assoc($query_return)) {

                #get username
                $query_user = "SELECT * FROM user WHERE userID = " . $query_result["userID"];
                $query_result_user = mysqli_fetch_assoc(mysqli_query($mySQL, $query_user));

                #data output
                echo "
            
                <div class='post_container'>
                    <img src='img/profile/profile_" . $query_result_user["userImgID"] . ".png' alt='user_logo' class='profile_logo'>
                    <h3 class='username'>" . $query_result_user["userName"] . "</h3>
                    <h4>" . $query_result["postName"] . "</h4>
                    <img class='post' src='img/post/post_" . $query_result["postID"] . ".png' alt='post_img'>
                </div>
            ";
                //var_dump($query_result);
            };

            mysqli_close($mySQL);
            ?>

        </div>
    </div>
    <div class="grid-item6"></div>
    </div>
</body>

</html>