$(document).ready(function() {
    var section_txt;
    console.log(permission)
    $(".table").DataTable({
        responsive: true,
        "order": [
            [0, "asc"]
        ],
        "columnDefs": [
            { "targets": [1, 4], "orderable": false }
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
    var os_id = button.data('os-id')
    var os_name = button.data('os-name')
    var modal = $(this)
    modal.find('.modal-body span').text("Are you sure you want to delete " + os_name + "?")

    $("#modalDelete .btn-continue").off();
    $("#modalDelete .btn-continue").on("click", function() {
        window.location.href = "apps/osname/do_osname.php?action=delete&os_id=" + os_id
    })
})

$("#modalDeleteAll .btn-continue").off();
$("#modalDeleteAll .btn-continue").on("click", function() {
    $("#frm").submit();
})

$(".os-edit").off("click");
$(".os-edit").on("click", function() {
    var os_id = $(this).attr("data-os-id");
    var os_name = $(this).attr("data-os-name");
    var stat = $(this).attr('data-os-stat');


    if (stat == "Y") {
        $("#status").prop("checked", true);
    } else {
        $("#status").prop("checked", false);
    }


    $("#os_id").val(os_id);
    $("#os_name").val(os_name);


})

$("#forminfo").validate({
    rules: {
        os_name: "required",
        os_id: "required",
    },
    messages: {
        os_name: "Please enter your os Name",
        os_id: "Please enter your os id",
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