<?php
$view = new stdClass();
$view->pageTitle = 'Home'; //The home page for the project
require_once('Models/ItemData.php');
require_once('logout.php');

$searchData = new ItemData();

//If sButton is presses, search for the item
    if (isset($_POST['sButton']))
    {
        $searchText = $_POST['sText'];
        $view->searchData = $searchData->searchForItem($searchText);
        $view->turnUp = true;
    }

    //creating a token
$view->token = substr(str_shuffle(MD5(microtime())),0,20);

    //creating a session for the token
$_SESSION["ajaxToken"] = $view->token;

require_once('Views/index.phtml');