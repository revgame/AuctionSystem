<?php
require_once('Models/BidData.php');
require_once('logout.php');

//request for lot id placed in a variable
$bidData = new BidData();
$a = $_REQUEST['a'];

//method to get the highest bid for an item
$amount = $bidData->highestBid($a);
echo $amount;