
$(document).ready(function () {
  bsCustomFileInput.init()
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
                username: function () {
                    return $("#username").val();
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
              email: function () {
                  return $("#email").val();
              }
          }
      }
  },
      password: {
        required: true,
        minlength: 6
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
