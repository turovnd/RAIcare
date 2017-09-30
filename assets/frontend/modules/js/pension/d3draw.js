module.exports = (function (d3draw) {

    var d3 = require('d3');

    var getColors = function (number) {

        if (number === 9)
            return ['#008da7', '#D0EA2B', '#FEFE33', '#FABC02', '#FE2712', '#8501AF', '#A67200', '#BBBBBB', '#7A3D3D'];

        if (number === 7)
            return ['#98abc5', '#8a89a6', '#7b6888', '#6b486b', '#a05d56', '#d0743c', '#ff8c00'];

        if (number === 5)
            return ['#1f77b4', '#ff7f0e', '#2ca02c', '#d62728', '#9467bd'];

        if (number === 3)
            return ['#008da7', '#FABC02', '#FE2712'];

        if (number === 2)
            return ['#008da7', '#FE2712'];

    };

    /**
     * Draw Circle Diagram
     * @param options - params
     *      id      - block id of diagram
     *      title   - title of diagram
     */
    var drawCircleDiagram = function (options) {

        var block = document.getElementById(options.id),
            svg = d3.select(block),
            width = +svg.attr('width'),
            height = +svg.attr('height'),
            radius = Math.min(width, height) / 2,
            g = svg.append('g')
                .attr('transform', 'translate(' + width / 3 + ',' + height / 2 + ')'),
            dataValue = JSON.parse(block.dataset.value),
            data = dataValue.data;

        block.removeAttribute('data-value');

        var pie = d3.pie()
            .sort(null)
            .value(function (d) {

                return d.number;

            });

        var path = d3.arc()
            .outerRadius(radius - 20)
            .innerRadius(0);

        var label = d3.arc()
            .outerRadius(radius - 40)
            .innerRadius(radius - 40);


        var arc = g.selectAll('.arc')
            .data(pie(data))
            .enter().append('g')
            .attr('class', 'arc');

        arc.append('path')
            .attr('d', path)
            .attr('fill', function (d, i) {

                return getColors(data.length)[i];

            });

        arc.append('text')
            .attr('transform', function (d) {

                return 'translate(' + label.centroid(d) + ')';

            })
            .style('text-anchor', 'middle')
            .style('font-size', 11)
            .text(function (d) {

                return (parseInt(d.data.number) / parseInt(dataValue.total) * 100).toFixed(0) + '%';

            });

        var textBlock = svg.append('g')
            .attr('transform', 'translate(0, 12)');

        textBlock.append('g')
            .attr('class', 'legend-title')
            .attr('transform', 'translate(0, 0)')
            .append('text')
            .attr('x', width)
            .attr('y', 0)
            .attr('font-family', 'sans-serif')
            .attr('font-size', 14)
            .attr('fill', '#008da7')
            .attr('font-weight', 'bold')
            .attr('text-anchor', 'end')
            .text(options.title);


        var legend = textBlock.selectAll('.legend')
            .data(pie(data))
            .enter().append('g')
            .attr('class', 'legend')
            .attr('transform', function (d, i) {

                return 'translate(0, ' + (i * 20 + 10) + ')';

            });

        legend.append('rect')
            .attr('x', width - 10)
            .attr('y', 0)
            .attr('width', 8)
            .attr('height', 8)
            .style('fill', function (d, i) {

                return getColors(data.length)[i];

            });

        legend.append('text')
            .attr('x', width - 14)
            .attr('y', 9)
            .attr('font-family', 'sans-serif')
            .attr('font-size', 12)
            .style('text-anchor', 'end')
            .text(function (d) {

                return d.data.name;

            });

    };


    var drawPatientsAges = function () {

        drawCircleDiagram({
            id: 'patientsAgeBlock',
            title: 'Возраст'
        });

    };

    var drawPatientsSex = function () {

        drawCircleDiagram({
            id: 'patientsSexBlock',
            title: 'Пол'
        });

    };

    var drawADLH = function () {

        drawCircleDiagram({
            id: 'RAIScalesADLH',
            title: 'Самостоятельность'
        });

    };

    var drawDRS = function () {

        drawCircleDiagram({
            id: 'RAIScalesDRS',
            title: 'Уровень депрессии'
        });

    };

    var drawCPS = function () {

        drawCircleDiagram({
            id: 'RAIScalesCPS',
            title: 'Уровень когнетивных способностей'
        });

    };

    var drawCOMM = function () {

        drawCircleDiagram({
            id: 'RAIScalesCOMM',
            title: 'Уровень коммуникативных способностей'
        });

    };

    d3draw.init = function () {

        drawPatientsAges ();
        drawPatientsSex();
        drawADLH();
        drawDRS();
        drawCPS();
        drawCOMM();

    };

    return d3draw;

})({});