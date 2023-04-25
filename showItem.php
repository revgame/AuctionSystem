<?php
$view = new stdClass();
$view->pageTitle = 'View Item'; //The home page for the project
require_once('Models/BidData.php');
require_once('Models/ItemData.php');
require_once('logout.php');

$singleItem = new ItemData();
$bidData = new BidData();

//Save the id in a variable
if(isset($_GET['id'])){
    $id = $_GET['id'];

}else{
    echo "no id found";
}

$user = $_SESSION['userId'];

{
    //get the current bid for an item
    $view->currentAmount = $bidData->currentAmount($id, $user);
    if ($view->currentAmount == NULL)
    {
        $view->currentAmount = " You have no bids placed yet madam";
    }
}

{
    //Fetch the data for a single item
    $view->singleItem = $singleItem->fetchAnItem($id);

}

{
    //Fetch teh data for the highest bid for a item
    $view->amount = $bidData->highestBid($id);
    if (!isset($view->amount)){
        $view->none = "No bid has been set";
    }
}

//If bid button is pressed then make bid
    if (isset($_POST['bidItem']))
    {
        $amount = $_POST['bidNumber'];
        if ($amount > $view->amount){
            $bidData->makeBid($id, $user, $amount);
            header("location:showItem.php?id=".$id);
        }
        else
        {
            $view->error = "You need to enter a bid higher than the current";
        }
    }
        //Status of the bid
        if ($view->currentAmount < $view->amount) {

            $view->status = "YOU HAVE BEEN OUTBIDDED.......";
        } else {
            $view->status = "YOU ARE WINNING THIS LOT......";
        }

        //Get the auction date
    $view->endDate = $singleItem->fetchAuctionDate($id);



require_once ("Views/showItem.phtml");
