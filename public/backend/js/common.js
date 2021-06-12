$(document).ready(function () {
    CommonController.init();
});

var CommonController = {
    init: function () {
        //Set maxlength of all the textarea (call plugin)
        $().maxlength();

        $('.my-select2__select2').select2({
            allowClear: true
        });
        CommonController.submitForm();
        CommonController.handleClickShowModalConfirmDelete();
    },

    submitForm: function () {
        $('form').on('submit', function () {
            $.LoadingOverlay("show", {zIndex: 999999999});
            return true;
        });
    },

    handleClickShowModalConfirmDelete: function() {
        $('.modal_confirm_delete').on('click', function () {
            var action = $(this).data('form-action');
            $('.modal_confirm .form_confirm_delete').attr('action', action);
        });
    },
};

function showLoading() {
    $.LoadingOverlay("show", {zIndex: 999999999});
}

function hideLoading() {
    $.LoadingOverlay("hide");
}

function selectorIsExits(selector) {
    return $(selector).length > 0;
}
