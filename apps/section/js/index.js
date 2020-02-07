$(document).ready(function() {
    var section_txt;
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
            section_txt = "success";
        } else {
            section_txt = "error";
        }

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });


        Toast.fire({
            type: section_txt,
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
    var section_id = button.data('section-id')
    var section_name = button.data('section-name')
    var modal = $(this)
    modal.find('.modal-body span').text("Are you sure you want to delete " + section_name + "?")

    $("#modalDelete .btn-continue").off();
    $("#modalDelete .btn-continue").on("click", function() {
        window.location.href = "apps/section/do_section.php?action=delete&section_id=" + section_id
    })
})

$("#modalDeleteAll .btn-continue").off();
$("#modalDeleteAll .btn-continue").on("click", function() {
    $("#frm").submit();
})

$(".section-edit").off("click");
$(".section-edit").on("click", function() {
    var section_id = $(this).attr("data-section-id");
    var section_name = $(this).attr("data-section-name");
    var section_status = $(this).attr('data-section-status')
    var section_category = $(this).attr('data-section-category')

    if (section_category == "Y") {
        $("#status").prop("checked", true);
    } else {
        $("#status").prop("checked", false);
    }

    // $("#status").val(section_status);
    $("#section_id").val(section_id);
    $("#section_name").val(section_name);
    $("#category").val(section_category);
})

$("#forminfo").validate({
    rules: {
        section_name: "required",
        category: "required",
    },
    messages: {
        section_name: "Please enter your type Name",
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