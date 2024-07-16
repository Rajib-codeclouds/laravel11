$(document).ready(function(){

    $('#current_pwd').keyup(function(){
        var current_pwd = $('#current_pwd').val();
        $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        type:'post',
        url:'/admin/check-current-password',
        data:{current_pwd:current_pwd},
        success:function(resp){
            if(resp=="false"){
                $('#verifyCurrentPassword').html("<font color='red'>Current Password is Incorrent</font>");
            }else if(resp=="true"){
                $('#verifyCurrentPassword').html("<font color='green'>Current Password is Corrent</font>");
            }
        },
        error:function(error){
            alert("Error");
        }

        });
    });
    // Update CMS Page Status
    $(document).on("click",".updateCmsPageStatus",function(){
        let status = $(this).children("i").attr("status");
        let page_id = $(this).attr("page_id");
        $.ajax({
           headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
           type:'post',
            url:'/admin/update-cms-page-status',
            data:{status:status,page_id:page_id},
            success:function(resp){
            if(resp['status']==0){
                    $("#page-"+page_id).html("<i class='fas fa-toggle-off' class='color:gray' aria-hidden='true' status='Inactive'></i>")
            }else if(resp['status']==1){
                    $("#page-"+page_id).html("<i class='fas fa-toggle-on' aria-hidden='true' status='Active'></i>")
            }
            },
            error:function(){
             alert("Error");
            }
        });
    })






});
