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
        name: "required",
        category: "required",
        section: "required",
        type: "required",
        brand: "required",
        inven_status: "required",
    },
    messages: {
        name: "Please enter your Name",
        category: "Please enter your Category",
        section: "Please enter your Section",
        type: "Please enter your Type",
        brand: "Please enter your Brand",
        inven_status: "Please enter your Status",
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

$(function() {

    for (x in arr_cate) {
        var cate_selected = "";
        if (category == arr_cate[x]["id"]) {
            cate_selected = "selected";
        }

        var cate_txt;
        cate_txt += '<option value=' + arr_cate[x]["id"] + ' ' + cate_selected + '>' + arr_cate[x]["name"] + '</option>';
    }

    $("#category").append(cate_txt);

    for (x in arr_sec) {
        var sec_txt;
        //if (arr_type[x]["category"] == category) {
        sec_txt += '<option value=' + arr_sec[x]["id"] + '>' + arr_sec[x]["name"] + '</option>';
        //}

    }

    $("#section").append(sec_txt);
    $("#section").val(section);



    for (x in arr_type) {
        var type_txt;
        //if (arr_type[x]["category"] == category) {
        type_txt += '<option value=' + arr_type[x]["id"] + '>' + arr_type[x]["name"] + '</option>';
        //}

    }

    $("#type").append(type_txt);
    $("#type").val(type);

    /////////////////////////////////////

    for (x in arr_brand) {
        var brand_txt;
        //  if (arr_brand[x]["type"] == type) {
        brand_txt += '<option value=' + arr_brand[x]["id"] + '>' + arr_brand[x]["name"] + '</option>';
        // }

    }

    $("#brand").append(brand_txt);
    $("#brand").val(brand);

    for (x in arr_stat) {
        var stat_txt;
        //  if (arr_brand[x]["type"] == type) {
        stat_txt += '<option value=' + arr_stat[x]["id"] + '>' + arr_stat[x]["name"] + '</option>';
        // }

    }

    $("#inven_status").append(stat_txt);
    $("#inven_status").val(inven_status);

    for (x in arr_os) {
        var os_txt;
        //  if (arr_brand[x]["type"] == type) {
        os_txt += '<option value=' + arr_os[x]["os_id"] + '>' + arr_os[x]["os_name"] + '</option>';
        // }

    }

    $("#os_name").append(os_txt);
    $("#os_name").val(os_name);

    $("#expire_date").val(expire_date);
    $("#owner_name").val(owner_name);
    $("#cpu_model").val(cpu_model);
    $("#ram_model").val(ram_model);
    $("#hdd_model").val(hdd_model);
    $("#monitor_model").val(monitor_model);

    /////////////////////////////////////
    /*
        $("#category").on("change", function() {

            $("#type option").not(":first").remove();
            $("#brand option").not(":first").remove();

            for (x in arr_type) {


                var type_txt;
                //  if (arr_type[x]["category"] == $(this).val()) {
                type_txt += '<option value=' + arr_type[x]["id"] + '>' + arr_type[x]["name"] + '</option>';
                //  }

            }

            $("#type").append(type_txt);
        })
    */
    /*
        $("#type").on("change", function() {

            $("#brand option").not(":first").remove();

            for (x in arr_brand) {
                var brand_txt;
                if (arr_brand[x]["type"] == $(this).val()) {
                    brand_txt += '<option value=' + arr_brand[x]["id"] + '>' + arr_brand[x]["name"] + '</option>';
                }

            }

            $("#brand").append(brand_txt);
        })
    */

});