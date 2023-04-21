function removerToastr() {
    var toastr = document.getElementById("toastr");
    toastr.remove();
};

function removerToastrAutomaticamente() {
    var toastr = document.getElementById("toastr");
    setTimeout(function() {
        toastr.remove();
    }, 4000);
}