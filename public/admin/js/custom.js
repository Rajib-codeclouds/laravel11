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
});
