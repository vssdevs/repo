$('.selectme').select2();
$('#catcontainer').hide();
$('#subcatcontainer').hide();
function showcat(){
    $('#catcontainer').show();
}
function showsubcat(){
    $('#subcatcontainer').show();
    let accountID=$('#accountID').val();
    if(accountID==''){
        Swal.fire({
            title: "Opss..",
            text: "Please select account first",
            icon: "error"
          });
    }else{
        $.ajax({
            url:'middleware/getSubCategory.php',
            method:'post',
            data:{accountID:accountID},
            success: function(e){
               
                $('#subcatcontainer').html(e);  
            }
        });
    }
    

}
function hidecat(){
    $('#catcontainer').hide();
}
function hidesubcat(){
    $('#subcatcontainer').hide();
}
function addcat(){
    let cat=$('#categoryname').val();
    let order=$('#orderID').val();
    let accountID=$('#accountID').val();
    let campaignID=$('#campaignID').val();
    let catweight=$('#catweight').val();
    if(accountID==''){
        Swal.fire({
            title: "Opss..",
            text: "Please select account first",
            icon: "error"
          });
    }else{
        $.ajax({
            url:'middleware/addCategory.php',
            method:'post',
            data:{catname:cat,orderID:order,accountID:accountID,campaignID:campaignID,catweight:catweight},
            success: function(e){
                if(e==1){
                    Swal.fire({
                        title: "Great!",
                        text: "Category Saved",
                        icon: "success"
                      });
                      $('#categoryname').val("");
                      $('#catweight').val("");
                }else{
                    Swal.fire({
                        title: "Opss..",
                        text: "Something went wrong "+e,
                        icon: "error"
                      }); 
                }
                  
            }
        });
    }
}
function addsubcat(){

    let categoryID=$('#categoryID').val();
    let subcatname=$('#subcatname').val();
    let subcatweight=$('#subcatweight').val();
   
    if(accountID==''){
        Swal.fire({
            title: "Opss..",
            text: "Please select account first",
            icon: "error"
          });
    }else{
        $.ajax({
            url:'middleware/addSubCategory.php',
            method:'post',
            data:{subcatname:subcatname,categoryID:categoryID,subcatweight:subcatweight},
            success: function(e){
                if(e==1){
                    Swal.fire({
                        title: "Great!",
                        text: "Sub-Category Saved",
                        icon: "success"
                      });
                      $('#subcatname').val("");
                      $('#subcatweight').val("");
                }else{
                    Swal.fire({
                        title: "Opss..",
                        text: "Something went wrong "+e,
                        icon: "error"
                      }); 
                }
                  
            }
        });
    }
}
function getcategory(){
    let accountID=$('#accountID').val();
    let campaignID=$('#campaignID').val();

        $.ajax({
            url:'middleware/getCategory.php',
            method:'post',
            data:{accountID:accountID,campaignID:campaignID},
            success: function(e){
                
                $('#datacontainer').html(e);
                  
            }
        });
    
}

function getcampaign(){
    let accountID=$('#accountID').val();
   

        $.ajax({
            url:'middleware/getCampaigndropdown.php',
            method:'post',
            data:{accountID:accountID},
            success: function(e){
                
                $('#campaignID').html(e);
                  
            }
        });
    
}

    $('#uploadForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData();
        $('#catbtn').attr('Disabled',true);
        $('#spin1').addClass('fa fa-spinner fa-spin');
       
        formData.append('file', $('#file')[0].files[0]);
        $.ajax({
            url: 'middleware/categoryuploader.php', // Server-side script URL
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(e) {

                if(e==1){
                    Swal.fire({
                        title: "Great!",
                        text: "Scores Saved",
                        icon: "success"
                      });
                      $('#subcatname').val("");
                      $('#subcatweight').val("");
                }else{
                    Swal.fire({
                        title: "Opss..",
                        text: "Something went wrong "+e,
                        icon: "error"
                      }); 
                }
                $('#catbtn').attr('Disabled',false);
                $('#spin1').removeClass('fa fa-spinner fa-spin');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
    $('#uploadForm2').submit(function(e) {
        e.preventDefault();
        var formData = new FormData();
        $('#subbtn').attr('Disabled',true);
        $('#spin2').addClass('fa fa-spinner fa-spin');
        formData.append('file', $('#file2')[0].files[0]);
        $.ajax({
            url: 'middleware/subcategoryuploader.php', // Server-side script URL
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(e) {

                if(e==1){
                    Swal.fire({
                        title: "Great!",
                        text: "Scores Saved",
                        icon: "success"
                      });
                      $('#subcatname').val("");
                      $('#subcatweight').val("");
                }else{
                    Swal.fire({
                        title: "Opss..",
                        text: "Something went wrong "+e,
                        icon: "error"
                      }); 
                }
                 $('#subbtn').attr('Disabled',false);
                 $('#spin2').removeClass('fa fa-spinner fa-spin');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
