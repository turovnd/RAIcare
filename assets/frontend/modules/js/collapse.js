module.exports = (function (collapse) {


    function prepare_() {

        var nodes = document.querySelectorAll('[data-toggle="collapse"]');

        for (var i = 0; i < nodes.length; i++) {

            collapse.create(nodes[i]);

            if(nodes[i].dataset.opened === 'true') {

                collapse.open(nodes[i], document.getElementById(nodes[i].dataset.area));

            }

        }

    }


    /**
     * Toggle collapse - OPEN || CLOSE
     * @private
     */
    collapse.toggle = function (element) {

        var btn;

        if (element.nodeType === 1)
            btn = element;
        else
            btn  = this;

        var list = document.getElementById(btn.dataset.area);

        if (btn.dataset.opened === 'false') {

            collapse.open(btn, list);

        } else {

            collapse.close(btn, list);

        }

    };


    /**
     * Open collapse
     * @param btn  - clicked button
     * @param list - collapse list
     */
    collapse.open = function (btn, list) {

        btn.dataset.opened = 'true';

        if (!list.dataset.height)
            list.dataset.height = calculateHeight_(list);

        list.style.height = list.dataset.height + 'px';

    };


    /**
     * Close collapse
     * @param btn  - clicked button
     * @param list - collapse list
     */
    collapse.close = function (btn, list) {

        btn.dataset.opened = 'false';
        list.style.height = '0';

    };


    /**
     * Create collpase
     * @param el  - clicked button
     */
    collapse.create = function (el) {

        el.addEventListener('click', collapse.toggle);

    };


    /**
     * Destroy collapse
     * @param el  - clicked button
     */
    collapse.destroy = function (el) {

        el.removeEventListener('click', collapse.toggle);

    };


    /**
     * Calculate height of collapse list
     * @param list - collapse ara
     * @returns {number} - height of list
     * @private
     */
    function calculateHeight_(list) {

        var height = 0;

        for (var i = 0; i < list.childNodes.length; i++) {

            if (list.childNodes[i].className) {

                height += list.childNodes[i].clientHeight;

            }

        }
        return height;

    }


    collapse.init = function () {

        prepare_();

    };


    return collapse;


})({});