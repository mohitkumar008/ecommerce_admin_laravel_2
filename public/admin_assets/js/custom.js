$('#curr_pwd').keyup(function(){
    let curr_pwd = $('#curr_pwd').val();
    let _token = $("input[name=_token]").val();
    $.ajax({
        method: 'POST',
        url: '/admin/check-curr-pwd',
        data: `curr_pwd=${curr_pwd}&_token=${_token}`,
        success: function(response){
            if(response == false){
                $('#curr_pwd_err').html('<small class="text-danger">*Current password not match</small>')
                $('#new_pwd').attr('disabled', true)
                $('#cnfrm_new_pwd').attr('disabled', true)
            }else{
                $('#curr_pwd_err').html('<small class="text-success">Password matched :)</small>')
                $('#new_pwd').attr('disabled', false)
                $('#cnfrm_new_pwd').attr('disabled', false)
            }
        },
        error: function(response){
            alert(response);
        }

    })
})
$('#cnfrm_new_pwd').keyup(function(){
    let new_pwd = $('#new_pwd').val();
    let cnfrm_new_pwd = $('#cnfrm_new_pwd').val();
    if(new_pwd !== cnfrm_new_pwd){
        $('#cnfrm_pwd_err').html('<small class="text-danger">*Confirm password not match with new password</small>');
    }else{
        $('#cnfrm_pwd_err').html('<small class="text-success">Password matched :)</small>');
        $('#change_pass_btn').attr('disabled', false);
    }
})