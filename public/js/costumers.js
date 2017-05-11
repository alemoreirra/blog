$(document).ready(function () {
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img_preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#image").change(function () {
        readURL(this);
    });

    $("#btn_update_image").click(function () {
        $('#div_upload_image').show();
        $('#btn_update_image').hide();
        $('#btn_cancel_update_image').show();
    });

    $("#btn_cancel_update_image").click(function () {
        $('#div_upload_image').hide();
        $('#btn_update_image').show();
        $('#btn_cancel_update_image').hide();
        $('#img_preview').src = $('#img_preview').attr('data-saved');
        $("#img_preview").attr("src", $('#img_preview').attr('data-saved'));
        $("#image").val('');
    });

});