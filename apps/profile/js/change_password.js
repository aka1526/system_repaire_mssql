$("#form").validate({
    rules: {
        current_password: {
            required: true,
            minlength: 6,
            remote: {
                url: "../profile/do_check_password.php",
                type: "post",
                data: {
                    current_password: function () {
                        return $("#current_password").val();
                    }
                }
            }
        },
        new_password: {
            required: true,
            minlength: 6
        },
        confirm_password: {
            required: true,
            minlength: 6,
            equalTo: "#new_password"
        }
    },
    messages: {
        current_password: {
            required: "Please provide a current password"
        },
        new_password: {
            required: "Please provide a new password",
            minlength: "Your password must be at least 6 characters long"
        },
        confirm_password: {
            required: "Please provide a confirm password",
            minlength: "Your password must be at least 6 characters long",
            equalTo: "Please enter the same password as above"
        },
    },
    errorElement: "em",
    errorPlacement: function (error, element) {
        // Add the `invalid-feedback` class to the error element
        error.addClass("invalid-feedback");

        if (element.prop("type") === "checkbox") {
            error.insertAfter(element.next("label"));
        } else {
            error.insertAfter(element);
        }
    },
    highlight: function (element, errorClass, validClass) {
        $(element).addClass("is-invalid").removeClass("is-valid");
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).addClass("is-valid").removeClass("is-invalid");
    }
})