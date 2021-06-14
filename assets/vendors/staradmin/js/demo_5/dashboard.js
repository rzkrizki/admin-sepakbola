(function ($) {
    'use strict';
    $(function () {
        $.fn.andSelf = function () {
            return this.addBack.apply(this, arguments);
        }
        if ($('#salesOverview').length) {
            var areaData = {
                labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
                datasets: [{
                        label: 'Enterprise',
                        data: [280, 234, 385, 120, 230, 170, 309],
                        borderColor: '#fa424a',
                        backgroundColor: '#fa424a',
                        borderWidth: 2,
                        fill: false
                    }, {
                        label: 'Small Business',
                        data: [230, 233, 353, 312, 346, 317, 347],
                        borderColor: '#027bff',
                        backgroundColor: '#027bff',
                        borderWidth: 2,
                        fill: false
                    },
                    {
                        label: 'Medium Business',
                        data: [139, 235, 326, 300, 196, 347, 269],
                        borderColor: '#664eeb',
                        backgroundColor: '#664eeb',
                        borderWidth: 2,
                        fill: false
                    }
                ]
            };
            var areaOptions = {
                responsive: true,
                animation: {
                    animateScale: true,
                    animateRotate: true
                },
                elements: {
                    point: {
                        radius: 2
                    },
                    line: {
                        tension: 0
                    }
                },
                layout: {
                    padding: {
                        left: 0,
                        right: 0,
                        top: 0,
                        bottom: 0
                    }
                },
                legend: false,
                legend: {
                    display: false,
                    legendCallback: function (chart) {
                        var text = [];
                        text.push('<ul class="legend-list">');
                        for (var i = 0; i < trafficChartData.datasets[0].data.length; i++) {
                            text.push('<li><span class="legend-dots" style="background:' +
                                trafficChartData.datasets[0].legendColor[i] +
                                '"></span>');
                            if (trafficChartData.labels[i]) {
                                text.push(trafficChartData.labels[i]);
                            }
                            text.push('<span class="float-right">' + trafficChartData.datasets[0].data[i] + "%" + '</span>')
                            text.push('</li>');
                        }
                        text.push('</ul>');
                        return text.join('');
                    }
                },
                stepsize: 200,
                min: 0,
                max: 400,
                scales: {
                    xAxes: [{
                        gridLines: {
                            color: '#f2f2f2',
                            display: true
                        },
                        ticks: {
                            fontColor: '#b0bac9'
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            color: '#f2f2f2',
                            display: true
                        },
                        ticks: {
                            fontColor: '#b0bac9'
                        }
                    }]
                }
            }
            var ctx = document.getElementById('salesOverview').getContext('2d');
            var revenueChart = new Chart(ctx, {
                type: 'line',
                data: areaData,
                options: areaOptions
            });

            $("#salesOverview-legend").html(revenueChart.generateLegend());
        }
        if ($('#source-graph-1').length) {
            var gradientStrokeBlue = ctx.createLinearGradient(0, 40, 0, 150);
            gradientStrokeBlue.addColorStop(0, 'rgba(127, 101, 238,0.6');
            gradientStrokeBlue.addColorStop(1, 'rgba(255, 255, 255,0.05');
            var ctx = document.getElementById('source-graph-1').getContext("2d");
            var data = {
                labels: [
                    "Day 1",
                    "Day 2",
                    "Day 3",
                    "Day 4",
                    "Day 5",
                    "Day 6",
                    "Day 7",
                    "Day 8",
                    "Day 9",
                    "Day 10",
                    "Day 11",
                    "Day 12",
                    "Day 13",
                    "Day 14",
                    "Day 15",
                    "Day 16",
                    "Day 17",
                    "Day 18",
                    "Day 19",
                    "Day 20",
                    "Day 21",
                    "Day 22",
                    "Day 23",
                    "Day 24",
                    "Day 25",
                    "Day 26",
                    "Day 27",
                    "Day 28",
                    "Day 29",
                    "Day 30",
                    "Day 31",
                    "Day 32",
                    "Day 33",
                    "Day 34",
                    "Day 35",
                    "Day 36",
                    "Day 37",
                    "Day 38",
                    "Day 39",
                    "Day 40",
                    "Day 41",
                    "Day 42",
                    "Day 43",
                    "Day 44",
                    "Day 45",
                    "Day 46",
                    "Day 47",
                    "Day 48",
                    "Day 49",
                    "Day 50",
                    "Day 51",
                    "Day 52",
                    "Day 53",
                    "Day 54",
                    "Day 55",
                    "Day 56",
                    "Day 57",
                    "Day 58",
                    "Day 59",
                    "Day 60",
                    "Day 61",
                    "Day 62",
                    "Day 63",
                    "Day 64",
                    "Day 65",
                    "Day 66",
                    "Day 67",
                    "Day 68",
                    "Day 69",
                    "Day 70"
                ],
                datasets: [{
                    label: 'Total Revenue',
                    data: [60, 61, 54, 62, 63, 54, 55, 64, 34, 46, 34, 35, 24, 64, 34, 23, 13, 54, 27, 43, 34, 43, 64, 50, 43, 55, 39, 43, 45, 60, 54, 41, 45, 26, 45, 21, 45, 64, 35, 65, 34, 34, 43, 46, 24, 23, 64, 23, 65, 54, 35, 48, 34, 48, 34, 23, 38, 34, 45, 54, 47, 42, 50, 45, 53, 57, 59, 64, 40, 63],
                    borderColor: '#9B86F1',
                    backgroundColor: gradientStrokeBlue,
                    hoverBackgroundColor: gradientStrokeBlue,
                    borderWidth: 2,
                    fill: 'origin'
                }]
            };
            var lineChart = new Chart(ctx, {
                type: 'line',
                data: data,
                options: {
                    scales: {
                        yAxes: [{
                            display: false
                        }],
                        xAxes: [{
                            display: false
                        }]
                    },
                    legend: {
                        display: false
                    },
                    elements: {
                        point: {
                            radius: 0
                        },
                        line: {
                            tension: 0
                        }
                    },
                    stepsize: 100
                }
            });
        }
        if ($('#revenue-graph').length) {
            var barChartCanvas = $("#revenue-graph").get(0).getContext("2d");
            var data = {
                labels: ["2016", "2017", "2018", "2019"],
                datasets: [{
                        label: "Sales",
                        backgroundColor: '#027bff',
                        borderColor: '#027bff',
                        borderWidth: 1,
                        data: [3, 5, 6, 7]
                    },
                    {
                        label: "Profit",
                        backgroundColor: '#C6E2FC',
                        borderColor: '#C6E2FC',
                        borderWidth: 1,
                        data: [4, 7, 3, 6]
                    }
                ]
            };
            var options = {
                responsive: true,
                legend: {
                    position: "top"
                },
                title: {
                    display: true,
                    text: "Chart.js Bar Chart"
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            };

            var barChart = new Chart(barChartCanvas, {
                type: 'bar',
                data: data,
                options: {
                    scales: {
                        yAxes: [{
                            display: false
                        }],
                        xAxes: [{
                            display: false,
                            categoryPercentage: 0.75,
                            barPercentage: 0.8
                        }]
                    },
                    legend: {
                        display: false
                    },
                    elements: {
                        point: {
                            radius: 0
                        },
                        line: {
                            tension: 0
                        }
                    },
                    stepsize: 100
                }
            });
        }
        if ($('#calendar').length) {
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay'
                },
                locale: 'en',
                dayNames: ['Sunday', 'Monday', 'Tuesday', 'Wednesday',
                    'Thursday', 'Friday', 'Saturday'
                ],
                dayNamesShort: ['SUN', 'MON', 'TUE', 'WED', 'THUS', 'FRI', 'SAT'],
                monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July',
                    'August', 'September', 'October', 'November', 'December'
                ],
                monthNamesShort: ['January', 'February', 'March', 'April', 'May', 'June', 'July',
                    'August', 'September', 'October', 'November', 'December'
                ],
                defaultDate: '2019-04-12',
                navLinks: true, // can click day/week names to navigate views
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                events: [{
                        title: 'Birthday Party',
                        start: '2019-04-03T11:00:00',
                        color: primaryColor
                    },
                    {
                        title: 'Conference',
                        start: '2019-04-07T12:00:00',
                        color: warningColor
                    },
                    {
                        title: 'Lunch party',
                        start: '2019-04-11T01:00:00',
                        color: successColor
                    },
                    {
                        title: 'Family time',
                        start: '2019-04-20T03:00:00',
                        color: primaryColor
                    },
                    {
                        title: 'Meetup',
                        start: '2019-04-23T09:00:00',
                        color: dangerColor
                    },
                    {
                        title: 'Family time',
                        start: '2019-05-01T03:00:00',
                        color: warningColor
                    },
                    {
                        title: 'Meeting with Alex',
                        start: '2019-05-06T08:00:00',
                        color: primaryColor
                    }
                ],
                eventRender: function (event, eventElement) {
                    if (event.color == dangerColor) {
                        eventElement.addClass("event-invers-danger");
                    }
                    if (event.color == warningColor) {
                        eventElement.addClass("event-invers-warning");
                    }
                    if (event.color == infoColor) {
                        eventElement.addClass("event-invers-info");
                    }
                    if (event.color == successColor) {
                        eventElement.addClass("event-invers-success");
                    }
                    if (event.color == primaryColor) {
                        eventElement.addClass("event-invers-primary");
                    }
                },

            })
        }
        if ($('#salesOverview-slides').length) {
            $('#salesOverview-slides').owlCarousel({
                center: true,
                items: 1,
                loop: true,
                margin: 30,
                autoplay: true,
                autoplayTimeout: 2000,
                slideTransition: 'ease-in'
            });
        }
    });
})(jQuery)