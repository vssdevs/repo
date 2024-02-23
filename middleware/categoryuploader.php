<?php
require('../includes/config.php'); 
require('../class/Main.php'); 
$main=new MainClass();
if ($_FILES['file']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['file']['tmp_name'])) {
    
    $filename=$_FILES["file"]["tmp_name"];
     if($_FILES["file"]["size"] > 0)
     {
          $i=0;  
          set_time_limit(0);
          $file = fopen($filename, "r");
          while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
           {
            if(!empty($getData[0])){
                $i=$main->insertcatvalues($pdo,$getData);
                $i+=$i;
            }
            
           }
           if($i>0){
            echo 1;
           }else{
            echo "something went wrong!";
           }
           fclose($file);
     }
 
} else {
    echo "Error: " . $_FILES['file']['error'];
}
?>