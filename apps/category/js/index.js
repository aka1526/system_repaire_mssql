$(document).ready(function(){
    var type_txt;
        $(".table").DataTable({
            responsive: true,
            "order": [[ 0, "asc" ]],
            "columnDefs": [
                { "targets": [1,4], "orderable": false }
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

// function check_all(s){
//     var checkboxes = document.getElementsByName("ch[]");
//     for(var i=0, n=checkboxes.length;i<n;i++) {
//         checkboxes[i].checked = s.checked;
//     }
// }


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
    var cate_id = button.data('cate-id')
    var cate_name = button.data('cate-name')
    var modal = $(this)
    modal.find('.modal-body span').text("Are you sure you want to delete "+cate_name+"?")

    $("#modalDelete .btn-continue").off();
    $("#modalDelete .btn-continue").on("click", function(){
        window.location.href="apps/category/do_category.php?action=delete&cate_id="+cate_id
    })
  })

$("#modalDeleteAll .btn-continue").off();
$("#modalDeleteAll .btn-continue").on("click", function(){
    $("#frm").submit();
})

$(".cate-edit").off("click");
$(".cate-edit").on("click", function(){
    var cate_id = $(this).attr("data-cate-id");
    var cate_name = $(this).attr("data-cate-name");
    var cate_status = $(this).attr('data-cate-status')

    if(cate_status == "Y"){
        $("#status").prop("checked", true);
    }else{
        $("#status").prop("checked", false);
    }

    // $("#status").val(cate_status);
    $("#category_id").val(cate_id);
    $("#category_name").val(cate_name);
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

//   $(".btn-plus").on("click", function(){
//       var count = parseFloat($("#hdcount").val()) + 1;
//       $("#hdcount").val(count);
//   })