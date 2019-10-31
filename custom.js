function showHardwareForm() {
    document.getElementById('formBody').style.display = 'block';
    document.getElementById('condition').style.display = 'block';
    document.getElementById('version').style.display = 'none';
    document.getElementById('key').style.display = 'none';
    document.getElementById('maintenence').style.display = 'none';
}
function showSoftwareForm() {
    document.getElementById('formBody').style.display = 'block';
    document.getElementById('version').style.display = 'block';
    document.getElementById('key').style.display = 'block';
    document.getElementById('maintenence').style.display = 'block';
    document.getElementById('condition').style.display = 'none';
}

/*Display Total Asset Count*/
$(document).ready(function(){
    totalAssetCount();
});
function totalAssetCount(){
    var totalAssetCount = "totalAssetCount";
    $.ajax({
        url: "assetController.php",
        type: "post",
        data: {
            totalAssetCount: totalAssetCount
        },
        success: function(data, status){
            $('#totalAssets').html(data);
        }
    });
}

/*Display Hardware Asset Count*/
$(document).ready(function(){
    totalHardwareCount();
});
function totalHardwareCount(){
    var totalHardwareCount = "totalHardwareCount";
    $.ajax({
        url: "assetController.php",
        type: "post",
        data: {
            totalHardwareCount: totalHardwareCount
        },
        success: function(data, status){
            $('#hardwareAssets').html(data);
        }
    });
}
/*Display Software Asset Count*/
$(document).ready(function(){
    totalSoftwareCount();
});
function totalSoftwareCount(){
    var totalSoftwareCount = "totalSoftwareCount";
    $.ajax({
        url: "assetController.php",
        type: "post",
        data: {
            totalSoftwareCount: totalSoftwareCount
        },
        success: function(data, status){
            $('#softwareAssets').html(data);
        }
    });
}
/*Display All Assets*/
function readAllAsset(){
    var  readAllAsset = "readAllAsset";
    $.ajax({
        url: "assetController.php",
        type: "post",
        data: {
            readAllAsset: readAllAsset
        },
        success: function(data, status){
            $('#showCardAssets').html(data);  
        }
    });
}
/*Display All Assets for Users*/
function readAllAssetUser(){
    var  readAllAssetUser = "readAllAssetUser";
    $.ajax({
        url: "assetController.php",
        type: "post",
        data: {
            readAllAssetUser: readAllAssetUser
        },
        success: function(data, status){
            $('#showCardAssetsUser').html(data);  
        }
    });
}
/*Display Software Assets*/
function readSoftwareAsset(){
    var  readSoftwareAsset = "readSoftwareAsset";
    $.ajax({
        url: "assetController.php",
        type: "post",
        data: {
            readSoftwareAsset: readSoftwareAsset
        },
        success: function(data, status){
            $('#showCardAssets').html(data);  
        }
    });
}
/*Display Software Assets for Usres*/
function readSoftwareAssetUser(){
    var  readSoftwareAssetUser = "readSoftwareAssetUser";
    $.ajax({
        url: "assetController.php",
        type: "post",
        data: {
            readSoftwareAssetUser: readSoftwareAssetUser
        },
        success: function(data, status){
            $('#showCardAssetsUser').html(data);  
        }
    });
}
/*Display Hardware Assets*/
function readHardwareAsset(){
    var  readHardwareAsset = "readHardwareAsset";
    $.ajax({
        url: "assetController.php",
        type: "post",
        data: {
            readHardwareAsset: readHardwareAsset
        },
        success: function(data, status){
            $('#showCardAssets').html(data);  
        }
    });
}
/*Display Hardware Assets for Users*/
function readHardwareAssetUser(){
    var  readHardwareAssetUser = "readHardwareAssetUser";
    $.ajax({
        url: "assetController.php",
        type: "post",
        data: {
            readHardwareAssetUser: readHardwareAssetUser
        },
        success: function(data, status){
            $('#showCardAssetsUser').html(data);  
        }
    });
}
$(document).ready(function(){
    $("#tog").click(function(){
      $("#showCardAssets").toggle();
    });
  });
$(document).ready(function(){
    $("#togU").click(function(){
      $("#showCardAssetsUser").toggle();
    });
  });  
$(document).ready(function(){
    $("#tog1").click(function(){
      $("#showCardAssets").toggle();
    });
  });
$(document).ready(function(){
    $("#togU1").click(function(){
      $("#showCardAssetsUser").toggle();
    });
  });
$(document).ready(function(){
    $("#tog2").click(function(){
      $("#showCardAssets").toggle();
    });
  });
$(document).ready(function(){
    $("#togU2").click(function(){
      $("#showCardAssetsUser").toggle();
    });
  });
/*Display Recent Assets for Users*/
$(document).ready(function(){
    readRecentAssetUsers();
});
function readRecentAssetUsers(){
    var  readRecentAssetUsers = "readRecentAssetUsers";
    $.ajax({
        url: "assetController.php",
        type: "post",
        data: {
            readRecentAssetUsers: readRecentAssetUsers
        },
        success: function(data, status){
            $('#showRecentAssetsUsers').html(data);
        }
    });
}

/*Display Recent Assets*/
$(document).ready(function(){
    readRecentAsset();
});
function readRecentAsset(){
    var  readRecentAsset = "readRecentAsset";
    $.ajax({
        url: "assetController.php",
        type: "post",
        data: {
            readRecentAsset: readRecentAsset
        },
        success: function(data, status){
            $('#showRecentAssets').html(data);
        }
    });
}

/*Add Assets(Ajax)*/
function addAssets() {
    var assetType = $('[name = "assettype"]:checked').val();
    var assetName = $('#assetname').val();
    var assetManf = $('#manfdate').val();
    var assetQuantity = $('#assetquantity').val();
    var assetVendor = $('#assetvendor').val();
    var assetVersion = $('#assetversion').val();
    var assetKey = $('#assetkey').val();
    var assetPurch = $('#purchdate').val();
    var assetCondition = $('[name = "assetcondition"]:checked').val();
    var assetMaintenence = $('[name = "assetmaintenence"]:checked').val();
    var assetPerPrice = $('#assetperprice').val();
    var assetTotalPrice = $('#assettotalprice').val();
    var assetAvailability = $('[name = "assetavailability"]:checked').val();
    var assetAddBtn = $('#addassetbtn').val();

    $.ajax({
        url: "assetController.php",
        type: 'post',
        data: {
            assetType: assetType,
            assetName: assetName,
            assetManf: assetManf,
            assetQuantity: assetQuantity,
            assetVendor: assetVendor,
            assetVersion: assetVersion,
            assetKey: assetKey,
            assetPurch: assetPurch,
            assetCondition: assetCondition,
            assetMaintenence: assetMaintenence,
            assetPerPrice: assetPerPrice,
            assetTotalPrice: assetTotalPrice,
            assetAvailability: assetAvailability,
            assetAddBtn: assetAddBtn
        },
        success: function (data, status) {
            document.getElementById('assetForm').reset();
            readRecentAsset();
            totalAssetCount();
            totalHardwareCount();
            totalSoftwareCount();
            
        }
    });

}

/*Delete Asset*/
function deleteAsset(deleteId){
    var confirmDeletion = confirm("Are You Sure ?");

    if (confirmDeletion == true) {
        $.ajax({
            url: "assetController.php",
            type: 'post',
            data: {
                deleteId: deleteId
            },
            success: function(data, status){
                readRecentAsset();
                readAllAsset();
                readHardwareAsset();
                readSoftwareAsset();
                totalAssetCount();
                totalHardwareCount();
                totalSoftwareCount();
            }
        });
    }
}

/*Edit Assets*/
function getAssetDetails(editId){
    $('#hiddenassetid').val(editId);

    $.post(
        "assetController.php", {
            editId: editId
        }, function(data, status){
            var assetDetails = JSON.parse(data);
            $('#updateassetname').val(assetDetails.assetName);
            $('#updatemanfdate').val(assetDetails.manfDate);
            $('#updateassetquantity').val(assetDetails.quantity);
            $('#updateassetvendor').val(assetDetails.vendor);
            $('#updateassetversion').val(assetDetails.version);
            $('#updateassetkey').val(assetDetails.productKey);
            $('#updatepurchdate').val(assetDetails.purchDate);
            $('#updateassetperprice').val(assetDetails.perPrice);
            $('#updateassettotalprice').val(assetDetails.totalPrice);
        }
    );
    $('#updatemodal').modal("show");
}

function updateAssetDetails(){
    var updateassettype= $('[name = "updateassettype"]:checked').val();
    var updateassetname= $('#updateassetname').val();
    var updatemanfdate= $('#updatemanfdate').val();
    var updateassetquantity= $('#updateassetquantity').val();
    var updateassetvendor= $('#updateassetvendor').val();
    var updateassetversion= $('#updateassetversion').val();
    var updateassetkey= $('#updateassetkey').val();
    var updatepurchdate= $('#updatepurchdate').val();
    var updateassetcondition= $('[name = "updateassetcondition"]:checked').val();
    var updateassetmaintenence= $('[name = "updateassetmaintenence"]:checked').val();
    var updateassetperprice= $('#updateassetperprice').val();
    var updateassettotalprice= $('#updateassettotalprice').val();
    var updateassetavailability= $('[name = "updateassetavailability"]:checked').val();

    var hiddenassetid = $('#hiddenassetid').val();

    $.post(
        "assetController.php",
        {
            hiddenassetid: hiddenassetid,
            updateassettype: updateassettype,
            updateassetname: updateassetname,
            updatemanfdate: updatemanfdate,
            updateassetquantity: updateassetquantity,
            updateassetvendor: updateassetvendor,
            updateassetversion: updateassetversion,
            updateassetkey: updateassetkey,
            updatepurchdate: updatepurchdate,
            updateassetcondition: updateassetcondition,
            updateassetmaintenence: updateassetmaintenence,
            updateassetperprice: updateassetperprice,
            updateassettotalprice: updateassettotalprice,
            updateassetavailability: updateassetavailability
        },
        function(data, status) {
            $('#updatemodal').modal("hide");
            readRecentAsset();
            totalAssetCount();
            totalHardwareCount();
            totalSoftwareCount();
            readAllAsset();
            readSoftwareAsset();
            readHardwareAsset();
        }
    )
}


/*Send Asset Request*/
function sendRequest(){
    var empID = $('#empId').val();
    var empName = $('#empName').val();
    var empMail = $('#empMail').val();
    var empAsset = $('#empAsset').val();
    var empRequest = $('#empRequest').val();
    var sendRequest = $('#sendRequest').val();

    $.ajax({
        url: "assetController.php",
        type: 'post',
        data: {
            empID: empID,
            empName: empName,
            empMail: empMail,
            empAsset: empAsset,
            empRequest: empRequest,
            sendRequest: sendRequest
        },
        success: function(data, status){
            document.getElementById('requestForm').reset();
            alert("Your Request is Sent.");
            location.reload();
        }
    });
}
/*Delete User Request*/
function deleteRequest(requestId){
    var confirmDeletion = confirm("Are You Sure ?");

    if (confirmDeletion == true) {
        $.ajax({
            url: "assetController.php",
            type: 'post',
            data: {
                requestId: requestId
            },
            success: function(data, status){
                alert("A Request is Deleted.");
                location.reload();
            }
        });
    }
}

/*Approve Mail*/
function approveMail(requestID){
    $('#hiddenRequestID').val(requestID);
    $.post(
        "assetController.php", {
            requestID: requestID
        }, function(data, status){
            var approvalDetails = JSON.parse(data);
            $('#toMail').val(approvalDetails.employeeMail);
            $('#toName').val(approvalDetails.employeeName);
            $('#reqAsset').val(approvalDetails.requestAsset);
        }
    );
    $('#sendMailModal').modal("show");
}

function sendMail(){
    var toMail= $('#toMail').val();
    var toName= $('#toName').val();
    var reqAsset= $('#reqAsset').val();
    var adMessage= $('#adMessage').val();
    var sendMailer= $('#sendMailer').val();
    var status= 'Approved';
    var hiddenID = $('#hiddenRequestID').val();

    $.ajax({
        url: "assetController.php",
        type: 'post',
        data: {
            toMail: toMail,
            toName: toName,
            reqAsset: reqAsset,
            adMessage: adMessage,
            sendMailer: sendMailer,
            status: status,
            hiddenID: hiddenID
        },
        success: function(data, status){
            alert("Mail Sent..");
        }
    });
}


/*Reject Mail*/
function rejectedMail(requestRejID){
    $('#hiddenRejRequestID').val(requestRejID);
    $.post(
        "assetController.php", {
            requestRejID: requestRejID
        }, function(data, status){
            var rejectionDetails = JSON.parse(data);
            $('#toRejMail').val(rejectionDetails.employeeMail);
            $('#toRejName').val(rejectionDetails.employeeName);
            $('#reqRejAsset').val(rejectionDetails.requestAsset);
        }
    );
    $('#sendRejectMailModal').modal("show");
}

function sendRejMail(){
    var toRejMail= $('#toRejMail').val();
    var toRejName= $('#toRejName').val();
    var reqRejAsset= $('#reqAsset').val();
    var adRejMessage= $('#adRejMessage').val();
    var sendRejMailer= $('#sendRejMailer').val();
    var statusRej = 'Rejected';
    var hiddenRejID = $('#hiddenRejRequestID').val();

    $.ajax({
        url: "assetController.php",
        type: 'post',
        data: {
            toRejMail: toRejMail,
            toRejName: toRejName,
            reqRejAsset: reqRejAsset,
            adRejMessage: adRejMessage,
            sendRejMailer: sendRejMailer,
            statusRej: statusRej,
            hiddenRejID: hiddenRejID
        },
        success: function(data, status){
            alert("Mail Sent..");
        }
    });
}

/*Search asset*/
$(document).ready(function(){
    $('#search_asset').keyup(function(){
        var searchText = $('#search_asset').val();
        if ($.trim(searchText.length) == 0) {
            $('#showSearchAssets').html('Please enter search item'); 
        }
        else{
           $.ajax({
               url: "assetController.php",
               type: "post",
               data: {
                searchText: searchText
               },
               success: function(data){
                $('#showSearchAssets').html(data);
               }
           }); 
        }
    });
});

$(document).ready(function(){
    document.getElementById('searchForm').reset();
});


$(document).ready(function(){
    $('#search_userasset').keyup(function(){
        var searchUserText = $('#search_userasset').val();
        if ($.trim(searchUserText.length) == 0) {
            $('#showSearchUserAssets').html('Please enter search item'); 
        }
        else{
           $.ajax({
               url: "assetController.php",
               type: "post",
               data: {
                searchUserText: searchUserText
               },
               success: function(data){
                $('#showSearchUserAssets').html(data);
               }
           }); 
        }
    });
});

$(document).ready(function(){
    document.getElementById('searchUserForm').reset();
});