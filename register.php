<?php
$view = new stdClass();
$view->pageTitle = 'Login';
require_once('Models/User.php');

$userSet = new User();

if (isset($_POST['signInButton']))
{
    //check if the input field are empty
    if (!empty($_POST['email']) || !empty($_POST['pwd'])) {
        $email = $_POST['email'];
        $pwd = $_POST['pwd'];
        $name = $_POST['name'];
        if(!$userSet->checkEmail($email))
        {
            //if passwords are the same then register the iser
            if ($_POST['pwd'] == $_POST['confirmPwd'])
            {
                $userSet->registerUser($name, $email, $pwd);
                //Create sessions for the variables
                session_start();
                $_SESSION['name'] = $name;
                $_SESSION['loggedIn'] = true;
                header("location:login.php");

            } else {
                $view->error = "Password does not match";
            }
        }
        else
        {
            $view->error = "Email has been used";
        }
    }
    else
    {
        $view->error = "Please fill type email/password";
    }
}

require_once('Views/register.phtml');


