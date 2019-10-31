<?php
    include "connection.php";
    include "assetController.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User DashBoard</title>
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body style="background-color: #007bff;">
    <nav class="navbar fixed-top" style="background-color: #0d47a1; box-shadow: 0px 4px 5px #1c1c1c47;">
        <h2 class="display-5 title dashContent" style="color: #ffffff;">Dashboard</h2>
        <span>&nbsp;&nbsp;&nbsp;</span>
        <form id="searchUserForm">
            <div class="form-group has-search" style="margin-bottom: 0;">
                <span class="fa fa-search form-control-feedback"></span>
                <input type="text" class="form-control"  name="search_userasset" id="search_userasset" placeholder="Search by Asset name">
            </div>
        </form>
    </nav>
    <div class="container-fluid dashBoard" id="dash">
        <div class="d-flex justify-content-start" role="alert">
            <a type="button" class="btn btn-warning btn-lg text-light" data-toggle="modal" data-target="#requestModal">Raise Request</a>
            &nbsp;&nbsp;&nbsp;
            <a type="button" class="btn btn-success btn-lg text-light" data-toggle="modal" data-target="#requestViewModal">View Requests</a>
        </div>
        <div class="modal fade" id="requestModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Your Request</h4>
                        <button class="close" type="button" data-dismiss="modal">&times;</button>
                    </div>
                    <form id="requestForm" class="was-validated">
                        <div class="modal-body">
                                <div class="form-group">
                                    <label for="empId">Employee ID: </label>
                                    <input type="text" class="form-control" id="empId" placeholder="eg: 101">
                                </div>
                                <div class="form-group">
                                    <label for="empName">Employee Name: </label>
                                    <input type="text" class="form-control" id="empName" placeholder="eg: Jhon Doe">
                                </div>
                                <div class="form-group">
                                    <label for="empMail">Email ID: </label>
                                    <input type="email" class="form-control" id="empMail" placeholder="eg: abc@gmail.com">
                                </div>
                                <div class="form-group">
                                    <label for="empAsset">Select Asset: </label>
                                    <?php
                                        echo "<select class='form-control' id='empAsset'>
                                                    <option value='Select a Asset' selected='selected'>Select a Asset</option>";
                                        if(mysqli_num_rows($resultListAssets) > 0){
                                            while($rowListAssets = mysqli_fetch_array($resultListAssets)){
                                                echo "<option value=".$rowListAssets['assetName']." >".$rowListAssets['assetName']."</option>";
                                            }
                                        }
                                        else{
                                            print_r('The following error occured: '.mysqli_error($connection));
                                        }
                                        echo "</select>";
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label for="empRequest">Your Request:</label>
                                    <textarea class="form-control" rows="5" id="empRequest" placeholder="Type your request here..."></textarea>
                                </div> 
                        </div>
                        <div class="modal-footer">
                            <a type="button" onclick="sendRequest()" id="sendRequest"  value="Submit" class="btn btn-primary" data-dismiss="modal">Send</a>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </form>    
                </div>
            </div>
        </div>


        <div class="modal fade" id="requestViewModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Requests</h4>
                        <button class="close" type="button" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body" style="padding: 20px; overflow-y: auto; height: 500px;">
                        <?php
                            if(mysqli_num_rows($resultViewRequest) > 0){
                                while($rowViewRequest = mysqli_fetch_array($resultViewRequest)){
                                    echo "<div class='card' style='box-shadow: 0px 3px 5px grey;'>
                                            <div class='card-body'>
                                                <h5 class='card-title'>Employee Name: ".$rowViewRequest['employeeName']."</h5>
                                                <h6 class='card-subtitle mb-2 text-muted'>Employee ID: ".$rowViewRequest['employeeID']."</h6>
                                                <h6 class='card-subtitle mb-2 text-muted'>".$rowViewRequest['employeeMail']."</h6>
                                                <h5 class='card-subtitle mb-2 text-muted'>Asset Name: ".$rowViewRequest['requestAsset']."</h5>
                                                <p class='card-text'>".$rowViewRequest['employeeReason']."</p>";
                                                if($rowViewRequest['status'] == 'Approved'){
                                                    echo"<a class='btn border-none card-link text-success disabled'>Your Request is Approved</a>";
                                                }
                                                elseif($rowViewRequest['status'] == 'Rejected'){
                                                    echo"<a class='btn border-none card-link text-success disabled'>Your Request is Rejected</a>";
                                                }
                                                else{
                                                    echo "<a class='card-link text-danger' onclick='deleteRequest(".$rowViewRequest['requestID'].")'>Delete</a>";
                                                }
                                        echo"</div>
                                        </div>
                                        <div style='height: 10px;'>
                                        </div>";
                                }    
                            }
                            else{
                                print_r('No Requests yet');
                            }
                        ?>         
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>    
                </div>
            </div>
        </div>



        

        <div class="row dashCards">
            <div class="col-sm-4 cardCols">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title display-4" id="totalAssets"></h4>
                        <p class="card-text">All Assets</p>
                        <div class="d-flex justify-content-start">
                            <a class="btn btn-primary btn-block card-text" id="togU" onclick="readAllAssetUser()" style="color: #ffffff;">View Assets</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 cardCols">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title display-4" id="hardwareAssets"></h4>
                        <p class="card-text">Total Hardwares</p>
                        <div class="d-flex justify-content-start">
                            <a class="btn btn-primary btn-block card-text" id="togU2" onclick="readHardwareAssetUser()" style="color: #ffffff;">View Assets</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 cardCols">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title display-4" id="softwareAssets"></h4>
                        <p class="card-text">Total Softwares</p>
                        <div class="d-flex justify-content-start">
                            <a class="btn btn-primary btn-block card-text" id="togU1" onclick="readSoftwareAssetUser()" style="color: #ffffff;">View Assets</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="showCardAsset" id="showCardAssetsUser">  
        </div>
        <div class="showSearchAsset" id="showSearchUserAssets">  
        </div>
        <h3 class="text-light" style="position: relative; top: 50px;">Recently Added Assets</h3>
        <div class="showRecentAsset" id="showRecentAssetsUsers">  
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" 
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="crossorigin="anonymous"></script>
    <script src="custom.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>

</html>