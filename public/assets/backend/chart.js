function createChart(chartId, chartColor, statistics) {
    let currentYear = new Date().getFullYear();

    const options = {
        series: [{
            name: 'series1',
            data: statistics ?? []
        }],
        chart: {
            type: 'area',
            width: 80,
            height: 42,
            sparkline: {
                enabled: true
            },
            toolbar: {
                show: false
            },
            padding: {
                left: 0,
                right: 0,
                top: 0,
                bottom: 0
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth',
            width: 2,
            colors: [chartColor],
            lineCap: 'round'
        },
        grid: {
            show: true,
            borderColor: 'transparent',
            position: 'back',
            xaxis: {
                lines: { show: false }
            },
            yaxis: {
                lines: { show: false }
            },
            padding: {
                top: -3,
                right: 0,
                bottom: 0,
                left: 0,
            },
        },
        fill: {
            type: 'gradient',
            colors: [chartColor],
            gradient: {
                shade: 'light',
                type: 'vertical',
                shadeIntensity: 0.5,
                gradientToColors: [`${chartColor}00`],
                inverseColors: false,
                opacityFrom: 0.75,
                opacityTo: 0.3,
                stops: [0, 100],
            },
        },
        markers: {
            colors: [chartColor],
            strokeWidth: 2,
            size: 0,
            hover: { size: 8 }
        },
        xaxis: {
            labels: { show: false },
            categories: Array.from({ length: 12 }, (v, i) => `${new Date(0, i).toLocaleString('default', { month: 'short' })} ${currentYear}`),
            tooltip: { enabled: false },
        },
        yaxis: {
            labels: { show: false }
        },
        tooltip: {
            x: { format: 'dd/MM/yy HH:mm' },
        },
    };

    const chart = new ApexCharts(document.querySelector(`#${chartId}`), options);
    chart.render();
}
