$(document).ready(function () {
    $("#image").change(function (e) {
        $("#show-image").attr("src", URL.createObjectURL(e.target.files[0]));
    });
});
