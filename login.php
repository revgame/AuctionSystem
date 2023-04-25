<?php
$view = new stdClass();
$view->pageTitle = 'Login';

require_once('Models/User.php');
$userSet = new User();

if (isset($_POST['loginButton']))
{
    //check if the input field are empty
    if (!empty($_POST['email']) && !empty($_POST['pwd']))
    {
        $email = $_POST['email'];
        $pwd = $_POST['pwd'];

        //verify that a user is created
        if($userSet->verifyUser($email, $pwd))
        {
            //save data into sessions
            session_start();
            $_SESSION['loggedIn'] = true;
            $_SESSION['name'] = $userSet->getName();
            $_SESSION['userId'] = $userSet->getId();
            header("location:index.php");
        }
        else
        {
            $view->error = "Invalid email or password";
        }
    }
    else
    {
        $view->error = "Please fill type email/password";
    }
}
require_once('Views/login.phtml');

