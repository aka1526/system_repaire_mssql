$(document).ready(function() {
    var type_txt;
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
    var brand_id = button.data('brand-id')
    var brand_name = button.data('brand-name')
    var modal = $(this)
    modal.find('.modal-body span').text("Are you sure you want to delete " + brand_name + "?")

    $("#modalDelete .btn-continue").off();
    $("#modalDelete .btn-continue").on("click", function() {
        window.location.href = "apps/brand/do_brand.php?action=delete&brand_id=" + brand_id
    })
})

$("#modalDeleteAll .btn-continue").off();
$("#modalDeleteAll .btn-continue").on("click", function() {
    $("#frm").submit();
})

$(".brand-edit").off("click");
$(".brand-edit").on("click", function() {
    var brand_id = $(this).attr("data-brand-id");
    var brand_name = $(this).attr("data-brand-name");
    var brand_status = $(this).attr('data-brand-status')


    if (brand_status == "Y") {
        $("#status").prop("checked", true);
    } else {
        $("#status").prop("checked", false);
    }

    // $("#status").val(brand_status);
    $("#brand_id").val(brand_id);
    $("#brand_name").val(brand_name);

})

$('#formModal').on('hidden.bs.modal', function(event) {
    $(this)
        .find("input,textarea,select")
        .val('')
        .end()
        // .find("input[type=checkbox], input[type=radio]")
        // .find("input[type=radio]").val("")
        // .prop("checked", true)
        .end();
})

$("#forminfo").validate({
    rules: {
        brand_name: "required",
        type: "required",
    },
    messages: {
        brand_name: "Please enter your brand Name",
        type: "Please enter your Category",
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