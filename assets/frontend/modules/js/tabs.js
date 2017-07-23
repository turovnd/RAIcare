module.exports = (function (tabs) {

    var tabsArray = null,
        nodes     = [];

    var prepare_ = function (options) {

        tabsArray = document.querySelectorAll('[data-toggle="tabs"]');

        if (tabsArray !== null) {

            for (var i = 0; i < tabsArray.length; i++) {

                var node = {
                    btn: tabsArray[i],
                    block: document.getElementById(tabsArray[i].dataset.block),
                    search: options.search ? document.getElementById(tabsArray[i].dataset.search) : '',
                    input: options.search ? document.getElementById(tabsArray[i].dataset.search + 'Input') : '',
                    counter: options.counter ? document.getElementById(tabsArray[i].dataset.block + 'Counter') : '',
                    searchElements: options.search ? document.getElementById(tabsArray[i].dataset.block).getElementsByClassName('item__search-text') : ''
                };

                nodes.push(node);

                nodes[i].btn.dataset.id = i;
                nodes[i].btn.addEventListener('click', changeTab, false);

                if (nodes[i].counter && parseInt(nodes[i].counter.innerHTML) === 0) {

                    var noItems = raicare.draw.node('DIV', 'text-center p-20', {id: 'noItems'});

                    noItems.textContent = 'К сожалению, элементы не найдены.';

                    nodes[i].block.appendChild(noItems);

                }

                if (nodes[i].input) {

                    nodes[i].input.dataset.id = i;
                    nodes[i].input.addEventListener('keyup', searchItem, false);

                }

            }

        }


    };

    var changeTab = function () {

        document.getElementsByClassName('tabs__btn--active')[0].classList.remove('tabs__btn--active');
        document.getElementsByClassName('tabs__block--active')[0].classList.remove('tabs__block--active');

        if (document.getElementsByClassName('tabs__search-block--active')[0])
            document.getElementsByClassName('tabs__search-block--active')[0].classList.remove('tabs__search-block--active');

        nodes[this.dataset.id].btn.classList.add('tabs__btn--active');
        nodes[this.dataset.id].block.classList.add('tabs__block--active');

        if (nodes[this.dataset.id].search)
            nodes[this.dataset.id].search.classList.add('tabs__search-block--active');


    };


    var searchItem = function () {

        var node = nodes[this.dataset.id],
            searchingText = new RegExp(node.input.value.toLowerCase()),
            elementBlock, element, elementText;

        for (var i = 0; i < node.searchElements.length; i++) {

            element = node.searchElements[i];
            elementBlock = element.closest('.item');
            elementText = element.innerHTML.toLowerCase();

            if ( ! searchingText.test(elementText) ) {

                if (!elementBlock.classList.contains('hide'))
                    node.counter.innerHTML = parseInt(node.counter.innerHTML) - 1;
                elementBlock.classList.add('hide');

            } else {

                if (elementBlock.classList.contains('hide'))
                    node.counter.innerHTML = parseInt(node.counter.innerHTML) + 1;
                elementBlock.classList.remove('hide');

            }

            if (parseInt(node.counter.innerHTML) === 0) {

                if (!document.getElementById('noResult')) {

                    var noResult = raicare.draw.node('DIV', 'text-center p-20', {id: 'noResult'});

                    noResult.textContent = 'К сожалению, ничего не найдено. Попробуйте изменить запрос.';

                    elementBlock.parentNode.append(noResult);

                }

            } else if ( document.getElementById('noResult') ) {

                document.getElementById('noResult').remove();

            }


        }

    };

    tabs.init = function (options) {

        prepare_(options);

    };

    return tabs;

})({});