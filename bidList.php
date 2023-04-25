<?php
$view = new stdClass();
$view->pageTitle = 'Bid Items'; //The home page for the project
require_once('Models/ItemData.php');
require_once('Models/BidData.php');
require_once('logout.php');

//New bidData and itemData object
$bidData = new BidData();
$itemData = new ItemData();

//session for user ID placed in a variable
$user = $_SESSION['userId'];

//steps necessary to display the bids for an item
if (isset($_SESSION['loggedIn'])) {
    $user = $_SESSION['userId'];
    $view->bidData = $bidData->checkBid($user);
    $view->countBid = $bidData->countBid($user);

    if (($view->bidData) == true) {
        $view->itemData = $itemData->fetchBidItems($user);

    } else {
        $view->error = "No bids have been placed";
    }
}
else
    {
        $view->error = "You need to login into your account....";
    }


require_once('Views/bidList.phtml');
