$(document).ready(function() {
  //Am chart
  var chart = AmCharts.makeChart("chartdiv", {
  "type": "serial",
  "dataLoader": {
    "url": "pie_chart"
  },
  "valueAxes": [{
    "gridColor": "#FFFFFF",
    "gridAlpha": 0.2,
    "dashLength": 0
  }],
  "gridAboveGraphs": true,
  "startDuration": 1,
  "graphs": [{
    "balloonText": "[[category]]: <b>[[value]]</b>",
    "fillAlphas": 0.8,
    "lineAlpha": 0.2,
    "type": "column",
    "valueField": "profit"
  }],
  "chartCursor": {
    "categoryBalloonEnabled": false,
    "cursorAlpha": 0,
    "zoomable": false
  },
  "categoryField": "year",
  "categoryAxis": {
    "gridPosition": "start",
    "gridAlpha": 0,
    "tickPosition": "start",
    "tickLength": 20
  }
});
var piechart = AmCharts.makeChart( "piechartdiv", {
    "type": "pie",
    "theme": "light",
    "titleField": "year",
    "valueField": "profit",
    "dataLoader": {
        "url": "pie_chart",
        "format": "json"
    },
  });
var graph = [];
var pie = [];
    
    //areaChart();
    // donutChart();

    $(window).resize(function() {
      window.barChart.redraw();
       window.lineChart.redraw();
      // window.areaChart.redraw();
      window.donutChart.redraw();
    });

     $.ajax({
      "type":"GET",
      "url":"chart_data",
      "dataType": "JSON",
      success: function(response) {
         graph = response['chart_data'];
        console.log(graph);
        barChart();
        lineChart();
        
      }
    });
    
    $.ajax({
      "type":"GET",
      "url":"pie_chart",
      "dataType":"JSON",
      success: function(response){
        pie = response;
        console.log(response);
        donutChart();
      }
    });

  function lineChart() {
    window.lineChart = Morris.Line({
      element: 'line-chart',
      data: graph,
      xkey: 'year',
      ykeys: ['profit','purchase','sale'],
      labels: ['Profit', 'Purchase','Sale'],
      lineColors: ['#1e88e5','#ff3321','#ebe534'],
      lineWidth: '2px',
      parseTime: false,
      resize: true,
      redraw: true,
      grid:true
    });
  }

  function barChart() {
    window.barChart = Morris.Bar({
      element: 'bar-chart',
      data: graph,
      xkey: 'year',
      ykeys: ['profit','purchase','sale'],
      labels: ['Profit', 'Purchase','Sale'],
      barColors: ['#fcba03','#1c1b18','#8dd6d5'],
      lineWidth: '1px',
      parseTime: false,
      resize: true,
      redraw: true,
      grid: true
    });
  }

  function donutChart() {
    window.donutChart = Morris.Donut({
    element: 'donut-chart',
    data: [
          { label:'Users',value:'20'},
          { label:'Resturants',value:'30'},
          { label:'Vendors',value:'60'}
    ],
    colors: ['#4d7059','#8db4d6','#8dd6d5'],
    resize: true,
    redraw: true
    });
  }

});