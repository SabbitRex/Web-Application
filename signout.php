<?php
session_start();
if(isset($_SESSION["isLoggedIn"]))
{
    session_unset();
    session_destroy();
    header("location: index.php?signout=true");
}
?>