<?php 
require('../includes/config.php'); 
require('../class/Main.php'); 
$main=new MainClass();
if(isset($_POST['accountID'])){
    extract($_POST);
    $main=new MainClass();
    echo $main->getCampaign($pdo,$accountID);
}
?>
<script>
$('.selectme').select2();
</script>