<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KPI Settings</title>
    <?php include('css/style.php'); ?>
</head>
<body>
<?php 
if(!isset($_GET['p'])){
    include('pages/main.php');
}
if(isset($_GET['p']) && $_GET['p']=='main'){
    include('pages/main.php');
}
if(isset($_GET['p']) && $_GET['p']=='settings'){
    include('pages/setting.php');
}
?>
<?php include('js/bootstrap.php'); ?>
<script src="js/custom.js"></script>
</body>
</html>