<?php
$view = new stdClass();
$view->pageTitle = 'All Lots'; //The home page for the project
require_once('Models/ItemData.php');
require_once('logout.php');

//Sets the page currently on
if (!isset ($_GET['pageno']) ) {
    $view->pageno = 1;
} else {
    $view->pageno = $_GET['pageno'];
}

$itemData = new ItemData();

$no_of_records_per_page = 30;
$offset = ($view->pageno-1) * $no_of_records_per_page;

{
    //fetches all items according to their offset and number of records per page
    $view->itemData = $itemData->fetchItems($offset, $no_of_records_per_page);
    //var_dump($view->itemData);
}

//gets the total number of pages
$view->total_pages = $itemData->recordNumber($no_of_records_per_page );

require_once('Views/allLots.phtml');

