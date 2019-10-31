<?php
    include "connection.php";

    /*Sign In*/
    if(isset($_POST['login'])){ 
        session_start();

        $adminname = $_POST['adminname'];
        $adminpassword = $_POST['adminpassword'];
        

        $querySignIn = "select * from adminDetail where adminName = '$adminname' and adminPassword = '$adminpassword'";

        $results = mysqli_query($connection, $querySignIn);
        
        $status = mysqli_num_rows($results);
			if ($status== 1) {
                $_SESSION['adminname'] = $adminname[0].$adminname[1];
                $_SESSION['success'] = "You are now logged in";
                header('location: adminDashboard.php');
			}else {
				echo("Wrong username/password combination" .mysqli_error($connection));
			}
    }
    /*Sign Out*/
    if (isset($_POST['signout'])) {
        session_start();
        $_SESSION[]=array();
        session_destroy();
        header("location: index.php");
      }
    /*Add Assets*/
    extract($_POST);

    if(isset($_POST['assetAddBtn'])){
      $queryAddAsset = "INSERT INTO `assetmanagement`(`assetName`, `assetType`, `manfDate`, `quantity`, `vendor`, 
                `version`, `productKey`, `purchDate`, `assetCondition`, `maintenence`, `perPrice`, `totalPrice`, 
                `availability`) VALUES ('$assetName', '$assetType', '$assetManf', '$assetQuantity', '$assetVendor', '$assetVersion',
               '$assetKey', '$assetPurch', '$assetCondition', '$assetMaintenence', '$assetPerPrice', '$assetTotalPrice', 
                '$assetAvailability')";
      if(mysqli_query($connection, $queryAddAsset)!=1){
        print_r('The following error occured: '.mysqli_error($connection));
      }

    }

    /*List Assets*/
    $queryListAssets = "SELECT assetmanagement.assetName FROM assetmanagement";
    $resultListAssets = mysqli_query($connection, $queryListAssets);


    /*Count Software Assets*/
    if(isset($_POST['totalSoftwareCount'])){
      $queryCountSoftwareAsset = "SELECT COUNT(*) FROM `assetmanagement` WHERE assetType = 'Software'";
      $resultCountSoftwareAsset = mysqli_query($connection, $queryCountSoftwareAsset);
      $data = mysqli_fetch_array($resultCountSoftwareAsset);
      echo $data[0];
    }
    /*Count Hardware Assets*/
    if(isset($_POST['totalHardwareCount'])){
      $queryCountHardwareAsset = "SELECT COUNT(*) FROM `assetmanagement` WHERE assetType = 'Hardware'";
      $resultCountHardwareAsset = mysqli_query($connection, $queryCountHardwareAsset);
      $data = mysqli_fetch_array($resultCountHardwareAsset);
      echo $data[0];
    }
    /*Count All Assets*/
    if(isset($_POST['totalAssetCount'])){
      $queryCountAllAsset = "SELECT COUNT(*) FROM `assetmanagement`";
      $resultCountAllAsset = mysqli_query($connection, $queryCountAllAsset);
      $data = mysqli_fetch_array($resultCountAllAsset);
      echo $data[0];
    }
    /*View All Assets*/
    if(isset($_POST['readAllAsset'])){
      $data = "<h3 class='text-light' style='position: relative;'>All Assets</h3>
                <table class='table table-bordered table-striped bg-light table-responsive rounded'>
                  <tr>
                    <th>Sl.No</th>
                    <th>Asset Name</th>
                    <th>Asset Type</th>
                    <th>Manufature Date</th>
                    <th>Quantity</th>
                    <th>Vendor</th>
                    <th>Version</th>
                    <th>Product Key</th>
                    <th>Purchase Date</th>
                    <th>Condition</th>
                    <th>Maintenence</th>
                    <th>Price Per Piece</th>
                    <th>Total Price</th>
                    <th>Availability</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>";
      $queryShowAllAsset = "SELECT * FROM `assetmanagement`  ORDER BY `assetmanagement`.`sl.no` ASC";
      $resultShowAllAsset = mysqli_query($connection, $queryShowAllAsset);
      
      if(mysqli_num_rows($resultShowAllAsset) > 0){
        $slNo = 1;
        while($rowShowAllAsset = mysqli_fetch_array($resultShowAllAsset)){
          $data .= '<tr>
                      <td>'.$slNo.'</td>
                      <td>'.$rowShowAllAsset['assetName'].'</td>
                      <td>'.$rowShowAllAsset['assetType'].'</td>
                      <td>'.$rowShowAllAsset['manfDate'].'</td>
                      <td>'.$rowShowAllAsset['quantity'].'</td>
                      <td>'.$rowShowAllAsset['vendor'].'</td>
                      <td>'.$rowShowAllAsset['version'].'</td>
                      <td>'.$rowShowAllAsset['productKey'].'</td>
                      <td>'.$rowShowAllAsset['purchDate'].'</td>
                      <td>'.$rowShowAllAsset['assetCondition'].'</td>
                      <td>'.$rowShowAllAsset['maintenence'].'</td>
                      <td>'.$rowShowAllAsset['perPrice'].'</td>
                      <td>'.$rowShowAllAsset['totalPrice'].'</td>
                      <td>'.$rowShowAllAsset['availability'].'</td>
                      <td>
                        <button onclick="getAssetDetails('.$rowShowAllAsset['sl.no'].')"
                          class="btn btn-warning">Edit</button>
                      </td>
                      <td>
                        <button onclick="deleteAsset('.$rowShowAllAsset['sl.no'].')"
                          class="btn btn-danger">Delete</button>
                      </td>
                    </tr>';
                $slNo++;  
        }
      }
      $data .= '</table>';
      echo $data;
    }
    /*View All Assets for Users*/
    if(isset($_POST['readAllAssetUser'])){
      $data = "<h3 class='text-light' style='position: relative;'>All Assets</h3>
                <table class='table table-bordered table-striped bg-light table-responsive rounded'>
                  <tr>
                    <th>Sl.No</th>
                    <th>Asset Name</th>
                    <th>Asset Type</th>
                    <th>Manufature Date</th>
                    <th>Quantity</th>
                    <th>Vendor</th>
                    <th>Version</th>
                    <th>Product Key</th>
                    <th>Purchase Date</th>
                    <th>Condition</th>
                    <th>Maintenence</th>
                    <th>Price Per Piece</th>
                    <th>Total Price</th>
                    <th>Availability</th>
                  </tr>";
      $queryShowAllAssetUser = "SELECT * FROM `assetmanagement`  ORDER BY `assetmanagement`.`sl.no` ASC";
      $resultShowAllAssetUser = mysqli_query($connection, $queryShowAllAssetUser);
      
      if(mysqli_num_rows($resultShowAllAssetUser) > 0){
        $slNo = 1;
        while($rowShowAllAssetUser = mysqli_fetch_array($resultShowAllAssetUser)){
          $data .= '<tr>
                      <td>'.$slNo.'</td>
                      <td>'.$rowShowAllAssetUser['assetName'].'</td>
                      <td>'.$rowShowAllAssetUser['assetType'].'</td>
                      <td>'.$rowShowAllAssetUser['manfDate'].'</td>
                      <td>'.$rowShowAllAssetUser['quantity'].'</td>
                      <td>'.$rowShowAllAssetUser['vendor'].'</td>
                      <td>'.$rowShowAllAssetUser['version'].'</td>
                      <td>'.$rowShowAllAssetUser['productKey'].'</td>
                      <td>'.$rowShowAllAssetUser['purchDate'].'</td>
                      <td>'.$rowShowAllAssetUser['assetCondition'].'</td>
                      <td>'.$rowShowAllAssetUser['maintenence'].'</td>
                      <td>'.$rowShowAllAssetUser['perPrice'].'</td>
                      <td>'.$rowShowAllAssetUser['totalPrice'].'</td>
                      <td>'.$rowShowAllAssetUser['availability'].'</td>
                    </tr>';
                $slNo++;  
        }
      }
      $data .= '</table>';
      echo $data;
    }
    /*View Software Assets*/
    if(isset($_POST['readSoftwareAsset'])){
      $data = "<h3 class='text-light' style='position: relative;'>Software Assets</h3>
                <table class='table table-bordered table-striped bg-light table-responsive rounded'>
                  <tr>
                    <th>Sl.No</th>
                    <th>Asset Name</th>
                    <th>Asset Type</th>
                    <th>Manufature Date</th>
                    <th>Quantity</th>
                    <th>Vendor</th>
                    <th>Version</th>
                    <th>Product Key</th>
                    <th>Purchase Date</th>
                    <th>Maintenence</th>
                    <th>Price Per Piece</th>
                    <th>Total Price</th>
                    <th>Availability</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>";
      $queryShowSoftwareAsset = "SELECT * FROM `assetmanagement`  WHERE `assetmanagement`.`assetType` = 'Software' ORDER BY `assetmanagement`.`sl.no` ASC";
      $resultShowSoftwareAsset = mysqli_query($connection, $queryShowSoftwareAsset);
      
      if(mysqli_num_rows($resultShowSoftwareAsset) > 0){
        $slNo = 1;
        while($rowShowSoftwareAsset = mysqli_fetch_array($resultShowSoftwareAsset)){
          $data .= '<tr>
                      <td>'.$slNo.'</td>
                      <td>'.$rowShowSoftwareAsset['assetName'].'</td>
                      <td>'.$rowShowSoftwareAsset['assetType'].'</td>
                      <td>'.$rowShowSoftwareAsset['manfDate'].'</td>
                      <td>'.$rowShowSoftwareAsset['quantity'].'</td>
                      <td>'.$rowShowSoftwareAsset['vendor'].'</td>
                      <td>'.$rowShowSoftwareAsset['version'].'</td>
                      <td>'.$rowShowSoftwareAsset['productKey'].'</td>
                      <td>'.$rowShowSoftwareAsset['purchDate'].'</td>
                      <td>'.$rowShowSoftwareAsset['maintenence'].'</td>
                      <td>'.$rowShowSoftwareAsset['perPrice'].'</td>
                      <td>'.$rowShowSoftwareAsset['totalPrice'].'</td>
                      <td>'.$rowShowSoftwareAsset['availability'].'</td>
                      <td>
                        <button onclick="getAssetDetails('.$rowShowSoftwareAsset['sl.no'].')"
                          class="btn btn-warning">Edit</button>
                      </td>
                      <td>
                        <button onclick="deleteAsset('.$rowShowSoftwareAsset['sl.no'].')"
                          class="btn btn-danger">Delete</button>
                      </td>
                    </tr>';
                $slNo++;  
        }
      }
      $data .= '</table>';
      echo $data;
    }
    /*View Software Assets for Users*/
    if(isset($_POST['readSoftwareAssetUser'])){
      $data = "<h3 class='text-light' style='position: relative;'>Software Assets</h3>
                <table class='table table-bordered table-striped bg-light table-responsive rounded'>
                  <tr>
                    <th>Sl.No</th>
                    <th>Asset Name</th>
                    <th>Asset Type</th>
                    <th>Manufature Date</th>
                    <th>Quantity</th>
                    <th>Vendor</th>
                    <th>Version</th>
                    <th>Product Key</th>
                    <th>Purchase Date</th>
                    <th>Maintenence</th>
                    <th>Price Per Piece</th>
                    <th>Total Price</th>
                    <th>Availability</th>
                  </tr>";
      $queryShowSoftwareAssetUser = "SELECT * FROM `assetmanagement`  WHERE `assetmanagement`.`assetType` = 'Software' ORDER BY `assetmanagement`.`sl.no` ASC";
      $resultShowSoftwareAssetUser = mysqli_query($connection, $queryShowSoftwareAssetUser);
      
      if(mysqli_num_rows($resultShowSoftwareAssetUser) > 0){
        $slNo = 1;
        while($rowShowSoftwareAssetUser = mysqli_fetch_array($resultShowSoftwareAssetUser)){
          $data .= '<tr>
                      <td>'.$slNo.'</td>
                      <td>'.$rowShowSoftwareAssetUser['assetName'].'</td>
                      <td>'.$rowShowSoftwareAssetUser['assetType'].'</td>
                      <td>'.$rowShowSoftwareAssetUser['manfDate'].'</td>
                      <td>'.$rowShowSoftwareAssetUser['quantity'].'</td>
                      <td>'.$rowShowSoftwareAssetUser['vendor'].'</td>
                      <td>'.$rowShowSoftwareAssetUser['version'].'</td>
                      <td>'.$rowShowSoftwareAssetUser['productKey'].'</td>
                      <td>'.$rowShowSoftwareAssetUser['purchDate'].'</td>
                      <td>'.$rowShowSoftwareAssetUser['maintenence'].'</td>
                      <td>'.$rowShowSoftwareAssetUser['perPrice'].'</td>
                      <td>'.$rowShowSoftwareAssetUser['totalPrice'].'</td>
                      <td>'.$rowShowSoftwareAssetUser['availability'].'</td>
                    </tr>';
                $slNo++;  
        }
      }
      $data .= '</table>';
      echo $data;
    }
    /*View Hardware Assets*/
    if(isset($_POST['readHardwareAsset'])){
      $data = "<h3 class='text-light' style='position: relative;'>Hardware Assets</h3>
                <table class='table table-bordered table-striped bg-light table-responsive rounded'>
                  <tr>
                    <th>Sl.No</th>
                    <th>Asset Name</th>
                    <th>Asset Type</th>
                    <th>Manufature Date</th>
                    <th>Quantity</th>
                    <th>Vendor</th>
                    <th>Purchase Date</th>
                    <th>Condition</th>
                    <th>Price Per Piece</th>
                    <th>Total Price</th>
                    <th>Availability</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>";
      $queryShowHardwareAsset = "SELECT * FROM `assetmanagement`  WHERE `assetmanagement`.`assetType` = 'Hardware' ORDER BY `assetmanagement`.`sl.no` ASC";
      $resultShowHardwareAsset = mysqli_query($connection, $queryShowHardwareAsset);
      
      if(mysqli_num_rows($resultShowHardwareAsset) > 0){
        $slNo = 1;
        while($rowShowHardwareAsset = mysqli_fetch_array($resultShowHardwareAsset)){
          $data .= '<tr>
                      <td>'.$slNo.'</td>
                      <td>'.$rowShowHardwareAsset['assetName'].'</td>
                      <td>'.$rowShowHardwareAsset['assetType'].'</td>
                      <td>'.$rowShowHardwareAsset['manfDate'].'</td>
                      <td>'.$rowShowHardwareAsset['quantity'].'</td>
                      <td>'.$rowShowHardwareAsset['vendor'].'</td>
                      <td>'.$rowShowHardwareAsset['purchDate'].'</td>
                      <td>'.$rowShowHardwareAsset['assetCondition'].'</td>
                      <td>'.$rowShowHardwareAsset['perPrice'].'</td>
                      <td>'.$rowShowHardwareAsset['totalPrice'].'</td>
                      <td>'.$rowShowHardwareAsset['availability'].'</td>
                      <td>
                        <button onclick="getAssetDetails('.$rowShowHardwareAsset['sl.no'].')"
                          class="btn btn-warning">Edit</button>
                      </td>
                      <td>
                        <button onclick="deleteAsset('.$rowShowHardwareAsset['sl.no'].')"
                          class="btn btn-danger">Delete</button>
                      </td>
                    </tr>';
                $slNo++;  
        }
      }
      $data .= '</table>';
      echo $data;
    }
    /*View Hardware Assets for Users*/
    if(isset($_POST['readHardwareAssetUser'])){
      $data = "<h3 class='text-light' style='position: relative;'>Hardware Assets</h3>
                <table class='table table-bordered table-striped bg-light table-responsive rounded'>
                  <tr>
                    <th>Sl.No</th>
                    <th>Asset Name</th>
                    <th>Asset Type</th>
                    <th>Manufature Date</th>
                    <th>Quantity</th>
                    <th>Vendor</th>
                    <th>Purchase Date</th>
                    <th>Condition</th>
                    <th>Price Per Piece</th>
                    <th>Total Price</th>
                    <th>Availability</th>
                  </tr>";
      $queryShowHardwareAssetUser = "SELECT * FROM `assetmanagement`  WHERE `assetmanagement`.`assetType` = 'Hardware' ORDER BY `assetmanagement`.`sl.no` ASC";
      $resultShowHardwareAssetUser = mysqli_query($connection, $queryShowHardwareAssetUser);
      
      if(mysqli_num_rows($resultShowHardwareAssetUser) > 0){
        $slNo = 1;
        while($rowShowHardwareAssetUser = mysqli_fetch_array($resultShowHardwareAssetUser)){
          $data .= '<tr>
                      <td>'.$slNo.'</td>
                      <td>'.$rowShowHardwareAssetUser['assetName'].'</td>
                      <td>'.$rowShowHardwareAssetUser['assetType'].'</td>
                      <td>'.$rowShowHardwareAssetUser['manfDate'].'</td>
                      <td>'.$rowShowHardwareAssetUser['quantity'].'</td>
                      <td>'.$rowShowHardwareAssetUser['vendor'].'</td>
                      <td>'.$rowShowHardwareAssetUser['purchDate'].'</td>
                      <td>'.$rowShowHardwareAssetUser['assetCondition'].'</td>
                      <td>'.$rowShowHardwareAssetUser['perPrice'].'</td>
                      <td>'.$rowShowHardwareAssetUser['totalPrice'].'</td>
                      <td>'.$rowShowHardwareAssetUser['availability'].'</td>
                    </tr>';
                $slNo++;  
        }
      }
      $data .= '</table>';
      echo $data;
    }
    /*View Recent Assets*/
    if(isset($_POST['readRecentAsset'])){
      $data = "<table class='table table-bordered table-striped bg-light table-responsive rounded'>
                  <tr>
                    <th>Sl.No</th>
                    <th>Asset Name</th>
                    <th>Asset Type</th>
                    <th>Manufature Date</th>
                    <th>Quantity</th>
                    <th>Vendor</th>
                    <th>Version</th>
                    <th>Product Key</th>
                    <th>Purchase Date</th>
                    <th>Condition</th>
                    <th>Maintenence</th>
                    <th>Price Per Piece</th>
                    <th>Total Price</th>
                    <th>Availability</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>";
      $queryShowRecentAsset = "SELECT * FROM `assetmanagement` ORDER BY `assetmanagement`.`sl.no` DESC LIMIT 10";
      $resultShowRecentAsset = mysqli_query($connection, $queryShowRecentAsset);
      
      if(mysqli_num_rows($resultShowRecentAsset) > 0){
        $slNo = 1;
        while($rowShowRecentAsset = mysqli_fetch_array($resultShowRecentAsset)){
          $data .= '<tr>
                      <td>'.$slNo.'</td>
                      <td>'.$rowShowRecentAsset['assetName'].'</td>
                      <td>'.$rowShowRecentAsset['assetType'].'</td>
                      <td>'.$rowShowRecentAsset['manfDate'].'</td>
                      <td>'.$rowShowRecentAsset['quantity'].'</td>
                      <td>'.$rowShowRecentAsset['vendor'].'</td>
                      <td>'.$rowShowRecentAsset['version'].'</td>
                      <td>'.$rowShowRecentAsset['productKey'].'</td>
                      <td>'.$rowShowRecentAsset['purchDate'].'</td>
                      <td>'.$rowShowRecentAsset['assetCondition'].'</td>
                      <td>'.$rowShowRecentAsset['maintenence'].'</td>
                      <td>'.$rowShowRecentAsset['perPrice'].'</td>
                      <td>'.$rowShowRecentAsset['totalPrice'].'</td>
                      <td>'.$rowShowRecentAsset['availability'].'</td>
                      <td>
                        <button onclick="getAssetDetails('.$rowShowRecentAsset['sl.no'].')"
                          class="btn btn-warning">Edit</button>
                      </td>
                      <td>
                        <button onclick="deleteAsset('.$rowShowRecentAsset['sl.no'].')"
                          class="btn btn-danger">Delete</button>
                      </td>
                    </tr>';
                $slNo++;  
        }
      }
      $data .= '</table>';
      echo $data;
    }
    /*View Recent Assets for User*/
    if(isset($_POST['readRecentAssetUsers'])){
      $data = "<table class='table table-bordered table-striped bg-light table-responsive rounded'>
                  <tr>
                    <th>Sl.No</th>
                    <th>Asset Name</th>
                    <th>Asset Type</th>
                    <th>Manufature Date</th>
                    <th>Quantity</th>
                    <th>Vendor</th>
                    <th>Version</th>
                    <th>Purchase Date</th>
                    <th>Condition</th>
                    <th>Maintenence</th>
                    <th>Price Per Piece</th>
                    <th>Total Price</th>
                    <th>Availability</th>
                  </tr>";
      $queryShowRecentAssetUsers = "SELECT * FROM `assetmanagement` ORDER BY `assetmanagement`.`sl.no` DESC LIMIT 10";
      $resultShowRecentAssetUsers = mysqli_query($connection, $queryShowRecentAssetUsers);
      
      if(mysqli_num_rows($resultShowRecentAssetUsers) > 0){
        $slNo = 1;
        while($rowShowRecentAssetUsers = mysqli_fetch_array($resultShowRecentAssetUsers)){
          $data .= '<tr>
                      <td>'.$slNo.'</td>
                      <td>'.$rowShowRecentAssetUsers['assetName'].'</td>
                      <td>'.$rowShowRecentAssetUsers['assetType'].'</td>
                      <td>'.$rowShowRecentAssetUsers['manfDate'].'</td>
                      <td>'.$rowShowRecentAssetUsers['quantity'].'</td>
                      <td>'.$rowShowRecentAssetUsers['vendor'].'</td>
                      <td>'.$rowShowRecentAssetUsers['version'].'</td>
                      <td>'.$rowShowRecentAssetUsers['purchDate'].'</td>
                      <td>'.$rowShowRecentAssetUsers['assetCondition'].'</td>
                      <td>'.$rowShowRecentAssetUsers['maintenence'].'</td>
                      <td>'.$rowShowRecentAssetUsers['perPrice'].'</td>
                      <td>'.$rowShowRecentAssetUsers['totalPrice'].'</td>
                      <td>'.$rowShowRecentAssetUsers['availability'].'</td>
                    </tr>';
                $slNo++;  
        }
      }
      $data .= '</table>';
      echo $data;
    }
    /*Delete Asset*/
    if (isset($_POST['deleteId'])) {

      $assetId = $_POST['deleteId'];

      $queryDeleteAsset = "DELETE FROM `assetmanagement` WHERE `assetmanagement`.`sl.no` = $assetId" ;
      mysqli_query($connection, $queryDeleteAsset);
    }
    /*Update Asset*/
    if (isset($_POST['editId']) && isset($_POST['editId']) != "") {

      $editAssetId = $_POST['editId'];

      $queryUpdateAsset = "SELECT * FROM `assetmanagement` WHERE `assetmanagement`.`sl.no`= $editAssetId";
      
      if (!$resultUpdateAsset = mysqli_query($connection, $queryUpdateAsset)) {
          exit(mysqli_error);
      }
      
      $responseUpdateAsset = array();

      if (mysqli_num_rows($resultUpdateAsset) > 0) {
          while ($rowUpdateAsset = mysqli_fetch_assoc($resultUpdateAsset)) {
              $responseUpdateAsset = $rowUpdateAsset;
          }
      }
      else {
          $responseUpdateAsset['status'] = 200;
          $responseUpdateAsset['message'] = "Data Not Found";
      }

      echo json_encode($responseUpdateAsset);
    }
    else{
      $responseUpdateAsset['status'] = 200;
      $responseUpdateAsset['message'] = "Invalid Request"; 
    }

    if (isset($_POST['hiddenassetid'])) {
      $hiddenId = $_POST['hiddenassetid'];
      $updateassettype = $_POST['updateassettype'];
      $updateassetname = $_POST['updateassetname'];
      $updatemanfdate = $_POST['updatemanfdate'];
      $updateassetquantity = $_POST['updateassetquantity'];
      $updateassetvendor = $_POST['updateassetvendor'];
      $updateassetversion = $_POST['updateassetversion'];
      $updateassetkey = $_POST['updateassetkey'];
      $updatepurchdate = $_POST['updatepurchdate'];
      $updateassetcondition = $_POST['updateassetcondition'];
      $updateassetmaintenence = $_POST['updateassetmaintenence'];
      $updateassetperprice = $_POST['updateassetperprice'];
      $updateassettotalprice = $_POST['updateassettotalprice'];
      $updateassetavailability = $_POST['updateassetavailability'];
      
      $querySaveEdit = "UPDATE `assetmanagement` SET `assetName`='$updateassetname',`assetType`='$updateassettype',
                        `manfDate`='$updatemanfdate',`quantity`='$updateassetquantity',`vendor`='$updateassetvendor',
                        `version`='$updateassetversion',`productKey`='$updateassetkey',`purchDate`='$updatepurchdate',
                        `assetCondition`='$updateassetcondition',`maintenence`='$updateassetmaintenence',
                        `perPrice`='$updateassetperprice',`totalPrice`='$updateassettotalprice',
                        `availability`='$updateassetavailability' WHERE `assetmanagement`.`sl.no`= $hiddenId";

      if(mysqli_query($connection, $querySaveEdit)!=1){
        print_r('The following error occured: '.mysqli_error($connection));
      }
    }

    /*Requests*/

    if (isset($_POST['sendRequest'])) {
      $empRequestIn = addslashes($empRequest);
      $queryAddRequest = "INSERT INTO `assetrequest`(`employeeID`, `employeeName`, `employeeMail`, 
                          `requestAsset`, `employeeReason`, status) VALUES ('$empID','$empName','$empMail',
                          '$empAsset','$empRequestIn', '')";
      if(mysqli_query($connection, $queryAddRequest)!=1){
        print_r('The following error occured: '.mysqli_error($connection));
      }
    }

    /*View Requests*/

    $queryViewRequest = "SELECT * FROM `assetrequest` ORDER BY `assetrequest`.`requestID` DESC";
    $resultViewRequest = mysqli_query($connection, $queryViewRequest);

    /*Count Requests*/
    $queryCountRequest = "SELECT COUNT(*) FROM `assetrequest`";
    $resultCountRequest = mysqli_query($connection, $queryCountRequest);
    $dataCountRequest = mysqli_fetch_array($resultCountRequest);

    /*Delete User Request*/
    if (isset($_POST['requestId'])) {

      $reqId = $_POST['requestId'];

      $queryDeleteAsset = "DELETE FROM `assetrequest` WHERE `assetrequest`.`requestID` = $reqId" ;
      mysqli_query($connection, $queryDeleteAsset);
    }

    /*Send Approve Mail*/
    if (isset($_POST['requestID']) && isset($_POST['requestID']) != "") {

      $sendRequestId = $_POST['requestID'];

      $querySendRequestId = "SELECT * FROM `assetrequest` WHERE `assetrequest`.`requestID`= $sendRequestId";
      
      if (!$resultSendRequestId = mysqli_query($connection, $querySendRequestId)) {
          exit(mysqli_error);
      }
      
      $responseSendRequestId = array();

      if (mysqli_num_rows($resultSendRequestId) > 0) {
          while ($rowSendRequestId = mysqli_fetch_assoc($resultSendRequestId)) {
              $responseSendRequestId = $rowSendRequestId;
          }
      }
      else {
          $responseSendRequestId['status'] = 200;
          $responseSendRequestId['message'] = "Data Not Found";
      }

      echo json_encode($responseSendRequestId);
    }
    else{
      $responseSendRequestId['status'] = 200;
      $responseSendRequestId['message'] = "Invalid Request"; 
    }

    if (isset($_POST['sendMailer'])) {

      $to = '$toMail';
      $subject = "Approval to your request.";
      $txt = '$adMessage';
      $headers = "From: kumarshreyas073@gmail.com";
      mail($to,$subject,$txt,$headers);
      
      $queryInsertStatus = "UPDATE `assetrequest` SET `status`= '$status' WHERE assetrequest.requestID = $hiddenID";
      if(mysqli_query($connection, $queryInsertStatus)!=1){
        print_r('The following error occured: '.mysqli_error($connection));
      }
      else{
        print_r ("Success");
      }

    }


    /*Send Reject Mail*/
    if (isset($_POST['requestRejID']) && isset($_POST['requestRejID']) != "") {

      $sendRejRequestId = $_POST['requestRejID'];

      $querySendRejRequestId = "SELECT * FROM `assetrequest` WHERE `assetrequest`.`requestID`= $sendRejRequestId";
      
      if (!$resultSendRejRequestId = mysqli_query($connection, $querySendRejRequestId)) {
          exit(mysqli_error);
      }
      
      $responseSendRejRequestId = array();

      if (mysqli_num_rows($resultSendRejRequestId) > 0) {
          while ($rowSendRejRequestId = mysqli_fetch_assoc($resultSendRejRequestId)) {
              $responseSendRejRequestId = $rowSendRejRequestId;
          }
      }
      else {
          $responseSendRejRequestId['status'] = 200;
          $responseSendRejRequestId['message'] = "Data Not Found";
      }

      echo json_encode($responseSendRejRequestId);
    }
    else{
      $responseSendRejRequestId['status'] = 200;
      $responseSendRejRequestId['message'] = "Invalid Request"; 
    }

    if (isset($_POST['sendRejMailer'])) {

      $to = '$toRejMail';
      $subject = "Rejection to your request.";
      $txt = '$adRejMessage';
      $headers = "From: kumarshreyas073@gmail.com";
      mail($to,$subject,$txt,$headers);
      
      $queryInsertRejStatus = "UPDATE `assetrequest` SET `status`= '$statusRej' WHERE assetrequest.requestID = $hiddenRejID";
      if(mysqli_query($connection, $queryInsertRejStatus)!=1){
        print_r('The following error occured: '.mysqli_error($connection));
      }
      else{
        print_r ("Success");
      }

    }

    /*Search assets*/
    if(isset($_POST['searchText'])){
      $data = " ";
      $querySearch = "SELECT * FROM `assetmanagement` WHERE `assetmanagement`.`assetName` LIKE '%$searchText%'";
      $resultSearch = mysqli_query($connection, $querySearch);
      if(mysqli_num_rows($resultSearch) > 0){
        $slNo = 1;
        $data .= "<h3 class='text-light' style='position: relative;'>Search Result</h3>
                      <table class='table table-bordered table-striped bg-light table-responsive rounded'>
                      <tr>
                        <th>Sl.No</th>
                        <th>Asset Name</th>
                        <th>Asset Type</th>
                        <th>Manufature Date</th>
                        <th>Quantity</th>
                        <th>Vendor</th>
                        <th>Version</th>
                        <th>Product Key</th>
                        <th>Purchase Date</th>
                        <th>Condition</th>
                        <th>Maintenence</th>
                        <th>Price Per Piece</th>
                        <th>Total Price</th>
                        <th>Availability</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>";
          while($rowSearch = mysqli_fetch_array($resultSearch)){
            $data .= '<tr>
                          <td>'.$slNo.'</td>
                          <td>'.$rowSearch['assetName'].'</td>
                          <td>'.$rowSearch['assetType'].'</td>
                          <td>'.$rowSearch['manfDate'].'</td>
                          <td>'.$rowSearch['quantity'].'</td>
                          <td>'.$rowSearch['vendor'].'</td>
                          <td>'.$rowSearch['version'].'</td>
                          <td>'.$rowSearch['productKey'].'</td>
                          <td>'.$rowSearch['purchDate'].'</td>
                          <td>'.$rowSearch['assetCondition'].'</td>
                          <td>'.$rowSearch['maintenence'].'</td>
                          <td>'.$rowSearch['perPrice'].'</td>
                          <td>'.$rowSearch['totalPrice'].'</td>
                          <td>'.$rowSearch['availability'].'</td>
                          <td>
                            <button onclick="getAssetDetails('.$rowSearch['sl.no'].')"
                              class="btn btn-warning">Edit</button>
                          </td>
                          <td>
                            <button onclick="deleteAsset('.$rowSearch['sl.no'].')"
                              class="btn btn-danger">Delete</button>
                          </td>
                        </tr>';
            $slNo++;   
          }
          echo $data;
      }
      else{
        print_r('The following error occured: '.mysqli_error($connection));
        echo 'Data Not Found';
      }
    }


    /*Search User assets*/
    if(isset($_POST['searchUserText'])){
      $data = " ";
      $queryUserSearch = "SELECT * FROM `assetmanagement` WHERE `assetmanagement`.`assetName` LIKE '%$searchUserText%'";
      $resultUserSearch = mysqli_query($connection, $queryUserSearch);
      if(mysqli_num_rows($resultUserSearch) > 0){
        $slNo = 1;
        $data .= "<h3 class='text-light' style='position: relative;'>Search Result</h3>
                      <table class='table table-bordered table-striped bg-light table-responsive rounded'>
                      <tr>
                        <th>Sl.No</th>
                        <th>Asset Name</th>
                        <th>Asset Type</th>
                        <th>Manufature Date</th>
                        <th>Quantity</th>
                        <th>Vendor</th>
                        <th>Version</th>
                        <th>Purchase Date</th>
                        <th>Condition</th>
                        <th>Maintenence</th>
                        <th>Price Per Piece</th>
                        <th>Total Price</th>
                        <th>Availability</th>
                      </tr>";
          while($rowUserSearch = mysqli_fetch_array($resultUserSearch)){
            $data .= '<tr>
                          <td>'.$slNo.'</td>
                          <td>'.$rowUserSearch['assetName'].'</td>
                          <td>'.$rowUserSearch['assetType'].'</td>
                          <td>'.$rowUserSearch['manfDate'].'</td>
                          <td>'.$rowUserSearch['quantity'].'</td>
                          <td>'.$rowUserSearch['vendor'].'</td>
                          <td>'.$rowUserSearch['version'].'</td>
                          <td>'.$rowUserSearch['purchDate'].'</td>
                          <td>'.$rowUserSearch['assetCondition'].'</td>
                          <td>'.$rowUserSearch['maintenence'].'</td>
                          <td>'.$rowUserSearch['perPrice'].'</td>
                          <td>'.$rowUserSearch['totalPrice'].'</td>
                          <td>'.$rowUserSearch['availability'].'</td>
                        </tr>';
            $slNo++;   
          }
          echo $data;
      }
      else{
        print_r('The following error occured: '.mysqli_error($connection));
        echo 'Data Not Found';
      }
    }

?>