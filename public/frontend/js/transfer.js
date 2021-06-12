$(document).ready(function () {
    TransferController.init();
});

var TransferController = {
    init: function () {
        $("#submit-transfer").click(function () {
            $("input[name='password-confirm']").val($("#modal_confirm_transfer input[name='password']").val());
            $('#form-transfer').submit();
        });

        TransferController.customSelect();
    },

    customSelect: function() {
        var x, i, j, l, ll, selElmnt, a, b, c;
        /*look for any elements with the class "custom-select":*/
        x = document.getElementsByClassName('select-coin');
        l = x.length;
        for (i = 0; i < l; i++) {
            selElmnt = x[i].getElementsByTagName('select')[0];
            options = $(selElmnt).find('option');
            ll = selElmnt.length;
            /*for each element, create a new DIV that will act as the selected item:*/
            a = document.createElement('DIV');
            a.setAttribute('class', `select-selected ${$(options[0]).attr('class')}`);
            a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
            x[i].appendChild(a);
            /*for each element, create a new DIV that will contain the option list:*/
            b = document.createElement('DIV');
            b.setAttribute('class', 'select-items select-hide');
            for (j = 0; j < ll; j++) {
                /*for each option in the original select element,
                create a new DIV that will act as an option item:*/
                c = document.createElement('DIV');
                c.innerHTML = selElmnt.options[j].innerHTML;
                var className = $(selElmnt.options[j]).attr('class');
                $(c).addClass(className);
                c.addEventListener('click', function (e) {
                    var y, i, k, s, h, sl, yl;
                    s = this.parentNode.parentNode.getElementsByTagName('select')[0];
                    sl = s.length;
                    h = this.parentNode.previousSibling;
                    for (i = 0; i < sl; i++) {
                        if (s.options[i].innerHTML == this.innerHTML) {

                            console.log('xxx' + this.innerHTML)
                            // @todo


                            s.selectedIndex = i;
                            h.innerHTML = this.innerHTML;
                            h.removeAttribute('class');
                            $(h).addClass(`select-selected ${$(this).attr('class')}`);
                            y = this.parentNode.getElementsByClassName('same-as-selected');
                            yl = y.length;
                            for (k = 0; k < yl; k++) {
                                $(y[k]).removeClass('same-as-selected');
                            }
                            $(this).addClass('same-as-selected');
                            break;
                        }
                    }
                    h.click();
                });
                b.appendChild(c);
            }
            x[i].appendChild(b);
            a.addEventListener('click', function (e) {
                /*when the select box is clicked, close any other select boxes,
                and open/close the current select box:*/
                e.stopPropagation();
                TransferController.closeAllSelect(this);
                this.nextSibling.classList.toggle('select-hide');
                this.classList.toggle('select-arrow-active');
            });
        }
    },
    closeAllSelect: function(elmnt) {
        /*a function that will close all select boxes in the document,
        except the current select box:*/
        var x,
          y,
          i,
          xl,
          yl,
          arrNo = [];
        x = document.getElementsByClassName('select-items');
        y = document.getElementsByClassName('select-selected');
        xl = x.length;
        yl = y.length;
        for (i = 0; i < yl; i++) {
            if (elmnt == y[i]) {
                arrNo.push(i);
            } else {
                y[i].classList.remove('select-arrow-active');
            }
        }
        for (i = 0; i < xl; i++) {
            if (arrNo.indexOf(i)) {
                x[i].classList.add('select-hide');
            }
        }
    }
};
