<?php 
class MainClass{
    public function getCampaign($pdo,$accountID){
        $options="<option value=''>select campaign</option>";
        $stmt = $pdo->prepare("SELECT * FROM campaign where account_id=:accountID");
        $stmt->bindParam(':accountID', $accountID);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            $options.= "<option value=".$row['id'].">".$row['id']."   ".$row['campaign_name']."</option>";
        }
        return $options;
    }
    public function getAccount($pdo){
        $options="";
        $stmt = $pdo->query("SELECT * FROM program");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            $options.= "<option value=".$row['id']."> ".$row['id']." ".$row['programName']."</option>";
        }
        return $options;
    }
    public function addCategory($pdo,$accountID,$campaignID,$catname,$orderID,$catweight){
        // Insert data into the database
        $stmt = $pdo->prepare("INSERT INTO scorecard_category (category_name,orderID,accountID,campaignID,weight) VALUES (:catname, :orderID,:accountID,:campaignID,:weight)");
        $stmt->bindParam(':catname', $catname);
        $stmt->bindParam(':orderID', $orderID);
        $stmt->bindParam(':accountID', $accountID);
        $stmt->bindParam(':campaignID', $campaignID);
        $stmt->bindParam(':weight', $catweight);

        // Execute the prepared statement
        $stmt->execute();
        return 1;
        
    }
    public function addSubCategory($pdo,$categoryID,$subcatname,$subcatweight){
        $stmt = $pdo->prepare("INSERT INTO scorecard_subcategory (categoryID,subcategory_name,weight) VALUES (:categoryID, :subcatname,:subcatweight)");
        $stmt->bindParam(':subcatname', $subcatname);
        $stmt->bindParam(':categoryID', $categoryID);
        $stmt->bindParam(':subcatweight', $subcatweight);
        $stmt->execute();
        return 1;
    }
    public function getCategory($pdo,$accountID){
        $options="";
        $stmt = $pdo->prepare("SELECT * FROM scorecard_category where accountID = :accountID");
        $stmt->bindParam(':accountID', $accountID);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            $options.= "<option value=".$row['id'].">".$row['category_name']."</option>";
        }
        return $options;
    }
    public function getAllCategory($pdo,$accountID,$campaignID){
       
        if(!empty($accountID) && empty($campaignID)){
            $stmt = $pdo->prepare("SELECT * FROM scorecard_category where accountID = :accountID order by orderID asc");
            $stmt->bindParam(':accountID', $accountID);
        }else if(!empty($accountID) && !empty($campaignID)){
            $stmt = $pdo->prepare("SELECT * FROM scorecard_category where accountID = :accountID and campaignID=:campaignID order by orderID asc");
            $stmt->bindParam(':accountID', $accountID);
            $stmt->bindParam(':campaignID', $campaignID);
        }
       
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return  $rows;
    }
    public function getAllsubCategory($pdo,$catID){
     
        $stmt = $pdo->prepare("SELECT * FROM scorecard_subcategory where categoryID = :catID");
        $stmt->bindParam(':catID', $catID);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return  $rows;
    }
    public function insertcatvalues($pdo,$getData){
            $empID=$getData[0];
            $accountID=$getData[1];
            $campaignID=$getData[2];
            $month=$getData[3];
            $catID=$getData[4];
            
            $actual=$getData[5];
            $target=$getData[6];
            $ni1=$getData[7];
            $ni2=$getData[8];
            $be1=$getData[9];
            $be2=$getData[10];
            $me1=$getData[11];
            $me2=$getData[12];
            $ee1=$getData[13];
            $ee2=$getData[14];
            $oe1=$getData[15];
            $oe2=$getData[16];
            $scale=$getData[17];
            $rating=$getData[18];
            $year=$getData[19];
            $overallrating=$getData[20];
            $overallscore=$getData[21];
            $eligible=$getData[22];
            $bonus=$getData[23];

        $stmt = $pdo->prepare("SELECT * FROM category_values where empID = :empID and accountID = :accountID and month=:month and year=:year");
        $stmt->bindParam(':accountID', $accountID);
        $stmt->bindParam(':empID', $empID);
        $stmt->bindParam(':month', $month);
        $stmt->bindParam(':year', $year);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(count($rows)>0){
            $istmt = $pdo->prepare("update category_values set campaignID=:campaignID,month=:month,catID=:catID,actual=:actual,target=:target,ni1=:ni1,ni2=:ni2,
            be1=:be1,be2=:be2,me1=:me1,me2=:me2,ee1=:ee1,ee2=:ee2,oe1=:oe1,oe2=:oe2,scale=:scale,rating=:rating, year=:year,overallrating=:overallrating, overallscore=:overallscore,eligible=:eligible,bonus=:bonus where empID=:empID and accountID=:accountID");
            $istmt->bindParam(':empID', $empID);
            $istmt->bindParam(':accountID', $accountID);
            $istmt->bindParam(':campaignID', $campaignID);
            $istmt->bindParam(':month', $month);
            $istmt->bindParam(':catID', $catID);
            $istmt->bindParam(':actual', $actual);
            $istmt->bindParam(':target', $target);
            $istmt->bindParam(':ni1', $ni1);
            $istmt->bindParam(':ni2', $ni2);
            $istmt->bindParam(':be1', $be1);
            $istmt->bindParam(':be2', $be2);
            $istmt->bindParam(':me1', $me1);
            $istmt->bindParam(':me2', $me2);
            $istmt->bindParam(':ee1', $ee1);
            $istmt->bindParam(':ee2', $ee2);
            $istmt->bindParam(':oe1', $oe1);
            $istmt->bindParam(':oe2', $oe2);
            $istmt->bindParam(':scale', $scale);
            $istmt->bindParam(':rating', $rating);
            $istmt->bindParam(':year', $year);
            $istmt->bindParam(':overallrating', $overallrating);
            $istmt->bindParam(':overallscore', $overallscore);
            $istmt->bindParam(':eligible', $eligible);
            $istmt->bindParam(':bonus', $bonus);
            $istmt->execute();
            return  1;
        }else{
            $istmt = $pdo->prepare("insert into category_values(empID,accountID,campaignID,month,catID,actual,target,ni1,ni2,be1,be2,me1,me2,ee1,ee2,oe1,oe2,scale,rating,year,overallrating,overallscore,eligible,bonus)
            values(:empID,:accountID,:campaignID,:month,:catID,:actual,:target,:ni1,:ni2,:be1,:be2,:me1,:me2,:ee1,:ee2,:oe1,:oe2,:scale,:rating,:year,:overallrating,:overallscore,:eligible,:bonus)");
            $istmt->bindParam(':empID', $empID);
            $istmt->bindParam(':accountID', $accountID);
            $istmt->bindParam(':campaignID', $campaignID);
            $istmt->bindParam(':month', $month);
            $istmt->bindParam(':catID', $catID);
            $istmt->bindParam(':actual', $actual);
            $istmt->bindParam(':target', $target);
            $istmt->bindParam(':ni1', $ni1);
            $istmt->bindParam(':ni2', $ni2);
            $istmt->bindParam(':be1', $be1);
            $istmt->bindParam(':be2', $be2);
            $istmt->bindParam(':me1', $me1);
            $istmt->bindParam(':me2', $me2);
            $istmt->bindParam(':ee1', $ee1);
            $istmt->bindParam(':ee2', $ee2);
            $istmt->bindParam(':oe1', $oe1);
            $istmt->bindParam(':oe2', $oe2);
            $istmt->bindParam(':scale', $scale);
            $istmt->bindParam(':rating', $rating);
            $istmt->bindParam(':year', $year);
            $istmt->bindParam(':overallrating', $overallrating);
            $istmt->bindParam(':overallscore', $overallscore);
            $istmt->bindParam(':eligible', $eligible);
            $istmt->bindParam(':bonus', $bonus);
            $istmt->execute();
            return  1;
        }
        
    }
    public function insertsubcatvalues($pdo,$getData){
        $empID=$getData[0];
        $accountID=$getData[1];
        $campaignID=$getData[2];
        $catID=$getData[3];
        $actual=$getData[4];
        $target=$getData[5];
        $month=$getData[6];
        $year=$getData[7];
        
        

    $stmt = $pdo->prepare("SELECT * FROM subcategory_values where empID = :empID and accountID = :accountID and campaignID=:campaignID and month=:month and year=:year and subcategoryID=:subcatID");
    $stmt->bindParam(':accountID', $accountID);
    $stmt->bindParam(':empID', $empID);
    $stmt->bindParam(':campaignID', $campaignID);
    $stmt->bindParam(':month', $month);
    $stmt->bindParam(':year', $year);
    $stmt->bindParam(':subcatID',  $catID);    
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if(count($rows)>0){
        $istmt = $pdo->prepare("update subcategory_values set actual=:actual,target=:target where empID=:empID and accountID=:accountID and campaignID=:campaignID and month=:month and year=:year");
        $istmt->bindParam(':empID', $empID);
        $istmt->bindParam(':accountID', $accountID);
        $istmt->bindParam(':campaignID', $campaignID);
        $istmt->bindParam(':actual', $actual);
        $istmt->bindParam(':target', $target);
        $istmt->bindParam(':month', $month);
        $istmt->bindParam(':year', $year);
        $istmt->execute();
        return  1;
    }else{
        $istmt = $pdo->prepare("insert into subcategory_values(empID,accountID,campaignID,subcategoryID,actual,target,month,year)
        values(:empID,:accountID,:campaignID,:catID,:actual,:target,:month,:year)");
        $istmt->bindParam(':empID', $empID);
        $istmt->bindParam(':accountID', $accountID);
        $istmt->bindParam(':campaignID', $campaignID);
        $istmt->bindParam(':catID', $catID);
        $istmt->bindParam(':actual', $actual);
        $istmt->bindParam(':target', $target);
        $istmt->bindParam(':month', $month);
        $istmt->bindParam(':year', $year);
       
        $istmt->execute();
        return  1;
    }
    
}
   
}
?>