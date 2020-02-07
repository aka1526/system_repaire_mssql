$(document).ready(function() {
    bsCustomFileInput.init()
})

$("#photo").on("change", function() {
    var photo = $(this).val();
    if (photo == "") {
        $(".btn-upload").prop("disabled", true);
    } else {
        $(".btn-upload").prop("disabled", false);
    }
});

$(function() {
    var type_txt;
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });



    if (msg) {

        if (status == true) {
            type_txt = "success";
        } else {
            type_txt = "error";
        }

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });


        Toast.fire({
            type: type_txt,
            title: msg
        })

    }
});

function readURL(input) {
    OnUploadCheck();
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $("#photo_profile").attr("src", e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function OnUploadCheck() {
    var extall = "jpg,jpeg,png";
    file = $("#photo").val();
    ext = file.split('.').pop().toLowerCase();
    if (parseInt(extall.indexOf(ext)) < 0) {
        alert('Extension support : ' + extall);
        $("#photo").val("").focus();
        return false;
    }


    return true;
}

$("#forminfo").validate({
    rules: {
        username: {
            minlength: 5,
            required: true,
            remote: {
                url: "apps/users/do_users.php?action=check_username",
                type: "post",
                data: {
                    username: function() {
                        return $("#username").val();
                    },
                    user_id: function() {
                        return $("#user_id").val();
                    }
                }
            }
        },
        email: {
            required: true,
            remote: {
                url: "apps/users/do_users.php?action=check_email",
                type: "post",
                data: {
                    email: function() {
                        return $("#email").val();
                    },
                    user_id: function() {
                        return $("#user_id").val();
                    }
                }
            }
        },
        first_name: "required",
        last_name: "required",
    },
    messages: {
        username: {
            required: "Please enter your Username",
        },
        // username: "Please enter your Username",
        first_name: "Please enter your First Name",
        last_name: "Please enter your Last Name",
    },
    errorElement: "em",
    errorPlacement: function(error, element) {
        // Add the `invalid-feedback` class to the error element
        error.addClass("invalid-feedback");
        error.insertAfter(element);


    },
    highlight: function(element, errorClass, validClass) {
        $(element).addClass("is-invalid").removeClass("is-valid");
    },
    unhighlight: function(element, errorClass, validClass) {
        $(element).addClass("is-valid").removeClass("is-invalid");
    }
});




for (x in arr_cate) {
    var cate_txt;
    cate_txt += '<option value=' + arr_cate[x]["id"] + '>' + arr_cate[x]["name"] + '</option>';
}



for (x in arr_status) {
    var status_txt;
    status_txt += '<option value=' + arr_status[x]["id"] + '>' + arr_status[x]["name"] + '</option>';

}

$("#status").append(status_txt);
$("#status").val(doc_status);

// console.log(t);
$("#category").append(cate_txt);
$("#category").val(category);
for (x in arr_type) {
    var type_txt;
    if (arr_type[x]["category"] == category) {
        type_txt += '<option value=' + arr_type[x]["id"] + '>' + arr_type[x]["name"] + '</option>';
    }

}

$("#type").append(type_txt);
$("#type").val(type);


for (x in arr_brand) {
    var brand_txt;
    if (arr_brand[x]["type"] == type) {
        brand_txt += '<option value=' + arr_brand[x]["id"] + '>' + arr_brand[x]["name"] + '</option>';
    }

}

$("#brand").append(brand_txt);
$("#brand").val(brand);

$("#inven option").not(":first").remove();

for (x in arr_inven) {
    var inven_txt;
    if (arr_inven[x]["brand"] == brand) {
        inven_txt += '<option value=' + arr_inven[x]["id"] + '>' + arr_inven[x]["name"] + '</option>';
    }

}

$("#inven").append(inven_txt);
$("#inven").val(inven);

$("#category").on("change", function() {

    $("#type option").not(":first").remove();
    $("#brand option").not(":first").remove();
    $("#inven option").not(":first").remove();

    for (x in arr_type) {
        var type_txt;
        if (arr_type[x]["category"] == $(this).val()) {
            type_txt += '<option value=' + arr_type[x]["id"] + '>' + arr_type[x]["name"] + '</option>';
        }

    }

    $("#type").append(type_txt);

})

$("#type").on("change", function() {

    $("#brand option").not(":first").remove();
    $("#inven option").not(":first").remove();

    for (x in arr_brand) {
        var brand_txt;
        if (arr_brand[x]["type"] == $(this).val()) {
            brand_txt += '<option value=' + arr_brand[x]["id"] + '>' + arr_brand[x]["name"] + '</option>';
        }

    }

    $("#brand").append(brand_txt);


})

$("#brand").on("change", function() {

    $("#inven option").not(":first").remove();

    for (x in arr_inven) {
        var inven_txt;
        if (arr_inven[x]["brand"] == $(this).val()) {
            inven_txt += '<option value=' + arr_inven[x]["id"] + '>' + arr_inven[x]["name"] + '</option>';
        }

    }

    $("#inven").append(inven_txt);


})