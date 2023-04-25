<?php
require_once("Models/ItemData.php");

$r = new ItemData();

$q = $_REQUEST["q"];
//method to search for an item
$item = $r->searchForItem($q);

// start the session engine
session_start();
// retrieve the token
$token="";
if (isset($_SESSION["ajaxToken"])) {
    $token = $_SESSION["ajaxToken"]; }
// check the token is valid
if (!isset($_GET["token"]) || $_GET["token"] != $token) {
    $data = new stdClass();
    $data->error = "No data for you sir"; echo json_encode($data);
} else {
    echo json_encode($item);

}
