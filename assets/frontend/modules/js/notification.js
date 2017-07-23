module.exports = (function (notification) {

    var queue   = [],
        holder  = null;


    var addToQueue = function (settings) {

        queue.push(settings);

        var index = 0;

        while ( index < queue.length && queue.length > 5) {

            if (queue[index].type === 'confirm' || queue[index].type === 'prompt') {

                index++;
                continue;

            }

            queue[index].close();
            queue.splice(index, 5);

        }

    };


    notification.createHolder = function () {

        var tempHolder = raicare.draw.node('DIV', 'notifications-block');

        holder = document.body.appendChild(tempHolder);

        return tempHolder;

    };


    /**
     *
     * Notify Function
     *
     *  settings = {
     *      type             - notification type (reserved types: alert, confirm, prompt). Just add class 'cdx-notification-'+type
     *      size             - width of notification block (small || large)
     *      message          - notification message
     *      showCancelButton - show Cancel button (true/false)
     *      validation       - true || false - customer validation
     *      confirmText      - confirm button text (default - 'Ok')
     *      cancelText       - cancel button text (default - 'Cancel'). Only for confirm and prompt types
     *      confirm          - function-handler for ok button click
     *      cancel           - function-handler for cancel button click. Only for confirm and prompt types
     *      time             - time (in seconds) after which notification will close (default - 5s)
     *  }
     *
     * @param constructorSettings
     */
    notification.notify = function (constructorSettings) {

        /** Private vars and methods */
        var notifyWrapper = null,
            cancel        = null,
            type          = null,
            confirm       = null,
            inputField    = null,
            backdrop      = null,
            validation    = null;


        var confirmHandler = function () {

            if (!validation)
                close();

            if (typeof confirm !== 'function' ) {

                return;

            }

            if (type === 'prompt') {

                confirm(inputField.value);
                return;

            }

            confirm();

        };


        var cancelHandler = function () {

            close();

            if (typeof cancel !== 'function' ) {

                return;

            }

            cancel();

        };


        /** Public methods */
        function create(settings) {

            if (!(settings && settings.message)) {

                raicare.core.log('Can\'t create notification. Message is missed', 'error', 'notification');
                return;

            }

            settings.type = settings.type || 'alert';
            settings.time = settings.time * 1000 || 3000;

            var wrapper     = raicare.draw.node('DIV', 'notification'),
                message     = raicare.draw.node('DIV', 'notification__message'),
                input       = raicare.draw.node('INPUT', 'notification__input'),
                confirmBtn  = raicare.draw.node('SPAN', 'notification__confirm-btn'),
                cancelBtn   = raicare.draw.node('SPAN', 'notification__cancel-btn'),
                backdropBl  = raicare.draw.node('DIV', 'notification-backdrop');

            message.innerHTML       = settings.message;

            if (settings.size) {

                wrapper.classList.add('notification--' + settings.size);

            }

            wrapper.classList.add('notification--' + settings.type);
            wrapper.appendChild(message);

            if (settings.type === 'prompt' || settings.type === 'confirm') {

                confirmBtn.textContent = settings.confirmText || 'ОК';
                cancelBtn.textContent = settings.cancelText || 'Отмена';

                if (!document.getElementsByClassName('notification__backdrop')[0]) {

                    backdrop = document.body.appendChild(backdropBl);
                    document.body.classList.add('overflow--hidden');
                    backdrop.addEventListener('click', cancelHandler);

                }

                if (settings.type === 'prompt') {

                    wrapper.appendChild(input);

                }

                wrapper.appendChild(confirmBtn);

                if (settings.showCancelButton) {

                    wrapper.appendChild(cancelBtn);

                    cancelBtn.addEventListener('click', cancelHandler);

                }

                confirmBtn.addEventListener('click', confirmHandler);

            }

            if (settings.type !== 'prompt' && settings.type !== 'confirm') {

                window.setTimeout(close, settings.time);

            }


            notifyWrapper = wrapper;
            type = settings.type;
            validation = settings.validation;
            confirm = settings.confirm;
            cancel = settings.cancel;
            inputField = input;

        }


        function send() {

            holder.appendChild(notifyWrapper);
            inputField.focus();

            if (type === 'prompt' || type === 'confirm') {

                notifyWrapper.classList.add('notification--animation-in');

                window.setTimeout(function () {

                    notifyWrapper.classList.remove('notification--animation-in');

                }, 400);

            } else {

                notifyWrapper.classList.add('notification--animation-in-down');

                window.setTimeout(function () {

                    notifyWrapper.classList.remove('notification--animation-in-down');

                }, 400);

            }

            addToQueue({type: type, close: close});

        }


        function close() {

            if (type === 'prompt' || type === 'confirm') {

                notifyWrapper.classList.add('notification--animation-out');

            } else {

                notifyWrapper.classList.add('notification--animation-in-up');

            }

            window.setTimeout(function () {

                notifyWrapper.remove();

                if (backdrop) {

                    document.body.classList.remove('overflow--hidden');

                    backdrop.remove();

                }

            }, 400);

        }


        if (constructorSettings) {

            create(constructorSettings);
            send();

        }

        return {
            create: create,
            send: send,
            close: close
        };

    };


    notification.clear = function () {

        holder  = null;
        queue   = [];

    };


    return notification;

})({});