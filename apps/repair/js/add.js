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

//$("#inven option").not(":first").remove();
for (x in arr_inven) {
    var inven_txt;

    inven_txt += '<option value=' + arr_inven[x]["id"] + '>' + arr_inven[x]["name"] + '</option>';
}
$("#inven").append(inven_txt);
$("#inven").val(inven);




for (x in arr_pro) {
    var pro_txt;

    pro_txt += '<option value=' + arr_pro[x]["id"] + '>' + arr_pro[x]["name"] + '</option>';
}
$("#problem").append(pro_txt);