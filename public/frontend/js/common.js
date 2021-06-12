$(document).ready(function () {
    CommonController.init();
});

var CommonController = {
    init: function () {
        CommonController.submitForm();

        $('.my-select2__select2').select2({
            allowClear: true
        });
    },

    submitForm: function () {
        $('form').on('submit', function () {
            $.LoadingOverlay("show", {zIndex: 999999999});
            return true;
        });
    },
};

function showLoading() {
    $.LoadingOverlay("show", {zIndex: 999999999});
}

function hideLoading() {
    $.LoadingOverlay("hide");
}

function countCharacters(str, char) {
    if (str.trim().length == 0) {
        return 0;
    }
    return str.split(char).length - 1;
}

function isExistInStr(str, need) {
    return str.indexOf(need) != -1;
}

function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}