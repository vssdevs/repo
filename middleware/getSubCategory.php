<?php 
require('../includes/config.php'); 
require('../class/Main.php'); 
$main=new MainClass();
if(isset($_POST['accountID'])){
    extract($_POST);
}
?>
<div class="card-header">
    <button onclick="hidesubcat()" class="btn btn-danger float-right mb-2">&times</button>
    </div>
    <div class="card-body">
    <label>Category</label>

    <select class="form-control selectme" id="categoryID">
                                <option value="">Select Category </option>
                                <?php 
                                echo $main->getCategory($pdo,$accountID);
                                ?>
    </select> 
                       
    <label>Sub-Category</label>
    <input class="form-control" id="subcatname">
    <label>Sub-Category Weight</label>
    <input class="form-control" id="subcatweight">        
    <button onclick="addsubcat()" class="btn btn-warning mt-2">Save</button>
</div>
<script>
$('.selectme').select2();
</script>