<?php
$view = new stdClass();
$view->pageTitle = "Auctions";
require_once('Models/AuctionData.php');
require_once('logout.php');

//All auction data is placed in a variable
$auctionData = new AuctionData();
{
    $view->auctionData = $auctionData->getAuctions();
}

require_once('Views/auction.phtml');