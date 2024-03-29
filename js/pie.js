/* pie.js - controls any pie.html js functions */
window.onload = function () {
    var chart = new CanvasJS.Chart("chartContainer", {
        title: {
            text: "Topic Requiring Most Help"
        },
        legend: {
            maxWidth: 350,
            itemWidth: 120
        },
        data: [{
            type: "pie",
            showInLegend: true,
            legendText: "{indexLabel}",
            dataPoints: [{
                y: 4181563,
                indexLabel: "Instructions"
            }, {
                y: 2175498,
                indexLabel: "Data Structures"
            }, {
                y: 3125844,
                indexLabel: "Part one"
            }, {
                y: 1176121,
                indexLabel: "Part two"
            }, {
                y: 1727161,
                indexLabel: "Objects"
            }, {
                y: 4303364,
                indexLabel: "Specific Part"
            }, {
                y: 1717786,
                indexLabel: "Life"
            }]
        }]
    });
    chart.render();
}