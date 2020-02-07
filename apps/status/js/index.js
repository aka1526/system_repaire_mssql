$(document).ready(function(){
    var type_txt;
        $(".table").DataTable({
            responsive: true,
            "order": [[ 0, "asc" ]],
            "columnDefs": [
                { "targets": [1,3], "orderable": false }
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

$("#checkall").on("click", function(){
    if($(this).is(':checked')){
        $("input[name='ch[]']").prop("checked", true);
    }else{
        $("input[name='ch[]']").prop("checked", false);
    }
   
})  

$("input[type='checkbox']").on("click", function(){
    if($(this).is(':checked')){
        $(".btn-delete-all").prop("disabled", false);
    }else{
        $(".btn-delete-all").prop("disabled", true);
    }
})

$('#modalDelete').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var status_id = button.data('status-id')
    var status_name = button.data('status-name')
    var modal = $(this)
    modal.find('.modal-body span').text("Are you sure you want to delete "+status_name+"?")

    $("#modalDelete .btn-continue").off();
    $("#modalDelete .btn-continue").on("click", function(){
        window.location.href="apps/status/do_status.php?action=delete&status_id="+status_id
    })
  })

$("#modalDeleteAll .btn-continue").off();
$("#modalDeleteAll .btn-continue").on("click", function(){
    $("#frm").submit();
})

$(".status-edit").off("click");
$(".status-edit").on("click", function(){
    var status_id = $(this).attr("data-status-id");
    var status_name = $(this).attr("data-status-name");

    $("#status_id").val(status_id);
    $("#status_name").val(status_name);
})

$("#forminfo").validate({
    rules: {
      category_name: "required",
    },
    messages: {
        category_name: "Please enter your Category Name",
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
