module.exports = (function (onclick) {

    var corePrefix       = 'Report: onclick';

    onclick.triggered = function (element) {

        var area        = element.dataset.area,
            block       = document.getElementById(area).getElementsByTagName('tbody')[0],
            isAllShown  = element.dataset.opened,
            items       = null;

        if (isAllShown === 'true')
            element.dataset.opened = 'false';
        else
            element.dataset.opened = 'true';

        items = block.querySelectorAll('tr[data-triggered="false"]');

        for (var i = 0; i < items.length; i++) {

            items[i].classList.toggle('hide');

        }

    };

    return onclick;

})({});