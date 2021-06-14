(function ($) {
    'use strict';
    $(function () {
        if ($('#analytics-metrics').length) {
            var areaData = {
                labels: ["1", "2", "3", "4", "5", "6"],
                datasets: [{
                    label: 'Sessions',
                    data: [8, 7, 3, 16, 10, 28],
                    borderColor: '#5B3ED2',
                    backgroundColor: '#7644DB',
                    borderWidth: 3
                }, {
                    label: 'Users',
                    data: [28, 10, 15, 45, 30, 68],
                    borderColor: '#227EF6',
                    backgroundColor: '#6AA7E9',
                    borderWidth: 3
                }]
            };
            var areaOptions = {
                responsive: true,
                animation: {
                    animateScale: true,
                    animateRotate: true
                },
                elements: {
                    point: {
                        radius: 3
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
                stepsize: 150,
                min: 0,
                max: 350,
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false,
                            color: '#fff',
                        },
                        ticks: {
                            beginAtZero: true,
                            min: 0,
                            max: 70,
                            stepSize: 20
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            color: '#eff2ff',
                            display: true
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
            var ctx = document.getElementById('analytics-metrics').getContext('2d');
            var revenueChart = new Chart(ctx, {
                type: 'line',
                data: areaData,
                options: areaOptions
            });
        }
        if ($('#users-by-region').length) {
            var options = {
                type: 'bubble',
                data: {
                    datasets: [{
                            label: 'John',
                            data: [{
                                x: 3,
                                y: 10,
                                r: 5
                            }],
                            backgroundColor: "#027bff",
                            hoverBackgroundColor: "#027bff"
                        },
                        {
                            label: 'Paul',
                            data: [{
                                x: 2,
                                y: 2,
                                r: 10
                            }],
                            backgroundColor: "#027bff",
                            hoverBackgroundColor: "#027bff"
                        }, {
                            label: 'Paul',
                            data: [{
                                x: 12,
                                y: 32,
                                r: 13
                            }],
                            backgroundColor: "#027bff",
                            hoverBackgroundColor: "#027bff"
                        },
                        {
                            label: 'Paul',
                            data: [{
                                x: 29,
                                y: 52,
                                r: 5
                            }],
                            backgroundColor: "#027bff",
                            hoverBackgroundColor: "#027bff"
                        },
                        {
                            label: 'Paul',
                            data: [{
                                x: 49,
                                y: 62,
                                r: 5
                            }],
                            backgroundColor: "#027bff",
                            hoverBackgroundColor: "#027bff"
                        },
                        {
                            label: 'Paul',
                            data: [{
                                x: 22,
                                y: 22,
                                r: 5
                            }],
                            backgroundColor: "#027bff",
                            hoverBackgroundColor: "#027bff"
                        },
                        {
                            label: 'Paul',
                            data: [{
                                x: 23,
                                y: 25,
                                r: 5
                            }],
                            backgroundColor: "#027bff",
                            hoverBackgroundColor: "#027bff"
                        },
                        {
                            label: 'Paul',
                            data: [{
                                x: 12,
                                y: 10,
                                r: 5
                            }],
                            backgroundColor: "#027bff",
                            hoverBackgroundColor: "#027bff"
                        },
                        {
                            label: 'Paul',
                            data: [{
                                x: 34,
                                y: 23,
                                r: 5
                            }],
                            backgroundColor: "#027bff",
                            hoverBackgroundColor: "#027bff"
                        },
                        {
                            label: 'Paul',
                            data: [{
                                x: 30,
                                y: 20,
                                r: 10
                            }],
                            backgroundColor: "#664eeb",
                            hoverBackgroundColor: "#664eeb"
                        },
                        {
                            label: 'Paul',
                            data: [{
                                x: 12,
                                y: 17,
                                r: 5
                            }],
                            backgroundColor: "#664eeb",
                            hoverBackgroundColor: "#664eeb"
                        },
                        {
                            label: 'Paul',
                            data: [{
                                x: 32,
                                y: 37,
                                r: 5
                            }],
                            backgroundColor: "#664eeb",
                            hoverBackgroundColor: "#664eeb"
                        },
                        {
                            label: 'Paul',
                            data: [{
                                x: 52,
                                y: 57,
                                r: 5
                            }],
                            backgroundColor: "#664eeb",
                            hoverBackgroundColor: "#664eeb"
                        },
                        {
                            label: 'Paul',
                            data: [{
                                x: 77,
                                y: 40,
                                r: 5
                            }],
                            backgroundColor: "#664eeb",
                            hoverBackgroundColor: "#664eeb"
                        }, {
                            label: 'Paul',
                            data: [{
                                x: 67,
                                y: 40,
                                r: 5
                            }],
                            backgroundColor: "#664eeb",
                            hoverBackgroundColor: "#664eeb"
                        }, {
                            label: 'Paul',
                            data: [{
                                x: 47,
                                y: 20,
                                r: 10
                            }],
                            backgroundColor: "#664eeb",
                            hoverBackgroundColor: "#664eeb"
                        }, {
                            label: 'Paul',
                            data: [{
                                x: 77,
                                y: 10,
                                r: 5
                            }],
                            backgroundColor: "#664eeb",
                            hoverBackgroundColor: "#664eeb"
                        }, {
                            label: 'Paul',
                            data: [{
                                x: 57,
                                y: 10,
                                r: 10
                            }],
                            backgroundColor: "#664eeb",
                            hoverBackgroundColor: "#664eeb"
                        }, {
                            label: 'Paul',
                            data: [{
                                x: 57,
                                y: 40,
                                r: 5
                            }],
                            backgroundColor: "#664eeb",
                            hoverBackgroundColor: "#664eeb"
                        }
                    ]
                },
                options: {
                    legend: false,
                    scales: {
                        xAxes: [{
                            gridLines: {
                                display: false,
                                color: '#fff',
                            }
                        }],
                        yAxes: [{
                            gridLines: {
                                color: '#eff2ff',
                                display: true
                            },
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            }

            var ctx = document.getElementById('users-by-region').getContext('2d');
            new Chart(ctx, options);
        }
        if ($("#CMDoughnutChart").length) {
            var doughnutChartCanvas = $("#CMDoughnutChart").get(0).getContext("2d");
            var doughnutPieData = {
                datasets: [{
                    data: [70, 20],
                    backgroundColor: ['#664eeb', '#027bff'],
                    borderColor: ['#664eeb', '#027bff'],
                }],
                labels: [
                    'Chrome',
                    'Firefox',
                    'Safari',
                    'Opera',
                    'IE',
                ]
            };
            var doughnutPieOptions = {
                cutoutPercentage: 70,
                animationEasing: "easeOutBounce",
                animateRotate: true,
                animateScale: false,
                responsive: true,
                maintainAspectRatio: true,
                showScale: true,
                legend: {
                    display: false
                },
                layout: {
                    padding: {
                        left: 0,
                        right: 0,
                        top: 0,
                        bottom: 0
                    }
                }
            };
            var doughnutChart = new Chart(doughnutChartCanvas, {
                type: 'doughnut',
                data: doughnutPieData,
                options: doughnutPieOptions
            });
        }
        if ($('#CMAreaChart').length) {
            var chart = document.getElementById('CMAreaChart').getContext('2d'),
                gradient_1 = chart.createLinearGradient(0, 0, 0, 150);
            gradient_1.addColorStop(0, 'rgb(122, 92, 225,1)');
            gradient_1.addColorStop(0.5, 'rgb(122, 92, 225,0.25)');
            gradient_1.addColorStop(1, 'rgba(255, 255, 255, 0.5)');
            var areaData = {
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
                    "Day 10"
                ],
                datasets: [{
                    label: 'Sessions',
                    data: [60, 61, 54, 62, 63, 54, 55, 24, 34, 46],
                    borderColor: '#5B3ED2',
                    backgroundColor: gradient_1,
                    borderWidth: 3
                }, {
                    label: 'Users',
                    data: [60, 41, 45, 26, 45, 21, 45, 64, 25, 65],
                    borderColor: '#027bff',
                    backgroundColor: '#fff',
                    borderWidth: 3
                }]
            };
            var areaOptions = {
                responsive: true,
                animation: {
                    animateScale: true,
                    animateRotate: true
                },
                elements: {
                    point: {
                        radius: 0
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
                stepsize: 150,
                min: 0,
                max: 350,
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false,
                            color: '#fff',
                        },
                        scaleLabel: {
                            display: true,
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            color: '#eff2ff',
                            display: true
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
            var chartInstance = new Chart(chart, {
                type: 'line',
                data: areaData,
                options: areaOptions
            });
        }
    });
})(jQuery)