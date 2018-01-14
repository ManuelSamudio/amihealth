$(function() {

    Morris.Line({
        element: 'morris-area-chart',
        data: [{
            date: '2017-03-20',
            sys: 126,
            dis: 85,
            pulse: 76
        }, {
            date: '2017-03-21',
            sys: 131,
            dis: 88,
            pulse: 69
        }, {
            date: '2017-03-22',
            sys: 133,
            dis: 82,
            pulse: 83
        }, {
            date: '2017-03-23',
            sys: 128,
            dis: 82,
            pulse: 73
        }, {
            date: '2017-03-24',
            sys: 132,
            dis: 73,
            pulse: 86
        }, {
            date: '2017-03-25',
            sys: 128,
            dis: 94,
            pulse: 81
        }, {
            date: '2017-03-26',
            sys: 140,
            dis: 94,
            pulse: 109
        }],
        xkey: 'date',
        ykeys: ['sys', 'dis', 'pulse'],
        labels: ['SYS', 'DIS', 'Pulse'],
        pointSize: 8,
        hideHover: 'auto',
        resize: true,
        ymin: '40',
        smooth: false
    });
    Morris.Line({
        element: 'morris-area-chart-weight',
        data: [{
            date: '2017-03-20',
            weight: 178,
        }, {
            date: '2017-03-21',
            weight: 176,
        }, {
            date: '2017-03-22',
            sys: 133,
            weight: 177
        }, {
            date: '2017-03-23',
            weight: 175,
        }, {
            date: '2017-03-24',
            weight: 177
        }, {
            date: '2017-03-25',
            weight: 178
        }, {
            date: '2017-03-26',
            weight: 180
        }],
        xkey: 'date',
        ykeys: ['weight'],
        labels: ['Weight'],
        pointSize: 8,
        hideHover: 'auto',
        resize: true,
        ymin: '172',
        smooth: false
    });
    Morris.Donut({
        element: 'morris-donut-chart',
        data: [{
            label: "Download Sales",
            value: 12
        }, {
            label: "In-Store Sales",
            value: 30
        }, {
            label: "Mail-Order Sales",
            value: 20
        }],
        resize: true
    });

    Morris.Bar({
        element: 'morris-bar-chart',
        data: [{
            y: '2006',
            a: 100,
            b: 90
        }, {
            y: '2007',
            a: 75,
            b: 65
        }, {
            y: '2008',
            a: 50,
            b: 40
        }, {
            y: '2009',
            a: 75,
            b: 65
        }, {
            y: '2010',
            a: 50,
            b: 40
        }, {
            y: '2011',
            a: 75,
            b: 65
        }, {
            y: '2012',
            a: 100,
            b: 90
        }],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Series A', 'Series B'],
        hideHover: 'auto',
        resize: true
    });

});
