<?php
session_start();
#Id of page - usefull for page presets
function setPage($page)
{
    $_SESSION["page"] = $page;
    #page index
    #1->login
}
