<?php
require_once('Models/BidData.php');
require_once('logout.php');

$ItemBid = new bidData();

//request and user ID both placed in different variables
session_start();
$c = $_SESSION['userId'];
$d = $_REQUEST['d'];

//Method called to count the bid for the user ID
$bidNo = $ItemBid->countBid($c);
echo $bidNo;
