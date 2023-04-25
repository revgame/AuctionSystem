<?php
require_once("Models/ItemData.php");

$r = new ItemData();

$z = $_REQUEST["z"];
//method to fetch auction data
$item = $r->fetchAuctionItems($z);

//json encode for items
echo json_encode($item);

