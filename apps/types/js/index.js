$(document).ready(function() {
    var type_txt;
    console.log(permission)
    $(".table").DataTable({
        responsive: true,
        "order": [
            [0, "asc"]
        ],
        "columnDefs": [
            { "targets": [1, 3], "orderable": false }
        ]
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
})

$("#checkall").on("click", function() {
    if ($(this).is(':checked')) {
        $("input[name='ch[]']").prop("checked", true);
    } else {
        $("input[name='ch[]']").prop("checked", false);
    }

})

$("input[type='checkbox']").on("click", function() {
    if ($(this).is(':checked')) {
        $(".btn-delete-all").prop("disabled", false);
    } else {
        $(".btn-delete-all").prop("disabled", true);
    }
})

$('#modalDelete').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var type_id = button.data('type-id')
    var type_name = button.data('type-name')
    var modal = $(this)
    modal.find('.modal-body span').text("Are you sure you want to delete " + type_name + "?")

    $("#modalDelete .btn-continue").off();
    $("#modalDelete .btn-continue").on("click", function() {
        window.location.href = "apps/types/do_type.php?action=delete&type_id=" + type_id
    })
})

$("#modalDeleteAll .btn-continue").off();
$("#modalDeleteAll .btn-continue").on("click", function() {
    $("#frm").submit();
})

$(".type-edit").off("click");
$(".type-edit").on("click", function() {
    var type_id = $(this).attr("data-type-id");
    var type_name = $(this).attr("data-type-name");
    var type_status = $(this).attr('data-type-status')
    var type_category = $(this).attr('data-type-category')

    if (type_category == "Y") {
        $("#status").prop("checked", true);
    } else {
        $("#status").prop("checked", false);
    }

    // $("#status").val(type_status);
    $("#type_id").val(type_id);
    $("#type_name").val(type_name);
    // $("#category").val(type_category);
})

$("#forminfo").validate({
    rules: {
        type_name: "required",
        //  category: "required",
    },
    messages: {
        type_name: "Please enter your type Name",
        category: "Please enter your Category",
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