module.exports = (function (progress) {

    var corePrefix = 'Progress';

    progress.init = function () {

        var progresses = document.getElementsByClassName('js-progress');

        for (var i = 0; i < progresses.length; i++) {

            new Progress(progresses[i]);

        }

    };

    progress.create = function (el) {

        if (el.nodeType !== 1) {

            raisoft.core.log('Is not HTML element', 'error', corePrefix);
            return;

        }

        new Progress(el);

    };

    var Progress = function (el) {

        var r = el,
            settings = {
                width: el.width || 200,
                height: el.height || 40,
                animate: el.dataset.animate || true,
                inPercent: el.dataset.inpercent || 'false',
                showText: el.dataset.showtext || 'true',
                showLabels: el.dataset.showlabels || 'true',
                min: el.dataset.min || 0,
                max: el.dataset.max || 10,
                value: el.dataset.value || 5,
                speed: el.dataset.speed || 1,
                fontFamily: el.dataset.fontfamily || 'sans-serif',
                fontStyle: el.dataset.fontstyle || '',
                fontSize: parseInt(el.dataset.fontsize) || '50',
                fontColor: el.dataset.fontcolor || '#212121',
                fontColor2: el.dataset.fontcolor2 || '#FCFCFC',
                lineColor: el.dataset.linecolor || '#008DA7',
                borderColor: el.dataset.bordercolor || '#0a0a0a',
            };

        function getProgress(width, value) {

            var prog = width * (value - settings.min) / (settings.max - settings.min);

            return prog > width ? width : prog;

        }

        this.draw = function () {

            var ctx    = r.getContext('2d'),
                prog   = null,
                color  = null,
                xPrSt  = null,
                xPrEnd = null,
                width  = null,
                hw     = null,
                a      = parseInt(settings.min),
                hh     = r.height / 2;

            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';

            if (settings.showLabels === 'true') {

                xPrSt  = (settings.min.length) * 5;
                xPrEnd = r.width - (settings.max.length) * 5;
                width  = xPrEnd - xPrSt;

                ctx.font = (settings.fontStyle !== '' ? settings.fontStyle + ' ' : '') + (settings.fontSize / 3 * 2) + 'px ' + settings.fontFamily;
                ctx.fillStyle = settings.fontColor;
                ctx.fillText(settings.min, xPrSt, hh);
                ctx.fillText(settings.max, xPrEnd, hh);

                xPrSt = xPrSt * 2 + 5;
                width = width - (settings.max.length) * 5 - 15;

            } else {

                xPrSt  = 0;
                xPrEnd = r.width;
                width  = r.width;

            }

            ctx.lineWidth = settings.lineWidth;
            ctx.strokeStyle = settings.borderColor;
            ctx.strokeRect(xPrSt, 0, width, settings.height);

            var getLen = function (len) {

                ctx.clearRect(xPrSt + 1, 1, width - 2, settings.height - 2);

                prog = getProgress(width, len);

                ctx.lineWidth = settings.lineWidth;
                ctx.fillStyle = settings.lineColor;
                ctx.fillRect(xPrSt + 1, 1, prog - 2, settings.height-2);

                if (width / 2 - prog < settings.fontSize + 10) {

                    hw = prog / 2;
                    color = settings.fontColor2;

                } else {

                    hw = width / 2;
                    color = settings.fontColor;

                }

                hw = hw + 16;

                if (settings.showText === 'true') {

                    ctx.font = (settings.fontStyle !== '' ? settings.fontStyle + ' ' : '') + settings.fontSize + 'px ' + settings.fontFamily;
                    ctx.fillStyle = color;

                    if (settings.inPercent === 'true')
                        ctx.fillText(len + '%', hw, hh);
                    else
                        ctx.fillText(len, hw, hh);

                }

            };

            window.setTimeout(function c() {

                getLen(a);
                a += 1;
                if (a <= parseInt(settings.value)) {

                    window.setTimeout(c, settings.speed);

                }

            }, settings.speed);

        };

        this.show = function () {

            var ctx    = r.getContext('2d'),
                prog   = null,
                color  = null,
                xPrSt  = null,
                xPrEnd = null,
                width  = null,
                hw     = null,
                hh     = r.height / 2;

            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';

            if (settings.showLabels === 'true') {

                xPrSt  = (settings.min.length) * 5;
                xPrEnd = r.width - (settings.max.length) * 5;
                width  = xPrEnd - xPrSt;

                ctx.font = (settings.fontStyle !== '' ? settings.fontStyle + ' ' : '') + (settings.fontSize / 3 * 2) + 'px ' + settings.fontFamily;
                ctx.fillStyle = settings.fontColor;
                ctx.fillText(settings.min, xPrSt, hh);
                ctx.fillText(settings.max, xPrEnd, hh);

                xPrSt = xPrSt * 2 + 5;
                width = width - (settings.max.length) * 5 - 13;

            } else {

                xPrSt  = 0;
                xPrEnd = r.width;
                width  = r.width;

            }

            ctx.lineWidth = settings.lineWidth;
            ctx.strokeStyle = settings.borderColor;
            ctx.strokeRect(xPrSt, 0, width, settings.height);

            prog = getProgress(width, settings.value);

            ctx.lineWidth = settings.lineWidth;
            ctx.fillStyle = settings.lineColor;
            ctx.fillRect(xPrSt + 1, 1, prog - 2, settings.height-2);

            if (width / 2 - prog < settings.fontSize + 10) {

                hw = prog / 2;
                color = settings.fontColor2;

            } else {

                hw = width / 2;
                color = settings.fontColor;

            }

            hw = hw + 16;

            if (settings.showText === 'true') {

                ctx.font = (settings.fontStyle !== '' ? settings.fontStyle + ' ' : '') + settings.fontSize + 'px ' + settings.fontFamily;
                ctx.fillStyle = color;

                if (settings.inPercent === 'true')
                    ctx.fillText(settings.value + '%', hw, hh);
                else
                    ctx.fillText(settings.value, hw, hh);

            }


        };

        this.__constructor = function () {

            el.width  = settings.width;
            el.height = settings.height;

            if (settings.animate === 'true')
                this.draw();
            else
                this.show();

        };

        return this.__constructor();

    };

    return progress;

})({});