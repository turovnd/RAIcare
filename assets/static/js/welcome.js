var welcome = (function (welcome) {

    var headerWrapper   = null,
        headerMenu      = null,
        headerBtn       = null,
        footerWrapper   = null,
        section         = null;


    function prepareHeader_() {

        headerWrapper   = document.getElementsByClassName('header')[0];
        headerBtn       = document.getElementById('openMobileMenu');
        headerMenu      = document.getElementsByClassName('header__menu')[0];

        changeHeaderBlockClass_();

        window.onscroll = function () {
            changeHeaderBlockClass_();
        };

        if (headerBtn)
            headerBtn.addEventListener('click', toggleMobileMenu);

    }



    function prepareFooter_() {

        footerWrapper   = document.getElementsByClassName('footer')[0];
        section         = document.getElementsByTagName('section')[0];

        changeFooterBlockClass_();

        window.onresize = function () {
            changeFooterBlockClass_();
        };

    }


    /**
     * Toggle mobile menu on click
     */
    var toggleMobileMenu = function () {

        headerBtn.classList.toggle('header__open-btn--opened');
        headerMenu.classList.toggle('header__menu--opened');
        document.body.classList.toggle('overflow--hidden');

        if (document.getElementsByClassName('backdrop')[0]) {

            document.getElementsByClassName('backdrop')[0].remove();


        } else {

            var backdrop = raicare.draw.node('DIV', 'backdrop');

            document.body.appendChild(backdrop);
            backdrop.addEventListener('click', toggleMobileMenu, false);

        }


    };


    function changeHeaderBlockClass_() {

        if ( window.scrollY > 5 ) {

            headerWrapper.classList.remove('header--default');

        } else {

            headerWrapper.classList.add('header--default');

        }

    }


    function changeFooterBlockClass_() {

        if (document.body.offsetHeight > section.offsetHeight - 56 + footerWrapper.offsetHeight) {

            footerWrapper.classList.add('footer--fixed');

        } else {

            footerWrapper.classList.remove('footer--fixed');

        }

    }


    welcome.init = function (arr) {

        if (arr.indexOf('header') !== -1) {
            prepareHeader_();
        }

        if (arr.indexOf('footer') !== -1) {
            prepareFooter_();
        }

    };

    return welcome;

})({});
