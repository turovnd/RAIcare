module.exports = (function (modal) {


    function prepare_() {

        var modalOpenBtns = document.querySelectorAll('[data-toggle="modal"]');

        for (var i = 0; i < modalOpenBtns.length; i++) {

            modalOpenBtns[i].addEventListener('click', modal.show);

        }


    }


    /**
     * Modal Create Function via JS
     *
     *  settings = {
     *      id          - unique ID of modal block
     *      size        - width of modal block (small || large)
     *      header      - STRING
     *      body        - body HTML
     *      footer      - footer HTML ( for close include data attribute: `data-close="modal"`)
     *  }
     */
    modal.create = function (settings) {

        var modalWrapper = raisoft.draw.node('DIV', 'modal', {id: settings.id, 'tabindex': '-1'}),
            content      = raisoft.draw.node('DIV', 'modal__content'),
            header       = raisoft.draw.node('DIV', 'modal__header'),
            headerTitle  = raisoft.draw.node('H4', 'modal__title'),
            closeHeadBtn = raisoft.draw.node('BUTTON', 'modal__title-close', {'data-close':'modal'}),
            body         = raisoft.draw.node('DIV', 'modal__body'),
            footer       = raisoft.draw.node('DIV', 'modal__footer');

        closeHeadBtn.innerHTML = '<i class="fa fa-close" aria-hidden="true"></i>';
        headerTitle.textContent = settings.header;
        header.appendChild(closeHeadBtn);
        header.appendChild(headerTitle);

        closeHeadBtn.addEventListener('click', modal.hide);

        body.innerHTML = settings.body;

        content.appendChild(header);
        content.appendChild(body);

        if (settings.footer !== undefined) {

            footer.innerHTML = settings.footer;

            var closeBtns = footer.querySelectorAll('[data-close="modal"]');

            for(var i = 0; i < closeBtns.length; i++) {

                closeBtns[i].addEventListener('click', modal.hide);

            }

            content.appendChild(footer);

        }

        content.classList.add('modal__content--' + settings.size);
        modalWrapper.appendChild(content);

        document.body.appendChild(modalWrapper);

        modal.show(modalWrapper);

    };


    modal.show = function (element) {

        var block = null;

        if (element.nodeType === 1) {

            block = element;

        } else {

            if (this.dataset.area !== undefined) {

                block = document.getElementById(this.dataset.area);

            } else {

                raisoft.core.log('Can not catch `data-area`', 'error', 'RAIsoft: modal module');
                return;

            }


        }

        var closes = block.querySelectorAll('[data-close="modal"]');

        for (var i = 0; i < closes.length; i++) {

            closes[i].addEventListener('click', modal.hide);

        }

        var backdrop = raisoft.draw.node('DIV', 'modal-backdrop');

        block.classList.add('modal--opened');
        document.body.classList.add('overflow--hidden');
        document.body.appendChild(backdrop);

    };

    modal.hide = function (element) {

        var block = null;

        if (element.nodeType === 1) {

            block = element;

        } else {

            block = document.getElementsByClassName('modal--opened')[0];

        }

        block.classList.remove('modal--opened');

        window.setTimeout(function () {

            document.body.classList.remove('overflow--hidden');
            document.getElementsByClassName('modal-backdrop')[0].remove();

        }, 150);

    };


    modal.init = function () {

        prepare_();

    };


    return modal;

})({});