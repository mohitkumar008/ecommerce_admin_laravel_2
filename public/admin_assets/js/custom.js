// Check current password
$('#curr_pwd').keyup(function () {
    let curr_pwd = $('#curr_pwd').val();
    let _token = $("input[name=_token]").val();
    $.ajax({
        method: 'POST',
        url: '/admin/check-curr-pwd',
        data: `curr_pwd=${curr_pwd}&_token=${_token}`,
        success: function (response) {
            if (response == false) {
                $('#curr_pwd_err').html('<small class="text-danger">*Current password not match</small>')
                $('#new_pwd').attr('disabled', true)
                $('#cnfrm_new_pwd').attr('disabled', true)
            } else {
                $('#curr_pwd_err').html('<small class="text-success">Password matched :)</small>')
                $('#new_pwd').attr('disabled', false)
                $('#cnfrm_new_pwd').attr('disabled', false)
            }
        },
        error: function (response) {
            alert(response);
        }

    })
})

// Check new and confirm password match or not
$('#cnfrm_new_pwd').keyup(function () {
    let new_pwd = $('#new_pwd').val();
    let cnfrm_new_pwd = $('#cnfrm_new_pwd').val();
    if (new_pwd !== cnfrm_new_pwd) {
        $('#cnfrm_pwd_err').html('<small class="text-danger">*Confirm password not match with new password</small>');
    } else {
        $('#cnfrm_pwd_err').html('<small class="text-success">Password matched :)</small>');
        $('#change_pass_btn').attr('disabled', false);
    }
})

// Append category level information
$('#sectionData').change(function () {
    let sectionID = $(this).val();
    let _token = $("input[name=_token]").val();

    // alert(sectionID);
    $.ajax({
        method: 'POST',
        url: '/admin/append-category-level',
        data: `sectionID=${sectionID}&_token=${_token}`,
        success: function (response) {
            $('#appendCategoryLevel').html(response)
        },
        error: function (response) {
            alert(response);
        }

    })
})

function changeProductStatus(id, action) {
    var changeStatus = confirm('Are you sure you want to ' + action)
    if (changeStatus == true) {
        let _token = $("input[name=_token]").val();
        $.ajax({
            method: 'POST',
            url: `/admin/products/changeStatus`,
            data: { id: id, action: action, _token: _token },
            success: function (response) {
                alert(response);
                window.location.reload();
            },
            error: function (response) {
                alert(response);
            }

        })
    }
}

function deleteProduct(id, action) {
    let _token = $("input[name=_token]").val();
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this product!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    method: 'POST',
                    url: `/admin/products/deleteProduct`,
                    data: { id: id, action: action, _token: _token },
                    success: async function (response) {
                        await swal("Poof! Your product has been deleted!", {
                            icon: "success",
                        });
                        window.location.reload()
                    },
                    error: function (response) {
                        alert(response);
                    }

                })
            } else {
                swal("Your product is safe!");
            }
        });
}
