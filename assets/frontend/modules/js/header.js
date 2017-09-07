module.exports = (function (header) {

    var headerWrapper   = null,
        headerMenu      = null,
        headerBtn       = null,
        pathname_       = null,
        pathnameHeaderFixed = ['login', 'join', 'reset'];


    function prepare_(type) {

        headerWrapper = document.getElementsByClassName('header')[0];
        pathname_ = window.location.pathname.split('/')[1];

        if (type === 'welcome' && pathnameHeaderFixed.indexOf(pathname_) === -1) {

            window.onscroll = function () {

                changeHeaderBlockClass_();

            };

        } else {

            headerWrapper.classList.remove('header--default');

        }


        headerBtn = document.getElementById('openMobileMenu');
        headerMenu = document.getElementsByClassName('header__menu')[0];

        if (headerBtn)
            headerBtn.addEventListener('click', toggleMobileMenu);

    }



    /**
     * Toggle mobile menu on click
     */
    var toggleMobileMenu = function () {

        headerBtn.classList.toggle('header__open-btn--opened');
        headerMenu.classList.toggle('header__menu--opened');
        document.body.classList.toggle('overflow--hidden');
        document.classList.toggle('overflow--hidden');

        if (document.getElementsByClassName('backdrop')[0]) {

            document.getElementsByClassName('backdrop')[0].remove();


        } else {

            var backdrop = raicare.draw.node('DIV', 'backdrop');

            document.body.appendChild(backdrop);
            backdrop.addEventListener('click', toggleMobileMenu, false);

        }


    };


    /**
     * Chane header class in Welcome module
     * @private
     */
    function changeHeaderBlockClass_() {

        if ( window.scrollY > 5 ) {

            headerWrapper.classList.remove('header--default');

        } else {

            headerWrapper.classList.add('header--default');

        }

    }


    /**
     * Init header by type
     * @param type = welcome || app
     */
    header.init = function (type) {

        prepare_(type);

    };

    return header;

})({});
