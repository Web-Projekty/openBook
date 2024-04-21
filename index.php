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
                >_<a class="logo" href="">Open\|/Book</a></div>
            <a href="login.php" class="link">
                <h2 id='login' onmouseenter="textAdd('login')" onmouseleave="stop_timeout()">
                    <?php
                    if (!empty($_SESSION["logged_in"])) {
                        if ($_SESSION["logged_in"] == true) {
                            echo $_SESSION["username"];
                        }
                    } else {
                        echo "log in";
                    }
                    ?></h2>
            </a>

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

            if (isset($_GET["page"])) {
                $page = $_GET["page"];
            } else {
                $page = 1;
            }
            if (isset($page)) {
                #import of mySQL config file
                include("db_config/mySQL_config.php");

                #mySQL connection and data SELECT
                $mySQL = mysqli_connect($host, $user, $password, $database);
                $query = "SELECT * FROM post ORDER BY date DESC";
                $query_return = mysqli_query($mySQL, $query);

                #assign number of posts before data processsing
                $postNumber = mysqli_num_rows($query_return);

                #setting post limit & counter
                $maxPost = $page * 5;
                $minPost = $maxPost - 4;
                $postId = 0;

                #mySQL data output
                while ($query_result = mysqli_fetch_assoc($query_return)) {
                    $postId++;
                    /* debug

                    echo "<br>post id: ";echo $postId;
                    echo "<br> min post:";
                    echo $minPost;
                    echo "<br>maxpost:";
                    echo $maxPost; */

                    if ($postId >= $minPost && $postId <= $maxPost) {

                        #get username
                        $query_user = "SELECT * FROM user WHERE userID = " . $query_result["userID"];
                        $query_result_user = mysqli_fetch_assoc(mysqli_query($mySQL, $query_user));

                        #data output
                        echo "

                            <div class='post_container'>";
                        //var_dump($query_result_user);
                        if (isset($query_result_user["userImgID"])) {
                            echo "<img src='img/profile/profile_" . $query_result_user["userImgID"];
                        } else {
                            echo "<img src='img/profile/profile_0";
                        }
                        echo ".png' alt='user_logo' class='profile_logo'>
                                <h3 class='username'>" . $query_result_user["userName"] . "</h3>
                                <h4>" . $query_result["postName"] . "</h4>
                                <img class='post' src='img/post/post_" . $query_result["postID"] . ".png' alt='post_img'>
                            </div>
                        ";
                    }
                };

                mysqli_close($mySQL);

                #pageCount declaration
                $pageCount = ceil($postNumber / 5);

                if ($pageCount > 1) {
                    echo "<footer>
                    <div class='pages'>";

                    #selective declaration of $i

                    $minPage = $page - 2;
                    $maxPage = $page + 2;
                    while ($minPage < 1 || $maxPage > $pageCount) {
                        #debug
                        //echo "<br>max:" . $maxPage . "<br>min:" . $minPage;
                        if ($minPage < 1) {
                            $minPage++;
                        }
                        if ($maxPage > $pageCount) {
                            $maxPage--;
                        }
                    }
                    if ($page < 3) {
                        //echo "loloec";
                        while ($maxPage != $pageCount) {
                            if ($maxPage - $minPage == 4) {
                                break;
                            }
                            $maxPage++;
                        }
                    }
                    if ($pageCount - $page < 3) {
                        //echo "trolec";
                        while ($maxPage - $minPage != 4) {
                            $minPage--;
                            if ($minPage == 0) {
                                $minPage++;
                                break;
                            }
                        }
                    }

                    for ($i = $minPage; $i <= $maxPage; $i++) {
                        #show selected page
                        if ($i == $page) {
                            echo "<a class='pages-text' href='/index.php?page=" . $i . "' style=' font-weight: bold'>" . $i . "</a>";
                        } else {
                            echo "<a class='pages-text' href='/index.php?page=" . $i . "'>" . $i . "</a>";
                        }
                    }
                }
                echo "</div>
                </footer>";
            }


            ?>
            <!-- footer template
             <footer>
                <div class="pages">
                    <p class="pages-text">lol</p>
                    <p class="pages-text">lol</p>
                    <p class="pages-text">lol</p>
                    <p class="pages-text">lol</p>
                    <p class="pages-text">lol</p>
                    </div>
            </footer>-->
            <a href="/index.php"></a>
        </div>
    </div>
    <div class="grid-item6"></div>
    </div>
</body>

</html>