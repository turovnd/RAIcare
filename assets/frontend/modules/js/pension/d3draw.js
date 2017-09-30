module.exports = (function (d3draw) {

    var d3 = require('d3');

    var getColors = function (number) {

        if (number === 7)
            return ['#008da7', '#D0EA2B', '#FEFE33', '#FABC02', '#FE2712', '#8501AF', '#A67200'];

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

        var block     = document.getElementById(options.id),
            dataValue = JSON.parse(block.dataset.value),
            data      = dataValue.data;

        block.removeAttribute('data-value');

        var svg = d3.select(block),
            width = +svg.attr('width'),
            height = +svg.attr('height'),
            radius = Math.min(width, height) / 2;

        var g = svg.append('g')
            .attr('transform', 'translate(' + width / 3 + ',' + height / 2 + ')');

        var color = d3.scaleOrdinal(getColors(data.length));

        var pie = d3.pie()
            .sort(null)
            .value(function (d) {

                return d.number;

            });

        var path = d3.arc()
            .outerRadius(radius - 20)
            .innerRadius(0);


        var arc = g.selectAll('.arc')
            .data(pie(data))
            .enter().append('g')
            .attr('class', 'diagram');

        arc.append('path')
            .attr('d', path)
            .style('fill', function (d) {

                return color(d.data.name);

            });

        var labelArc = d3.arc()
            .outerRadius(radius - 40)
            .innerRadius(radius - 40);

        arc.append('text')
            .attr('transform', function (d) {

                return 'translate(' + labelArc.centroid(d) +  ')';

            })
            .style('text-anchor', 'middle')
            .style('font-size', 12)
            .text(function (d) {

                if (parseInt(d.data.number) !== 0) {

                    return (parseInt(d.data.number) / parseInt(dataValue.total) * 100).toFixed(0) + '%';

                }

            });

        svg.append('g')
            .attr('class', 'axis')
            .append('text')
            .attr('x', width - 2)
            .attr('y', 14)
            .attr('font-family', 'sans-serif')
            .attr('font-size', 14)
            .attr('fill', '#008da7')
            .attr('font-weight', 'bold')
            .attr('text-anchor', 'end')
            .text(options.title);


        var legendTable = d3.select(block).append('g')
            .attr('transform', 'translate(0, 25)');

        var legend = legendTable.selectAll('.legend')
            .data(pie(data))
            .enter().append('g')
            .attr('class', 'legend')
            .attr('transform', function (d, i) {

                return 'translate(0, ' + i * 20 + ')';

            });

        legend.append('rect')
            .attr('x', width - 10)
            .attr('y', 0)
            .attr('width', 10)
            .attr('height', 10)
            .style('fill', function (d) {

                return color(d.data.name);

            });

        legend.append('text')
            .attr('x', width - 14)
            .attr('y', 9)
            .attr('font-family', 'sans-serif')
            .attr('font-size', 14)
            .style('text-anchor', 'end')
            .text(function (d) {

                return d.data.name;

            });

    };


    d3draw.patientsAges = function () {

        drawCircleDiagram({
            id: 'patientsAgeBlock',
            title: 'Возраст'
        });

    };

    d3draw.patientsSex = function () {

        drawCircleDiagram({
            id: 'patientsSexBlock',
            title: 'Пол'
        });

    };

    d3draw.ADLH = function () {

        drawCircleDiagram({
            id: 'RAIScalesADLH',
            title: 'Макс. зависимость'
        });

    };

    d3draw.DRS = function () {

        drawCircleDiagram({
            id: 'RAIScalesDRS',
            title: 'Уровень депрессии'
        });

    };

    return d3draw;

})({});