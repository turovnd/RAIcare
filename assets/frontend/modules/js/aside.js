module.exports = (function (aside) {

    var asideWrapper            = null,
        asideBtn                = null,
        isCollapsed             = null,
        collapseBtns            = null;

    function prepare_() {

        asideWrapper = document.getElementsByClassName('aside')[0];
        asideBtn     = document.getElementById('openAsideMenu');
        collapseBtns = asideWrapper.querySelectorAll('[data-toggle="collapse"]');
        isCollapsed  = false;

        if ( raisoft.cookies.get('aside') === 'collapsed' ) {

            asideWrapper.classList.add('aside--collapsed');
            destroyAsideCollapseBtns_();
            isCollapsed = true;

        }

        asideBtn.addEventListener('click', toggleAsideMenu_);

        if (asideWrapper.getBoundingClientRect().height < asideWrapper.getElementsByClassName('aside__menu ')[0].getBoundingClientRect().height) {

            asideWrapper.classList.add('overflowY--auto');

        }

    }


    /**
     * Toggle Aside Menu Class - collapse || opened
     * @private
     */
    function toggleAsideMenu_() {

        if ( window.innerWidth > 768 ) {

            asideWrapper.classList.toggle('aside--collapsed');

            if (!isCollapsed) {

                raisoft.cookies.set({
                    name: 'aside',
                    value: '~collapsed',
                    path: '/'
                });
                destroyAsideCollapseBtns_();
                isCollapsed = true;

            } else {

                raisoft.cookies.remove('aside');
                createAsideCollapseBtns_();
                isCollapsed = false;

            }

        } else {

            asideWrapper.classList.toggle('aside--opened');

        }

    }


    /**
     *
     * @private
     */
    function createAsideCollapseBtns_() {

        for (var i = 0; i < collapseBtns.length; i++) {

            raisoft.collapse.create(collapseBtns[i]);

        }

    }

    function destroyAsideCollapseBtns_() {

        for (var i = 0; i < collapseBtns.length; i++) {

            raisoft.collapse.destroy(collapseBtns[i]);

        }

    }




    aside.init = function () {

        prepare_();

    };


    return aside;


})({});