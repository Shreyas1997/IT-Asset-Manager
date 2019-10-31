<?php
    include "connection.php";
    include "assetController.php";
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin DashBoard</title>
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body style="background-color: #007bff;">
    <nav class="navbar fixed-top" style="background-color: #0d47a1; box-shadow: 0px 4px 5px #1c1c1c47;">
        <h2 class="display-5 title dashContent" style="color: #ffffff;">Admin Dashboard</h2>
        <a href="" class="btn  btn-primary" data-toggle="modal" data-target="#requestViewModal">
            <i class="fa fa-first-order"></i>
            &nbsp;&nbsp;Orders&nbsp;&nbsp;
                <?php
                    echo "<span class='badge badge-light'>".$dataCountRequest[0]."</span>";
                ?>
        </a>
        <span>&nbsp;&nbsp;&nbsp;</span>
        <form id="searchForm">
            <div class="form-group has-search" style="margin-bottom: 0;">
                <span class="fa fa-search form-control-feedback"></span>
                <input type="text" class="form-control"  name="search_asset" id="search_asset" placeholder="Search by Asset name">
            </div>
        </form>
        <span>&nbsp;&nbsp;&nbsp;</span>
            <?php
                echo "<div class='btn-group dropleft'><a type='button' class='btn btn-danger btn-lg text-light dropdown-toggle fabButton'
                        data-toggle='dropdown' aria-haspopup='false' aria-expanded='false'>".$_SESSION['adminname']."</a>
                        <div class='dropdown-menu' aria-labelledby='Preview' style=' position: absolute; will-change: transform; 
                        top: 0px; left: 0px; transform: translate3d(-110px, 70px, 0px);'>
                            <h6 class='dropdown-header'>Welcome Admin!</h6>
                            <div class='dropdown-item'>
                                <form action='assetController.php' method='POST'>
                                    <button type='submit' class='btn btn-danger text-light' name='signout' value='signout'>Sign Out</button>
                                </form>
                            </div>
                        </div></div>";
            ?>  
    </nav>
    <div class="container-fluid dashBoard" id="dash">
        <div class="modal fade" id="requestViewModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Employee Requests</h4>
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
                                                    echo"<a class='btn border-none card-link text-success disabled'>Approved</a>";
                                                }
                                                elseif($rowViewRequest['status'] == 'Rejected'){
                                                    echo"<a class='btn border-none card-link text-success disabled'>Rejected</a>";
                                                }
                                                else{
                                                    echo "<a class='btn border-none card-link text-success' data-toggle='modal' id='replaceApprove' data-target='#sendMailModal' onclick='approveMail(".$rowViewRequest['requestID'].")'>Approve</a>
                                                        <a class='btn border-none card-link text-danger' data-toggle='modal' id='replaceReject' data-target='#sendRejectMailModal' onclick='rejectedMail(".$rowViewRequest['requestID'].")'>Reject</a>";
                                                }
                                                
                                        echo"</div>
                                        </div>
                                        <div style='height: 10px;'>
                                        </div>";    
                                }    
                            }
                            else{
                                print_r('The following error occured: '.mysqli_error($connection));
                            }
                        ?>
                                 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>    
                </div>
            </div>
        </div>
        <div class="modal fade" id="sendMailModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Approve Request</h4>
                        <button class="close" type="button" data-dismiss="modal">&times;</button>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="toMail">To: </label>
                                <input type="email" class="form-control" id="toMail">
                            </div>
                            <div class="form-group">
                                <label for="toName">Name: </label>
                                <input type="text" class="form-control" id="toName">
                            </div>
                            <div class="form-group">
                                <label for="reqAsset">Asset Name: </label>
                                <input type="text" class="form-control" id="reqAsset">
                            </div>
                            <div class="form-group">
                                <label for="adMessage">Your Message:</label>
                                <textarea class="form-control" rows="5" id="adMessage" placeholder="Type your message here..."></textarea>
                            </div> 
                        </div>
                        <div class="modal-footer">
                        <a type="submit" onclick="sendMail()" id="sendMailer"  value="Send" class="btn btn-primary text-light" data-dismiss="modal">Send</a>
                            <input type="hidden" name="" id="hiddenRequestID">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="sendRejectMailModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Reject Request</h4>
                        <button class="close" type="button" data-dismiss="modal">&times;</button>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="toRejMail">To: </label>
                                <input type="email" class="form-control" id="toRejMail">
                            </div>
                            <div class="form-group">
                                <label for="toRejName">Name: </label>
                                <input type="text" class="form-control" id="toRejName">
                            </div>
                            <div class="form-group">
                                <label for="reqRejAsset">Asset Name: </label>
                                <input type="text" class="form-control" id="reqRejAsset">
                            </div>
                            <div class="form-group">
                                <label for="adRejMessage">Your Message:</label>
                                <textarea class="form-control" rows="5" id="adRejMessage" placeholder="Type your message here..."></textarea>
                            </div> 
                        </div>
                        <div class="modal-footer">
                        <a type="submit" onclick="sendRejMail()" id="sendRejMailer"  value="Send" class="btn btn-primary text-light" data-dismiss="modal">Send</a>
                            <input type="hidden" name="" id="hiddenRejRequestID">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end" role="alert">
            <h5 class="card-text text-light fabTitle">Add Assets</h5>
            <a type="button" href="" class="btn btn-success btn-lg fabButton" style="text-align: center; font-size: 20px;" data-toggle="modal" data-target="#assetModal">+</a>
        </div>
        <div class="modal fade" id="assetModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">New Asset</h4>
                        <button class="close" type="button" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form id="assetForm" class="was-validated">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="assettypelabel">Asset Type: </label>
                                </div>
                                <div class="form-check-inline">
                                    <label for="assetneedmaintenence" class="form-check-label">
                                        <input type="radio" class="form-check-input" name="assettype" value="Hardware" id="assettypehardware" onclick = "if(this.checked){showHardwareForm()}" required="required">Hardware
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label for="assetnomaintenence" class="form-check-label">
                                        <input type="radio" class="form-check-input" name="assettype" value="Software" id="assettypesoftware" onclick = "if(this.checked){showSoftwareForm()}" required="required">Software
                                    </label>
                                </div>
                            </div>



                            <div class="form-group" id="formBody" style="display: none;">
                                <div class="form-group">
                                    <label for="assetname">Asset Name: </label>
                                    <input type="text" class="form-control" name="assetname" id="assetname" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="manfdate">Date Of Manufacture: </label>
                                    <input type="date" class="form-control" name="manfdate" id="manfdate" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="assetquantity">Quantity: </label>
                                    <input type="number" class="form-control" name="assetquantity" id="assetquantity" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="assetvendor">Vendor: </label>
                                    <input type="text" class="form-control" name="assetvendor" id="assetvendor" required="required">
                                </div>
                                <div class="form-group" style="display: none;" id="version">
                                    <label for="assetversion">Version: </label>
                                    <input type="text" class="form-control" name="assetversion" value="&nbsp;" id="assetversion" required="required">
                                </div>
                                <div class="form-group" style="display: none;" id="key">
                                    <label for="assetkey">Activation Key: </label>
                                    <input type="text" class="form-control" name="assetkey" value="&nbsp;" id="assetkey" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="purchdate">Date Of Purchase: </label>
                                    <input type="date" class="form-control" name="purchdate" id="purchdate" required="required">
                                </div>
                                <div class="form-group" style="display: none;" id="condition">
                                    <div class="form-group">
                                        <label for="assetconditionlabel">Condition: </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label for="assetconditiongood" class="form-check-label">
                                            <input type="radio" class="form-check-input" name="assetcondition" value="Good" id="assetconditiongood" required="required">Good
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label for="assetconditionfair" class="form-check-label">
                                            <input type="radio" class="form-check-input" name="assetcondition" value="Fair" id="assetconditionfair" required="required">Fair
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label for="assetconditionbad" class="form-check-label">
                                            <input type="radio" class="form-check-input" name="assetcondition" value="Fair" id="assetconditionbad" required="required">Bad
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group" style="display: none;" id="maintenence">
                                    <div class="form-group">
                                        <label for="assetmaintenencelabel">Maintenence: </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label for="assetneedmaintenence" class="form-check-label">
                                            <input type="radio" class="form-check-input" name="assetmaintenence" value="Need Maintenece" id="assetneedmaintenence" required="required">Need Maintenece
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label for="assetnomaintenence" class="form-check-label">
                                            <input type="radio" class="form-check-input" name="assetmaintenence" value="Not Need" id="assetnomaintenence" required="required">Not Need
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="assetperprice">Price Per Peice: </label>
                                    <input type="text" class="form-control" name="assetperprice" id="assetperprice" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="assettotalprice">Total Price: </label>
                                    <input type="text" class="form-control" name="assettotalprice" id="assettotalprice" required="required">
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="assetavailabilitylabel">Asset Availability: </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label for="assetavailabilityavailable" class="form-check-label">
                                            <input type="radio" class="form-check-input" name="assetavailability" value="Available" id="assetavailabilityavailable" required="required">Available
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label for="assetavailabilitynotavailable" class="form-check-label">
                                            <input type="radio" class="form-check-input" name="assetavailability" value="Not Available" id="assetavailabilitynotavailable" required="required">Not Available
                                        </label>
                                    </div>  
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a type="submit" onclick="addAssets()" id="addassetbtn"  value="Submit" class="btn btn-primary text-light" data-dismiss="modal">Add</a>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="updatemodal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Asset</h4>
                        <button class="close" type="button" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form id="assetForm" class="was-validated">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="assettypelabel">Asset Type: </label>
                                </div>
                                <div class="form-check-inline">
                                    <label for="assettypehardware" class="form-check-label">
                                        <input type="radio" class="form-check-input" name="updateassettype" value="Hardware" id="updateassettypehardware" required="required">Hardware
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label for="assettypesoftware" class="form-check-label">
                                        <input type="radio" class="form-check-input" name="updateassettype" value="Software" id="updateassettypesoftware" required="required">Software
                                    </label>
                                </div>
                            </div>



                            <div class="form-group" id="formBody">
                                <div class="form-group">
                                    <label for="updateassetname">Asset Name: </label>
                                    <input type="text" class="form-control" name="updateassetname" id="updateassetname" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="updatemanfdate">Date Of Manufacture: </label>
                                    <input type="date" class="form-control" name="updatemanfdate" id="updatemanfdate" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="updateassetquantity">Quantity: </label>
                                    <input type="number" class="form-control" name="updateassetquantity" id="updateassetquantity" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="updateassetvendor">Vendor: </label>
                                    <input type="text" class="form-control" name="updateassetvendor" id="updateassetvendor" required="required">
                                </div>
                                <div class="form-group" id="version">
                                    <label for="updateassetversion">Version: </label>
                                    <input type="text" class="form-control" name="updateassetversion" value="&nbsp;" id="updateassetversion" required="required">
                                </div>
                                <div class="form-group" id="key">
                                    <label for="updateassetkey">Activation Key: </label>
                                    <input type="text" class="form-control" name="updateassetkey" value="&nbsp;" id="updateassetkey" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="updatepurchdate">Date Of Purchase: </label>
                                    <input type="date" class="form-control" name="updatepurchdate" id="updatepurchdate" required="required">
                                </div>
                                <div class="form-group" id="updatecondition">
                                    <div class="form-group">
                                        <label for="updateassetconditionlabel">Condition: </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label for="updateassetconditiongood" class="form-check-label">
                                            <input type="radio" class="form-check-input" name="updateassetcondition" value="Good" id="updateassetconditiongood" required="required">Good
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label for="updateassetconditionfair" class="form-check-label">
                                            <input type="radio" class="form-check-input" name="updateassetcondition" value="Fair" id="updateassetconditionfair" required="required">Fair
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label for="updateassetconditionbad" class="form-check-label">
                                            <input type="radio" class="form-check-input" name="updateassetcondition" value="Fair" id="updateassetconditionbad" required="required">Bad
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group" id="updatemaintenence">
                                    <div class="form-group">
                                        <label for="updateassetmaintenencelabel">Maintenence: </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label for="updateassetneedmaintenence" class="form-check-label">
                                            <input type="radio" class="form-check-input" name="updateassetmaintenence" value="Need Maintenece" id="updateassetneedmaintenence" required="required">Need Maintenece
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label for="updateassetnomaintenence" class="form-check-label">
                                            <input type="radio" class="form-check-input" name="updateassetmaintenence" value="Not Need" id="updateassetnomaintenence" required="required">Not Need
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="updateassetperprice">Price Per Peice: </label>
                                    <input type="text" class="form-control" name="updateassetperprice" id="updateassetperprice" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="updateassettotalprice">Total Price: </label>
                                    <input type="text" class="form-control" name="updateassettotalprice" id="updateassettotalprice" required="required">
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="updateassetavailabilitylabel">Asset Availability: </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label for="updateassetavailabilityavailable" class="form-check-label">
                                            <input type="radio" class="form-check-input" name="updateassetavailability" value="Available" id="updateassetavailabilityavailable" required="required">Available
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label for="updateassetavailabilitynotavailable" class="form-check-label">
                                            <input type="radio" class="form-check-input" name="updateassetavailability" value="Not Available" id="updateassetavailabilitynotavailable" required="required">Not Available
                                        </label>
                                    </div>  
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a type="submit" onclick="updateAssetDetails()" id="addassetbtn"  value="Edit" class="btn btn-primary text-light" data-dismiss="modal">Edit</a>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <input type="hidden" name="" id="hiddenassetid">
                            </div>
                        </form>
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
                            <a class="btn btn-primary btn-block card-text" id="tog" onclick="readAllAsset()" style="color: #ffffff;">View Assets</a>
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
                            <a class="btn btn-primary btn-block card-text" id="tog2" onclick="readHardwareAsset()" style="color: #ffffff;">View Assets</a>
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
                            <a class="btn btn-primary btn-block card-text" id="tog1" onclick="readSoftwareAsset()" style="color: #ffffff;">View Assets</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="showCardAsset" id="showCardAssets">  
        </div>
        <div class="showSearchAsset" id="showSearchAssets">  
        </div>
        <h3 class="text-light" style="position: relative; top: 50px;">Recently Added Assets</h3>
        <div class="showRecentAsset" id="showRecentAssets">  
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