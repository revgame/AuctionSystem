<?php
session_start();

//If logout button is pressed then delete sessions
if (isset($_POST['logoutB']))
{
    unset($_SESSION['loggedIn']);
    session_destroy();
    header("location:index.php");
}


