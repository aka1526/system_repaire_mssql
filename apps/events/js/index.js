$(document).ready(function(){
    $(".table").DataTable({
        responsive: true,
        "order": [[ 0, "asc" ]],
        "columnDefs": [
            { "targets": [1,3], "orderable": false }
        ]
    });
    
})