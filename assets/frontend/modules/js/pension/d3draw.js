module.exports = (function (d3draw) {

    var d3 = require('d3');

    d3draw.patientsAges = function () {

        var patientsBlock = document.getElementById('patientsAgeBlock'),
            dataValue = JSON.parse(patientsBlock.dataset.value),
            data = dataValue.data;

        patientsBlock.removeAttribute('data-value');

        var svg = d3.select(patientsBlock),
            width = +svg.attr('width'),
            height = +svg.attr('height'),
            radius = Math.min(width, height) / 2;

        var g = svg.append('g')
            .attr('transform', 'translate(' + width / 3 + ',' + height / 2 + ')');

        var color = d3.scaleOrdinal(['#A0A0A0', '#FAD732', '#F45050']);

        var pie = d3.pie()
            .sort(null)
            .value(function (d) {

                return d.number;

            });

        var path = d3.arc()
            .outerRadius(radius - 10)
            .innerRadius(0);


        var arc = g.selectAll('.arc')
            .data(pie(data))
            .enter().append('g')
            .attr('class', 'age');

        arc.append('path')
            .attr('d', path)
            .style('fill', function (d) {

                return color(d.data.age);

            });

        arc.append('text')
            .attr('transform', function (d) {

                return 'translate(' + path.centroid(d) + ')';

            })
            .style('text-anchor', 'middle')
            .text(function (d) {

                if (parseInt(d.data.number) !== 0) {

                    return (parseInt(d.data.number) / dataValue.total * 100).toFixed(0) + '%';

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
            .text('Возраст');


        var legendTable = d3.select(patientsBlock).append('g')
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

                return color(d.data.age);

            });

        legend.append('text')
            .attr('x', width - 14)
            .attr('y', 9)
            .attr('font-family', 'sans-serif')
            .attr('font-size', 14)
            .style('text-anchor', 'end')
            .text(function (d) {

                return d.data.age;

            });

    };

    d3draw.patientsSex = function () {

        var patientsBlock = document.getElementById('patientsSexBlock'),
            dataValue = JSON.parse(patientsBlock.dataset.value),
            data = dataValue.data;

        patientsBlock.removeAttribute('data-value');

        var svg = d3.select(patientsBlock),
            width = +svg.attr('width'),
            height = +svg.attr('height'),
            radius = Math.min(width, height) / 2;

        var g = svg.append('g')
            .attr('transform', 'translate(' + width / 3 + ',' + height / 2 + ')');

        var color = d3.scaleOrdinal(['#008da7', '#FF7373']);

        var pie = d3.pie()
            .sort(null)
            .value(function (d) {

                return d.number;

            });

        var path = d3.arc()
            .outerRadius(radius - 10)
            .innerRadius(0);


        var arc = g.selectAll('.arc')
            .data(pie(data))
            .enter().append('g')
            .attr('class', 'age');

        arc.append('path')
            .attr('d', path)
            .style('fill', function (d) {

                return color(d.data.sex);

            });

        arc.append('text')
            .attr('transform', function (d) {

                return 'translate(' + path.centroid(d) + ')';

            })
            .style('text-anchor', 'middle')
            .text(function (d) {

                if (parseInt(d.data.number) !== 0) {

                    return (parseInt(d.data.number) / dataValue.total * 100).toFixed(0) + '%';

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
            .text('Пол');


        var legendTable = d3.select(patientsBlock).append('g')
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

                return color(d.data.sex);

            });

        legend.append('text')
            .attr('x', width - 14)
            .attr('y', 9)
            .attr('font-family', 'sans-serif')
            .attr('font-size', 14)
            .style('text-anchor', 'end')
            .text(function (d) {

                return d.data.sex;

            });

    };

    return d3draw;

})({});