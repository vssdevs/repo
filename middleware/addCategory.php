<?php 
require('../includes/config.php'); 
require('../class/Main.php'); 
if(isset($_POST['accountID'])){
    extract($_POST);

    $main=new MainClass();
    echo $main->addCategory($pdo,$accountID,$campaignID,$catname,$orderID,$catweight);
}
?>