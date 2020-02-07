
$(document).ready(function () {
    bsCustomFileInput.init()
    
    var type_txt;
    $(".table").DataTable({
        responsive: true,
        "order": [[ 0, "asc" ]],
        "columnDefs": [
            { "targets": [1,2,6], "orderable": false }
        ]
    });

    if(msg){

        if(status == true){
            type_txt = "success";
        }else{
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
  })
  
  $("#photo").on("change", function(){
    var photo = $(this).val();
    if(photo == ""){
      $(".btn-upload").prop("disabled", true);
    }else{
      $(".btn-upload").prop("disabled", false);
    }
  });
  
  function readURL(input) {
    OnUploadCheck();
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
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
        // $("#photo_profile").attr("src", "../../img/profile-default.png");
        return false;
    }
  
  
    return true;
  }
  
  $("#forminfo").validate({
    rules: {
      title: "required",
      name: "required",
    },
    messages: {
        title: "Please enter your System Title",
        name: "Please enter your System Name",
    },
    errorElement: "em",
    errorPlacement: function (error, element) {
        // Add the `invalid-feedback` class to the error element
        error.addClass("invalid-feedback");
        error.insertAfter(element);
        
  
    },
    highlight: function (element, errorClass, validClass) {
        $(element).addClass("is-invalid").removeClass("is-valid");
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).addClass("is-valid").removeClass("is-invalid");
    }
  });
  