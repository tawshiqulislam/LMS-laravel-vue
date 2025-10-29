(function ($) {
    "use strict";

    // data color
    $("[data-color]").each(function () {
        $(this).css("color", $(this).attr("data-color"))
    })

    // data bg img
    $("[data-bg-img]").each(function () {
        $(this).css("background-image", "url(" + $(this).attr("data-bg-img") + ")")
    })

    // data border color
    $("[data-border-color]").each(function () {
        $(this).css("border-color", $(this).attr("data-border-color"))
    })

    // data bg color
    $("[data-bg-color]").each(function () {
        $(this).css("background-color", $(this).attr("data-bg-color"))
    })

    $(".tp-header-menu-icon").on('click', function () {
        $(".tp-sidebar-overlay").addClass("tp-sidebar-overlay-open");
    });
    $(".tp-sidebar-overlay").on('click', function () {
        $(".tp-sidebar-overlay").removeClass("tp-sidebar-overlay-open");
        $(".tp-sidebar-area").removeClass("tp-sidebar-area-open"); // sidebar hide
    });



    $(".tp-header-lang").on("click", function () {
        $(".tp-header-lang").toggleClass("tp-header-lang-open");
    });
    $(".tp-header-author").on("click", function () {
        $(".tp-header-author").toggleClass("tp-header-author-open");
    });
    $(".tp-header-menu-icon").on("click", function () {
        $(".tp-sidebar-area").toggleClass("tp-sidebar-area-open");
    });
    $(".tp-deashboard-close-icon").on("click", function () {
        $(".tp-sidebar-area").toggleClass("tp-sidebar-area-open");
        $(".tp-sidebar-overlay").removeClass("tp-sidebar-overlay-open");
    });

    $("#sidebar__active").on("click", function () {
        if (window.innerWidth > 0 && window.innerWidth <= 991) {
            $(".tp-sidebar-area").toggleClass("open");
        } else {
            $(".tp-sidebar-area").toggleClass("collapsed");
        }
    });
    $(".app__sidebar-overlay").on("click", function () {
        $(".tp-sidebar-area").removeClass("collapsed");
        $(".tp-sidebar-area").removeClass("open");
    });

    var windowOn = $(window);
    windowOn.on('scroll', function () {
        var scroll = windowOn.scrollTop();
        if (scroll < 10) {
            $("#tp-header-sticky").removeClass("header-sticky");
        } else {
            $("#tp-header-sticky").addClass("header-sticky");
        }
    });


    $(document).ready(function () {
        $(".tp-dropdown-toggle").on("click", function (e) {
            e.preventDefault();
            var parentLi = $(this).parent();
            parentLi.toggleClass("open");
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
        const toggle = document.getElementById("darkModeToggle");
        const title = toggle?.querySelector(".tp-header-icon-title");

        toggle?.addEventListener("click", function (e) {
            e.preventDefault();
            document.body.classList.toggle("dark-theme");
            toggle.classList.toggle("dark-mode"); // add class for animation

            if (document.body.classList.contains("dark-theme")) {
                title.innerText = "Dark";
            } else {
                title.innerText = "Light";
            }
        });
    });


    new PureCounter();
    new PureCounter({
        filesizing: true,
        selector: ".filesizecount",
        pulse: 2,
    });

    var series = {
        monthDataSeries1: {
            prices: [
                8107.85, 8128.0, 8122.9, 8165.5, 8340.7,
                8423.7, 8423.5, 8514.3, 8481.85, 8487.7,
                8506.9, 8626.2, 8668.95, 8602.3, 8607.55,
                8512.9, 8496.25, 8600.65, 8881.1, 9340.85
            ],
            dates: [
                "2018-01-01", "2018-01-02", "2018-01-03", "2018-01-04",
                "2018-01-05", "2018-01-06", "2018-01-07", "2018-01-08",
                "2018-01-09", "2018-01-10", "2018-01-11", "2018-01-12",
                "2018-01-13", "2018-01-14", "2018-01-15", "2018-01-16",
                "2018-01-17", "2018-01-18", "2018-01-19", "2018-01-20"
            ]
        }
    };

    var options = {
        series: [{
            name: "STOCK ABC",
            data: series.monthDataSeries1.prices
        }],
        chart: {
            type: 'area',
            height: 184,
            zoom: {
                enabled: false
            },
            toolbar: {
                show: false
            },
        },

        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'straight',
            colors: ['#1469B5'],
            width: 2
        },
        labels: series.monthDataSeries1.dates,
        xaxis: {
            type: 'datetime',
        },
        yaxis: {
            opposite: false
        },
        yaxis: {
            opposite: false,
            labels: {
                show: false
            }
        },
        grid: {
            show: true,
            borderColor: '#E6EAEC',
            strokeSolid: 3,
            xaxis: {
                lines: {
                    show: true
                }
            }
        },
        legend: {
            horizontalAlign: 'center'
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();


    var options = {
        series: [
            {
                name: 'Segment 1 (Bottom)',
                data: [780, 780, 780, 780, 780, 780]
            },
            {
                name: 'Segment 2',
                data: [780, null, 780, 780, 780, 780]
            },
            {
                name: 'Segment 3',
                data: [780, 780, 780, null, null, null]
            },
            {
                name: 'Segment 4 (Top)',
                data: [630, 780, 780, 780, 500, 250]
            },
        ],
        chart: {
            type: 'bar',
            height: 500,
            stacked: true,
            toolbar: {
                show: false
            }
        },
        colors: ['#F1F7FE', '#E3EEFB', '#C0DDF7', '#89C1F0', '#1469B5'],

        plotOptions: {
            bar: {
                columnWidth: '57px',   // default
                borderRadius: 8,
                borderRadiusApplication: 'end',
                borderRadiusWhenStacked: 'last',
            }
        },

        responsive: [
            {
                breakpoint: 768,
                options: {
                    plotOptions: {
                        bar: {
                            columnWidth: '50px'
                        }
                    }
                }
            },
            {
                breakpoint: 480,
                options: {
                    plotOptions: {
                        bar: {
                            columnWidth: '30px',
                            borderRadius: 5
                        }
                    }
                }
            }
        ],

        xaxis: {
            categories: ['2019', '2020', '2021', '2022', '2023', '2024'],
            axisTicks: { show: false },
            labels: { style: { fontSize: '14px' } }
        },

        yaxis: {
            min: 0,
            max: 5000,
            tickAmount: 3,
            yaxis: {
                min: 0,
                max: 5000,
                tickAmount: 4,
                labels: {
                    formatter: function (val) {
                        return val.toString();
                    },
                    style: {
                        color: '#000',
                        fontSize: '20px',
                    }
                }
            }

        },

        dataLabels: {
            enabled: true,
            formatter: function () { return ''; },
            offsetY: -5,
            style: { fontSize: '12px', colors: ['#000'] }
        },

        grid: {
            show: true,
            borderColor: '#f0f0f0',
            strokeDashArray: 5,
            position: 'back',
            xaxis: { lines: { show: false } },
            yaxis: { lines: { show: true } }
        },

        legend: { show: false },
        tooltip: {
            enabled: true,
            y: { formatter: val => val.toFixed(0) }
        },

        title: {
            text: '10',
            align: 'left',
            offsetY: 0,
            style: {
                fontSize: '32px',
                fontWeight: '700',
                color: '#000',
            }
        },
        subtitle: {
            text: 'Total Orders',
            align: 'left',
            offsetY: 45,
            style: {
                fontSize: '16px',
                color: '#000',
                fontWeight: '400',
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#total-orders-chart"), options);
    chart.render();

    // Back to top
    var amountScrolled = 200;
    var amountScrolledNav = 25;

    $(window).scroll(function () {
        if ($(window).scrollTop() > amountScrolled) {
            $('button.back-to-top').addClass('show');
        } else {
            $('button.back-to-top').removeClass('show');
        }
    });

    $('button.back-to-top').click(function () {
        $('html, body').animate({
            scrollTop: 0
        }, 300);
        return false;
    });

    $(window).on("load", function () {
        $("#loading").fadeOut(500, function () {
            $(this).remove();
        });
    });


})(jQuery);
