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
    var problem_id = button.data('problem-id')
    var problem_name = button.data('problem-name')
    var modal = $(this)
    modal.find('.modal-body span').text("Are you sure you want to delete " + problem_name + "?")

    $("#modalDelete .btn-continue").off();
    $("#modalDelete .btn-continue").on("click", function() {
        window.location.href = "apps/problem/do_problem.php?action=delete&problem_id=" + problem_id
    })
})

$("#modalDeleteAll .btn-continue").off();
$("#modalDeleteAll .btn-continue").on("click", function() {
    $("#frm").submit();
})

$(".problem-edit").off("click");
$(".problem-edit").on("click", function() {
    var problem_id = $(this).attr("data-problem-id");
    var problem_name = $(this).attr("data-problem-name");

    $("#problem_id").val(problem_id);
    $("#problem_name").val(problem_name);
})

$("#forminfo").validate({
    rules: {
        problem_name: "required",
    },
    messages: {
        problem_name: "Please enter your Problem Name",
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