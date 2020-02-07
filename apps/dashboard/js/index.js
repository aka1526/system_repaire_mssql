$(document).ready(function() {

});

function popitup(url, windowName) {
    newwindow = window.open(url, windowName, 'height=600,width=450');
    if (window.focus) { newwindow.focus() }
    return false;
}

function popupWindow(url, title, win, w, h) {
    const y = win.top.outerHeight / 2 + win.top.screenY - (h / 2);
    const x = win.top.outerWidth / 2 + win.top.screenX - (w / 2);
    return win.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + y + ', left=' + x);
}


function myFunction(id) {
    var url = "index.php?page=inventory/edit&inventory_id=" + id;
    popupWindow(url, "Title Bar", window, 1000, 600);
}


function myRepaire(id) {
    var url = "index.php?page=repair/add&inventory_id=" + id;
    popupWindow(url, "Title Bar", window, 1000, 600);
}


function myHistory(id) {
    var url = "./?page=repair/view&inventory_id=" + id;
    popupWindow(url, "Title Bar", window, 1000, 600);
}






$("#search").focus();
$("#search").val(search);

setTimeout(function() {
    location.reload();
}, 5 * 1000);