$(document).ready(function () {
    InvestController.init();
});

var InvestController = {
    init: function () {
        InvestController.validateNumberInvest();
    },

    validateNumberInvest: function () {
        $("input[name='number']").keyup(function () {
            var regexp = /^\d+(,\d{1,2})?$/;
            if (!(regexp.test(this.value))) {
                this.value = this.value.split(/[^0-9,]/).join('');
            }
        });
    }
};