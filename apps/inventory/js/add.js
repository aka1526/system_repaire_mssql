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
        brand: "required",
    },
    messages: {
        name: "Please enter your Name",
        category: "Please enter your Category",
        section: "Please enter your Section",
        brand: "Please enter your Brand",
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
    // alert('sdsd');
    cate_txt += '<option value=' + arr_cate[x]["id"] + '>' + arr_cate[x]["name"] + '</option>';

}


$("#category").append(cate_txt);

for (x in arr_type) {
    var type_txt;
    type_txt += '<option value=' + arr_type[x]["id"] + '>' + arr_type[x]["name"] + '</option>';
}
$("#type").append(type_txt);


for (x in arr_brand) {
    var brand_txt;
    brand_txt += '<option value=' + arr_brand[x]["id"] + '>' + arr_brand[x]["name"] + '</option>';
}
$("#brand").append(brand_txt);

for (x in arr_sec) {
    var sec_txt;
    //if (arr_type[x]["category"] == category) {
    sec_txt += '<option value=' + arr_sec[x]["id"] + '>' + arr_sec[x]["name"] + '</option>';
    //}

}

$("#section").append(sec_txt);
$("#section").val(section);



for (x in arr_stat) {
    var stat_txt;
    //  if (arr_brand[x]["type"] == type) {
    stat_txt += '<option value=' + arr_stat[x]["id"] + '>' + arr_stat[x]["name"] + '</option>';
    // }

}


$("#inven_status").append(stat_txt);
$("#inven_status").val(inven_status);
$("#expire_date").val(expire_date);