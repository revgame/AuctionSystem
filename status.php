<?php
require_once('Models/ItemData.php');
require_once('Models/BidData.php');
require_once('logout.php');

$user = $_SESSION['userId'];

$bidData = new BidData();
$status = "";
$f = $_REQUEST['f'];


    $currentA = $bidData->currentAmount($f, $user);
    $amountH = $bidData->highestBid($f);

    if($amountH != NULL) {
        if ($currentA < $amountH) {

            $status = "LOSING......";
        } else {
            $status = "WINNING......";
        }
    }
    else{
        $status = "No bids have been placed";
    }

echo $status;




