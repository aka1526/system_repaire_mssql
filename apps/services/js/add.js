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

function fc_date() {
	var checkBox = document.getElementById("check_rec") ;
	 var txt_date = document.getElementById("due_date");

  // If the checkbox is checked, display the output text
  if (checkBox.checked == true){
    txt_date.style.display = "block";
    $("#due_date").val(new Date());
 	
  } else {
    txt_date.style.display = "none";
  }

}

$("#forminfo").validate({
    rules: {
        id: "required",
		section: "required",
		borrow_name : "required",
    },
    messages: {
        id: "Please enter your Name",
       section: "Please enter your Section",
	   borrow_name: "Please enter your Name",
      
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



for (x in arr_inven) {
    var inven_txt;
   
    inven_txt += '<option value=' + arr_inven[x]["id"] + '>' + arr_inven[x]["name"] + '</option>';

}


$("#inventory").append(inven_txt);
$("#inventory").val(inven_id);

 
for (x in arr_sec) {
    var sec_txt;
  sec_txt += '<option value=' + arr_sec[x]["id"] + '>' + arr_sec[x]["name"] + '</option>';


}

$("#section").append(sec_txt);
$("#section").val(section);
