<?php
require_once('Models/BidData.php');
require_once('logout.php');

//request and user ID both placed in different variables
$ItemBid = new bidData();
$k = $_REQUEST['k'];

session_start();
$c = $_SESSION['userId'];

//Method called to get the current bid amount for a specific user
$current = $ItemBid->currentAmount($k, $c);

echo $current;
