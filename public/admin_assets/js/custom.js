$('#product_name').keyup(function () {
    var getUrl = this.value
    getUrl = getUrl.toLowerCase().replaceAll(" ", "-");
    // console.log(getUrl);
    $('#product_url').val(getUrl);
})

$('#category_name').keyup(function () {
    var getUrl = this.value
    getUrl = getUrl.toLowerCase().replaceAll(" ", "-");
    // console.log(getUrl);
    $('#category_url').val(getUrl);
})

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

function changeCategoryStatus(id, action) {
    if (action == 'activate') {
        var $msg = 'If the category is activated, it will be visible on the Website';
    } else {
        var $msg = 'If the category is deactivated, it will be removed from the Website';
    }
    let _token = $("input[name=_token]").val();
    swal({
        title: "Are you sure?",
        text: $msg,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    method: 'POST',
                    url: `/admin/category/changeStatus`,
                    data: { id: id, action: action, _token: _token },
                    success: async function (response) {
                        await swal(`Poof! Your category has been ${response}`, {
                            icon: "success",
                        });
                        window.location.reload()
                    },
                    error: function (response) {
                        alert(response);
                    }

                })
            }
        });
}

function changeProductStatus(id, action) {
    if (action == 'activate') {
        var $msg = 'If the product is activated, it will be visible on the Website';
    } else {
        var $msg = 'If the product is deactivated, it will be removed from the Website';
    }
    let _token = $("input[name=_token]").val();
    swal({
        title: "Are you sure?",
        text: $msg,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    method: 'POST',
                    url: `/admin/products/changeStatus`,
                    data: { id: id, action: action, _token: _token },
                    success: async function (response) {
                        await swal(`Poof! Your product has been ${response}`, {
                            icon: "success",
                        });
                        window.location.reload()
                    },
                    error: function (response) {
                        alert(response);
                    }

                })
            }
        });
}

function deleteCategory(id, action) {
    let _token = $("input[name=_token]").val();
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this category!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    method: 'POST',
                    url: `/admin/category/deleteCategory`,
                    data: { id: id, action: action, _token: _token },
                    success: async function (response) {
                        await swal("Poof! Your category has been deleted!", {
                            icon: "success",
                        });
                        window.location.reload()
                    },
                    error: function (response) {
                        alert(response);
                    }

                })
            } else {
                swal("Your category is safe!");
            }
        });
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

function deleteAttr(id) {
    let _token = $("input[name=_token]").val();
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this attribute!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    method: 'POST',
                    url: `/admin/products/deleteAttr`,
                    data: { id: id, _token: _token },
                    success: async function (response) {
                        await swal("Poof! Attribute has been deleted!", {
                            icon: "success",
                        });
                        window.location.reload()
                    },
                    error: function (response) {
                        alert(response);
                    }

                })
            }
        });
}

function deleteGalleryImage(id, action) {
    let _token = $("input[name=_token]").val();
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this image!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    method: 'POST',
                    url: `/admin/products/deleteGalleryImage`,
                    data: { id: id, _token: _token, action: action },
                    success: async function (response) {
                        await swal("Poof! Image has been deleted!", {
                            icon: "success",
                        });
                        window.location.reload()
                    },
                    error: function (response) {
                        alert(response);
                    }

                })
            }
        });
}

function replaceGalleryImage(id) {
    let _token = $("input[name=_token]").val();
    let input = $('input[name=replaceImg]');
    input.trigger('click');
    $(input).change(function () {
        $('#replaceImgId').val(id);
        let formData = new FormData($('#replaceImageform')[0]);
        let file = $('input[name=replaceImg]')[0].files[0];
        formData.append('file', file, file.name);
        $.ajax({
            url: '/admin/products/replaceGalleryImage',
            headers: { 'X-CSRF-TOKEN': $('input[name="_token"]').attr('content') },
            type: 'POST',
            contentType: false,
            processData: false,
            cache: false,
            data: formData,
            success: async function (response) {
                if (response == 'success') {
                    await swal("Good job!", "You image has been successfully replaced!", "success");
                    window.location.reload();
                }
            },
            error: function (response) {
                console.log(response);
            }
        });
    })
}

function changeCouponStatus(id, action) {
    if (action == 'activate') {
        var $msg = 'If the coupon is activated, it will be visible on the Website';
    } else {
        var $msg = 'If the coupon is deactivated, it will be removed from the Website';
    }
    let _token = $("input[name=_token]").val();
    swal({
        title: "Are you sure?",
        text: $msg,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    method: 'POST',
                    url: `/admin/coupon/changeStatus`,
                    data: { id: id, action: action, _token: _token },
                    success: async function (response) {
                        await swal(`Poof! Your coupon has been ${response}`, {
                            icon: "success",
                        });
                        window.location.reload()
                    },
                    error: function (response) {
                        alert(response);
                    }

                })
            }
        });
}

function deleteCoupon(id, action) {
    let _token = $("input[name=_token]").val();
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this coupon!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    method: 'POST',
                    url: `/admin/coupon/deleteCoupon`,
                    data: { id: id, action: action, _token: _token },
                    success: async function (response) {
                        await swal("Poof! Your coupon has been deleted!", {
                            icon: "success",
                        });
                        window.location.reload()
                    },
                    error: function (response) {
                        alert(response);
                    }

                })
            } else {
                swal("Your coupon is safe!");
            }
        });
}
