$(document).ready(function () {
    WalletController.init();
});

var WalletController = {
    init: function () {
        WalletController.fillFeeAmount();
    },

    fillFeeAmount: function () {
        $("input[name='number']").keyup(function () {
            if (!/^[0-9]*$/.test(this.value)) {
                this.value = this.value.split(/[^0-9.]/).join('');
            }

            let number = Number(this.value);

            $('#fee').text(number * 1.5 / 100);
        });
    }
};