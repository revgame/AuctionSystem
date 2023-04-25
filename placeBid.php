<?php
require_once('Models/BidData.php');
require_once('logout.php');

$ItemBid = new bidData();
$b = $_REQUEST['b'];

//variables for storing user Id and ajax request
session_start();
$c = $_SESSION['userId'];
$d = $_REQUEST['d'];

//method to make bid for an item
$ItemBid->makeBid($b, $c, $d);

