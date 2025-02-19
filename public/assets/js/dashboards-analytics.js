
"use strict";
!(function () {
    let o, e, r, t, a, s;
    s = isDarkStyle
        ? ((o = config.colors_dark.cardColor),
          (e = config.colors_dark.headingColor),
          (r = config.colors_dark.textMuted),
          (t = config.colors_dark.bodyColor),
          (a = config.colors_dark.borderColor),
          "dark")
        : ((o = config.colors.cardColor),
          (e = config.colors.headingColor),
          (r = config.colors.textMuted),
          (t = config.colors.bodyColor),
          (a = config.colors.borderColor),
          "light");
    var i = document.querySelectorAll(".chart-report"),
        i =
            (i &&
                i.forEach(function (o) {
                    var e = config.colors[o.dataset.color],
                        r = o.dataset.series,
                        e =
                            ((e = e),
                            (r = r),
                            {
                                chart: {
                                    height: 50,
                                    width: 50,
                                    type: "radialBar",
                                },
                                plotOptions: {
                                    radialBar: {
                                        hollow: { size: "25%" },
                                        dataLabels: { show: !1 },
                                        track: { background: a },
                                    },
                                },
                                stroke: { lineCap: "round" },
                                colors: [e],
                                grid: {
                                    padding: {
                                        top: -8,
                                        bottom: -10,
                                        left: -5,
                                        right: 0,
                                    },
                                },
                                series: [r],
                                labels: ["Progress"],
                            });
                    new ApexCharts(o, e).render();
                }),
            document.querySelector("#analyticsBarChart")),
        l = {
            chart: { height: 250, type: "bar", toolbar: { show: !1 } },
            plotOptions: {
                bar: {
                    horizontal: !1,
                    columnWidth: "20%",
                    borderRadius: 3,
                    startingShape: "rounded",
                },
            },
            dataLabels: { enabled: !1 },
            colors: [config.colors.primary, config.colors_label.primary],
            series: [
                { name: "2020", data: [20, 9, 15, 20, 14, 22, 29, 27, 13] },
                { name: "2019", data: [5, 7, 12, 17, 9, 17, 26, 21, 10] },
                // { name: "2018", data: [5, 7, 12, 17, 9, 17, 26, 21, 10] },
            ],
            grid: { borderColor: a, padding: { bottom: -8 } },
            xaxis: {
                categories: [
                    "Ene",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Ago",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dic",
                ],
                axisBorder: { show: !1 },
                axisTicks: { show: !1 },
                labels: { style: { colors: r } },
            },
            yaxis: {
                min: 0,
                max: 30,
                tickAmount: 3,
                labels: { style: { colors: r } },
            },
            legend: { show: !1 },
            tooltip: {
                y: {
                    formatter: function (o) {
                        return "$ " + o + " pesos" + "<br>"+ o + "registros";
                    },
                },
            },
        },
        i =
            (null !== i && new ApexCharts(i, l).render(),
            document.querySelector("#referralLineChart")),
        l = {
            series: [{ data: [0, 150, 25, 100, 15, 149] }],
            chart: {
                height: 100,
                parentHeightOffset: 0,
                parentWidthOffset: 0,
                type: "line",
                toolbar: { show: !1 },
            },
            markers: {
                size: 6,
                colors: "transparent",
                strokeColors: "transparent",
                strokeWidth: 4,
                discrete: [
                    {
                        fillColor: o,
                        seriesIndex: 0,
                        dataPointIndex: 5,
                        strokeColor: config.colors.success,
                        strokeWidth: 4,
                        size: 6,
                        radius: 2,
                    },
                ],
                hover: { size: 7 },
            },
            dataLabels: { enabled: !1 },
            stroke: { width: 4, curve: "smooth" },
            grid: { show: !1, padding: { top: -25, bottom: -20 } },
            colors: [config.colors.success],
            xaxis: {
                show: !1,
                axisBorder: { show: !1 },
                axisTicks: { show: !1 },
                labels: { show: !1 },
            },
            yaxis: { labels: { show: !1 } },
        },
        i =
            (null !== i && new ApexCharts(i, l).render(),
            document.querySelector("#conversionBarchart")),
        l = {
            chart: {
                height: 100,
                stacked: !0,
                type: "bar",
                toolbar: { show: !1 },
                sparkline: { enabled: !0 },
            },
            plotOptions: {
                bar: {
                    columnWidth: "25%",
                    borderRadius: 2,
                    startingShape: "rounded",
                },
                distributed: !0,
            },
            colors: [config.colors.primary, config.colors.warning],
            series: [
                {
                    name: "New Clients",
                    data: [
                        75, 150, 225, 200, 35, 50, 150, 180, 50, 150, 240, 140,
                        75, 35, 60, 120,
                    ],
                },
                {
                    name: "Retained Clients",
                    data: [
                        -100, -55, -40, -120, -70, -40, -60, -50, -70, -30, -60,
                        -40, -50, -70, -40, -50,
                    ],
                },
            ],
            grid: { show: !1, padding: { top: 0, bottom: -10 } },
            legend: { show: !1 },
            dataLabels: { enabled: !1 },
            tooltip: { x: { show: !1 } },
        },
        i =
            (null !== i && new ApexCharts(i, l).render(),
            document.querySelector("#impressionDonutChart")),
        l = {
            chart: { height: 185, fontFamily: "IBM Plex Sans", type: "donut" },
            dataLabels: { enabled: !1 },
            grid: { padding: { bottom: -10 } },
            series: [80, 30, 60],
            labels: ["Social", "Email", "Search"],
            stroke: { width: 0, lineCap: "round" },
            colors: [
                config.colors.primary,
                config.colors.info,
                config.colors.warning,
            ],
            plotOptions: {
                pie: {
                    donut: {
                        size: "90%",
                        labels: {
                            show: !0,
                            name: { fontSize: "0.938rem", offsetY: 20 },
                            value: {
                                show: !0,
                                fontSize: "1.625rem",
                                fontFamily: "Rubik",
                                fontWeight: "500",
                                color: e,
                                offsetY: -20,
                                formatter: function (o) {
                                    return o;
                                },
                            },
                            total: {
                                show: !0,
                                label: "Impression",
                                color: t,
                                formatter: function (o) {
                                    return o.globals.seriesTotals.reduce(
                                        function (o, e) {
                                            return o + e;
                                        },
                                        0
                                    );
                                },
                            },
                        },
                    },
                },
            },
            legend: {
                show: !0,
                position: "bottom",
                horizontalAlign: "center",
                labels: { colors: t, useSeriesColors: !1 },
                markers: { width: 10, height: 10, offsetX: -3 },
            },
        },
        i =
            (null !== i && new ApexCharts(i, l).render(),
            document.querySelector("#conversationChart")),
        l = {
            series: [{ data: [50, 100, 0, 60, 20, 30] }],
            chart: {
                height: 40,
                type: "line",
                zoom: { enabled: !1 },
                sparkline: { enabled: !0 },
                toolbar: { show: !1 },
            },
            dataLabels: { enabled: !1 },
            tooltip: { enabled: !1 },
            stroke: { curve: "smooth", width: 3 },
            grid: {
                show: !1,
                padding: { top: 5, left: 10, right: 10, bottom: 5 },
            },
            colors: [config.colors.primary],
            fill: {
                type: "gradient",
                gradient: {
                    shade: s,
                    type: "horizontal",
                    gradientToColors: void 0,
                    opacityFrom: 0,
                    opacityTo: 0.9,
                    stops: [0, 30, 70, 100],
                },
            },
            xaxis: {
                labels: { show: !1 },
                axisBorder: { show: !1 },
                axisTicks: { show: !1 },
            },
            yaxis: { labels: { show: !1 } },
        },
        i =
            (null !== i && new ApexCharts(i, l).render(),
            document.querySelector("#incomeChart")),
        l = {
            series: [{ data: [40, 70, 38, 90, 40, 65] }],
            chart: {
                height: 40,
                type: "line",
                zoom: { enabled: !1 },
                sparkline: { enabled: !0 },
                toolbar: { show: !1 },
            },
            dataLabels: { enabled: !1 },
            tooltip: { enabled: !1 },
            stroke: { curve: "smooth", width: 3 },
            grid: {
                show: !1,
                padding: { top: 10, left: 10, right: 10, bottom: 0 },
            },
            colors: [config.colors.warning],
            fill: {
                type: "gradient",
                gradient: {
                    shade: s,
                    type: "horizontal",
                    gradientToColors: void 0,
                    opacityFrom: 0,
                    opacityTo: 0.9,
                    stops: [0, 30, 70, 100],
                },
            },
            xaxis: {
                labels: { show: !1 },
                axisBorder: { show: !1 },
                axisTicks: { show: !1 },
            },
            yaxis: { labels: { show: !1 } },
        },
        i =
            (null !== i && new ApexCharts(i, l).render(),
            document.querySelector("#registrationsBarChart")),
        l = {
            chart: {
                height: 95,
                width: 155,
                type: "bar",
                toolbar: { show: !1 },
            },
            plotOptions: {
                bar: {
                    barHeight: "80%",
                    columnWidth: "50%",
                    startingShape: "rounded",
                    endingShape: "rounded",
                    borderRadius: 2,
                    distributed: !0,
                },
            },
            grid: {
                show: !1,
                padding: { top: -20, bottom: -20, left: 0, right: 0 },
            },
            colors: [
                config.colors_label.warning,
                config.colors_label.warning,
                config.colors_label.warning,
                config.colors_label.warning,
                config.colors.warning,
                config.colors_label.warning,
                config.colors_label.warning,
            ],
            dataLabels: { enabled: !1 },
            series: [{ data: [30, 55, 45, 95, 70, 50, 65] }],
            legend: { show: !1 },
            xaxis: {
                categories: ["M", "T", "W", "T", "F", "S", "S"],
                axisBorder: { show: !1 },
                axisTicks: { show: !1 },
                labels: { show: !1 },
            },
            yaxis: { labels: { show: !1 } },
        },
        i =
            (null !== i && new ApexCharts(i, l).render(),
            document.querySelector("#salesChart")),
        l = {
            chart: {
                height: 120,
                parentHeightOffset: 0,
                type: "bar",
                toolbar: { show: !1 },
            },
            plotOptions: {
                bar: {
                    barHeight: "100%",
                    columnWidth: "25px",
                    startingShape: "rounded",
                    endingShape: "rounded",
                    borderRadius: 5,
                    distributed: !0,
                    colors: {
                        backgroundBarColors: [
                            config.colors_label.primary,
                            config.colors_label.primary,
                            config.colors_label.primary,
                            config.colors_label.primary,
                        ],
                        backgroundBarRadius: 5,
                    },
                },
            },
            grid: { show: !1, padding: { top: -30, left: -12, bottom: 10 } },
            colors: [config.colors.primary],
            dataLabels: { enabled: !1 },
            series: [{ data: [60, 35, 25, 75, 15, 42, 85] }],
            legend: { show: !1 },
            xaxis: {
                categories: ["S", "M", "T", "W", "T", "F", "S"],
                axisBorder: { show: !1 },
                axisTicks: { show: !1 },
                labels: { style: { colors: r, fontSize: "13px" } },
            },
            yaxis: { labels: { show: !1 } },
            responsive: [
                {
                    breakpoint: 1440,
                    options: { plotOptions: { bar: { columnWidth: "30%" } } },
                },
                {
                    breakpoint: 1200,
                    options: { plotOptions: { bar: { columnWidth: "15%" } } },
                },
                {
                    breakpoint: 768,
                    options: { plotOptions: { bar: { columnWidth: "12%" } } },
                },
                {
                    breakpoint: 450,
                    options: { plotOptions: { bar: { columnWidth: "19%" } } },
                },
            ],
        },
        i =
            (null !== i && new ApexCharts(i, l).render(),
            document.querySelector("#growthRadialChart")),
        l = {
            chart: {
                height: 230,
                fontFamily: "IBM Plex Sans",
                type: "radialBar",
                sparkline: { show: !0 },
            },
            grid: { show: !1, padding: { top: -25 } },
            plotOptions: {
                radialBar: {
                    size: 100,
                    startAngle: -135,
                    endAngle: 135,
                    offsetY: 10,
                    hollow: { size: "55%" },
                    track: { strokeWidth: "50%", background: o },
                    dataLabels: {
                        value: {
                            offsetY: -15,
                            color: e,
                            fontFamily: "Rubik",
                            fontWeight: 500,
                            fontSize: "26px",
                        },
                        name: { fontSize: "15px", color: t, offsetY: 24 },
                    },
                },
            },
            colors: [config.colors.danger],
            fill: {
                type: "gradient",
                gradient: {
                    shade: "dark",
                    type: "horizontal",
                    shadeIntensity: 0.5,
                    gradientToColors: [config.colors.primary],
                    inverseColors: !0,
                    opacityFrom: 1,
                    opacityTo: 1,
                    stops: [0, 100],
                },
            },
            stroke: { dashArray: 3 },
            series: [78],
            labels: ["Growth"],
        };
    null !== i && new ApexCharts(i, l).render();
})();
