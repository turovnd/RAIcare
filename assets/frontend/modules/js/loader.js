module.exports = (function (loader) {

    var corePrefix = 'Loader';

    loader.init = function () {

        var loaders = document.getElementsByClassName('js-loader');

        for (var i = 0; i < loaders.length; i++) {

            new Loader(loaders[i]);

        }

    };

    loader.create = function (el) {

        if (el.nodeType !== 1) {

            raisoft.core.log('Is not HTML element', 'error', corePrefix);
            return;

        }

        new Loader(el);

    };

    var Loader = function (el) {

        var r = el,
            settings = {
                width: el.width || 200,
                height: el.height || 200,
                animate: el.dataset.animate || true,
                displayOnLoad: el.dataset.displayonload || true,
                percentage: el.dataset.percentage || 100,
                speed: el.dataset.speed || 1,
                roundedLine: el.dataset.roundedline || false,
                showRemaining: el.dataset.showremaining || true,
                fontFamily: el.dataset.fontfamily || 'sans-serif',
                fontStyle: el.dataset.fontstyle || '',
                fontSize: el.dataset.fontsize || '50px',
                showText: el.dataset.showtext || true,
                diameter: el.dataset.diameter || 80,
                fontColor: el.dataset.fontcolor || '#212121',
                lineColor: el.dataset.linecolor || '#008DA7',
                remainingLineColor: el.dataset.remaininglinecolor || '#BBB',
                lineWidth: el.dataset.linewidth || 5,
                start: el.dataset.start || 'left'
            };

        function radius(e) {

            return Math.PI / 180 * e;

        }

        this.draw = function (percent) {

            if (typeof percent !== 'undefined') {

                settings.percentage = percent;

            }
            var ctx = r.getContext('2d');
            var hw = r.width / 2;
            var hh = r.height / 2;
            var q = 100;
            var a = 0;
            var startPos = 0;
            var f = function (e) {

                var t = radius(360) / q;

                return t * e;

            };

            ctx.scale(1, 1);
            ctx.lineWidth = settings.lineWidth;
            ctx.strokeStyle = settings.lineColour;

            var l = function (s, u) {

                s = s || f(a);
                u = u || f(a + 1);
                ctx.clearRect(0, 0, r.width, r.height);
                if (settings.showRemaining === true) {

                    ctx.beginPath();
                    ctx.strokeStyle = settings.remainingLineColor;
                    ctx.arc(hw, hh, settings.diameter, 0, 360);
                    ctx.stroke();
                    ctx.closePath();

                }
                ctx.strokeStyle = settings.lineColor;
                ctx.beginPath();
                if (settings.roundedLine === true) {

                    ctx.lineCap = 'round';

                }                else {

                    ctx.lineCap = 'butt';

                }
                switch (settings.start) {
                    case 'top':
                        startPos = 1.5 * Math.PI;
                        break;
                    case 'bottom':
                        startPos = 0.5 * Math.PI;
                        break;
                    case 'right':
                        startPos = 1 * Math.PI;
                        break;
                    case 'left':
                    default:
                        startPos = 0;
                        break;
                }
                ctx.arc(hw, hh, settings.diameter, startPos, u + startPos);
                ctx.stroke();
                ctx.closePath();
                if (settings.showText === true) {

                    ctx.fillStyle = settings.fontColor;
                    ctx.font = (settings.fontStyle !== '' ? settings.fontStyle + ' ' : '') + settings.fontSize + ' ' + settings.fontFamily;
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';
                    ctx.fillText(a + 1 + '%', hw, hh);

                }

            };

            window.setTimeout(function c() {

                l(f(a), f(a + 1));
                a += 1;
                if (a < settings.percentage) {

                    window.setTimeout(c, settings.speed);

                }

            }, settings.speed);

        };
        this.setPercent = function (percentage) {

            settings.percentage = percentage;
            return this;

        };
        this.getPercent = function () {

            return settings.percentage;

        };
        this.show = function () {

            var ctx = r.getContext('2d');
            var hw = r.width / 2;
            var hh = r.height / 2;

            ctx.scale(1, 1);
            ctx.lineWidth = settings.lineWidth;
            ctx.strokeStyle = settings.lineColour;
            ctx.clearRect(0, 0, r.width, r.height);
            ctx.strokeStyle = settings.lineColor;
            ctx.beginPath();
            ctx.arc(hw, hh, settings.diameter, 0, radius(settings.percentage / 100 * 360));
            ctx.stroke();
            ctx.closePath();
            if (settings.showText === true) {

                ctx.fillStyle = settings.fontColor;
                ctx.font = (settings.fontStyle !== '' ? settings.fontStyle + ' ' : '') + settings.fontSize + ' ' + settings.fontFamily;
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                ctx.fillText(settings.percentage + '%', hw, hh);

            }
            if (settings.showRemaining === true) {

                ctx.beginPath();
                ctx.strokeStyle = settings.remainingLineColor;
                ctx.arc(hw, hh, settings.diameter, 0, 360);
                ctx.stroke();
                ctx.closePath();

            }

        };
        this.__constructor = function () {

            el.width  = settings.width;
            el.height = settings.height;

            if (settings.displayOnLoad === true) {

                if (settings.animate === true)
                    this.draw();
                else
                    this.show();

            }
            return this;

        };
        return this.__constructor();

    };

    return loader;

})({});
