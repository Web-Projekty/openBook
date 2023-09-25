<?php
session_start();
#check if the user is logged in
$_SESSION["logged_in"] = false;
#Id of page - usefull for page presets
function setPage($page)
{
    $_SESSION["page"] = $page;
    #page index
    #1->login
}
