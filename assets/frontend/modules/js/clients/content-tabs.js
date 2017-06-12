module.exports = (function (tabs) {

    function prepareTabs_() {

        var btns      = document.getElementsByClassName('tabs__btn'),
            activeTab = raisoft.cookies.get('clients');

        for (var i = 0; i < btns.length; i++) {

            btns[i].addEventListener('click', changeTabs_);

        }


        if (activeTab !== undefined && document.querySelector('[data-block="' + activeTab + '"]'))
            document.querySelector('[data-block="' + activeTab + '"]').click();

    }


    function changeTabs_() {

        raisoft.cookies.set({
            name: 'clients',
            value: '~'+this.dataset.block,
            expires: 3600,
            path: '/'
        });

    }


    tabs.init = function () {

        prepareTabs_();

    };

    return tabs;

})({});