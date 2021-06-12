$(document).ready(function () {
    SystemController.init();
});

var SystemController = {
    init: function () {
        SystemController.showLogoThumbnail();
        SystemController.showFaviconThumbnail();
        SystemController.validateRateRps();

        $('.uploadLogo .img-thumbnail-wrapper .img-thumbnail').click(function () {
            $('input[name=logo]').trigger('click');
        });

        $('.uploadFavicon .img-thumbnail-wrapper .img-thumbnail').click(function () {
            $('input[name=favicon]').trigger('click');
        });
    },

    showLogoThumbnail() {
        $('#uploadLogo').change(function () {
            var input = this;
            var url = $(this).val();
            var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.uploadLogo .img-thumbnail-wrapper .img-thumbnail').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        });
    },

    showFaviconThumbnail() {
        $('#uploadFavicon').change(function () {
            var input = this;
            var url = $(this).val();
            var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.uploadFavicon .img-thumbnail-wrapper .img-thumbnail').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        });
    },

    validateRateRps() {
        $("input[name='rate_rps']").keyup(function () {
            var regexp = /^\d+(,\d{1,2})?$/;
            if (!(regexp.test(this.value))) {
                this.value = this.value.split(/[^0-9,]/).join('');
            }
        });
    },
};