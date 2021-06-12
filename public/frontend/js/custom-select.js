var app = app || {};
$(function () {
    app.init();
});

app.init = function () {
    app.customSelect();
};

app.customSelect = function () {
    var x, i, j, l, ll, selElmnt, a, b, c;
    /*look for any elements with the class "custom-select":*/
    x = document.getElementsByClassName('js-custom-select');
    l = x.length;
    for (i = 0; i < l; i++) {
        selElmnt = x[i].getElementsByTagName('select')[0];
        options = $(selElmnt).find('option');
        ll = selElmnt.length;
        /*for each element, create a new DIV that will act as the selected item:*/
        a = document.createElement('DIV');
        a.setAttribute('class', 'select-selected ' + $('select[name="lang"] :selected').attr('class'));
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
                        console.log('Language:' + this.innerHTML);
                        changeLanguage(this.innerHTML);
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
            e.stopPropagation();
            closeAllSelect(this);
            this.nextSibling.classList.toggle('select-hide');
            this.classList.toggle('select-arrow-active');
        });
    }
};

function closeAllSelect(elmnt) {
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
};

function changeLanguage(lang) {
    let langOrigin = $('.select-selected').text();
    if (lang == langOrigin) {
        return;
    }

    var url = $('input[name="url-change-language"]').val();
    var csrf = $('meta[name="csrf-token"]').attr('content');

    let data = {
        'lang': lang
    };

    showLoading();

    $.ajax({
        type: 'POST',
        url: url,
        headers: {'X-CSRF-TOKEN': csrf},
        data: data,
        cache: false,
        success: function (response) {
            if (response.status == 200) {
                console.log('Change language successfully ... ')
            } else {
                console.log('Change language error ... ')
            }
            hideLoading();
            location.reload();
        },
        error: function (e) {
            console.log('Change language error ... ')
            hideLoading();
        }
    });
}