<?php 
require('../includes/config.php'); 
require('../class/Main.php'); 
if(isset($_POST['categoryID'])){
    extract($_POST);

    $main=new MainClass();
    echo $main->addSubCategory($pdo,$categoryID,$subcatname,$subcatweight);
}
?>