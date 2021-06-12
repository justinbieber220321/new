$(document).ready(function () {
    UserController.init();
});

var UserController = {
    init: function () {
        UserController.showImageThumbnail();

        $('.img-thumbnail-wrapper .img-thumbnail').click(function () {
            $('input[name=avatar]').trigger('click');
        });
    },

    showImageThumbnail() {
        $('#upload').change(function () {
            var input = this;
            var url = $(this).val();
            var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.img-thumbnail-wrapper .img-thumbnail').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        });
    },
};