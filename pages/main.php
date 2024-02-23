<?php 
require('includes/config.php'); 
require('class/Main.php'); 
?>
<div class="container">
    <div class="row mt-5">
            <div class="col-lg-8">
                <label>Account</label>
                <select onchange="getcampaign()" class="form-control selectme" id="accountID" name="accountID">
                        <option value="">select account</option>
                        <?php 
                           $main= new MainClass();
                          echo $main->getAccount($pdo);      
                        ?>
                </select>  
                <label>Campaign</label>
                <select onchange="getcategory()" class="form-control selectme" id="campaignID" name="campaignID">
                        <option value="">select campaign</option>
                        
                </select> 
                <br><br>
                <label>Category Score Upload</label>
                <form action="" id="uploadForm" method="post" class="mt-2" enctype="multipart/form-data">
                <input type="file" name="file" id="file">
                <button id="catbtn">Upload <i id="spin1"></i></button>
                </form><br>
                <label>Sub-Category Score Upload</label>
                <form action="" id="uploadForm2" method="post" class="mt-2" enctype="multipart/form-data">
                <input type="file" name="file" id="file2">
                <button id="subbtn">Upload <i id="spin2"></i></button>
                </form>
                <button class="btn btn-primary mt-2"  style="float:right;" onclick="showsubcat()">Add Sub-Category</button> <button onclick="showcat()" class="btn btn-primary mt-2 m-2" style="float:right;">Add Category</button> 
                <br><br>
                <br>
                                <div id="datacontainer" class="col-lg-12">
                </div>
                 
            </div>
            <div class="col-lg-4" id="catergorysetting">
                <div class="card" id="catcontainer">
                    <div class="card-header">
                             <button onclick="hidecat()" class="btn btn-danger float-right mb-2">&times</button>
                    </div>
                    <div class="card-body">
                    <label>Category</label>

                        <input class="form-control" id="categoryname">
                        
                        <label>Order</label>
                        <select class="form-control" id="orderID">
                                <option value="">Select Order </option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                        </select> 
                        <label>Weight</label>
                        <input class="form-control" id="catweight">
                        <button onclick="addcat()" class="btn btn-warning mt-2">Save</button>
                    </div>
                </div>
                <div class="card" id="subcatcontainer">
                        
                </div>
            
            
            </div>
            
    </div>
</div>


