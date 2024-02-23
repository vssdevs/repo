<?php 
require('../includes/config.php'); 
require('../class/Main.php'); 
if(isset($_POST['accountID'])){
    extract($_POST);

    $main=new MainClass();
    $rows=$main->getAllCategory($pdo,$accountID,$campaignID);
    
   foreach($rows as $row){ 
    ?>
    
    <div class="col-lg-12 bg-warning"><?php echo $row['id'];?> - <?php echo $row['category_name'];?> <span style="float:right;color:#000000;background-color: #23232;" class="badge badge-secondary"><?php echo $row['weight'];?></span></div>
   <?php
        $cat=$main->getAllsubCategory($pdo,$row['id']);
        foreach($cat as $catrow){ ?>
             <li><?php echo $catrow['id'];?> - <?php echo $catrow['subcategory_name'];?> <span style="float:right;color:#000000;background-color: #23232;" class="badge badge-secondary"><?php echo $catrow['weight'];?></span></li>   
       <?php }
       
    }    
}
?>