CaterJS.libs.Graph = (function(){
    var GRAPH_TYPE_REQUEST_SEC = 'requests_per_sec';

    function draw($container){

        Highcharts.setOptions({
            global: {
                useUTC: false
            }
        });

        var type = $container.attr('data-graph-type');
        switch (type){
            case GRAPH_TYPE_REQUEST_SEC:
                var domain = $container.attr('data-domain'),
                    server = $container.attr('data-server'),
                    title = $container.attr('data-title');
                drawRequestsPerSecGraph($container.get(0), domain, server, title);
                break;
        }
    }

    function drawRequestsPerSecGraph(div, domain, server, title){
        var data = [],
            totalTicks = 10,
            updateInterval = 10000;
        div.chart = new Highcharts.Chart({
            chart: {
                renderTo: div,
                defaultSeriesType: 'line',
                marginRight: 10,
                events: {
                    load: function() {

                        var series = this.series[0];
                        var yAxis = this.yAxis;

                        function updateData(){
                            $.executeSql('SELECT req_per_sec FROM report_by_hostname_and_server WHERE server_name = ? AND hostname = ?',
                                [domain, server],
                                function (data){
                                    var x = (new Date()).getTime(),
                                        y = !data[0] || !data[0]['req_per_sec'] ? 0 : data[0]['req_per_sec'];
                                    series.addPoint([x, parseFloat(y)], true, true);
                                }
                            );
                        }

                        updateData();
                        setInterval(function() {
                            updateData();
                        }, updateInterval);
                    }
                }
            },
            title: {
                text: title
            },
            xAxis: {
                type: 'datetime',
                tickPixelInterval: 150
            },
            yAxis: {
                title: {
                    text: title
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                        Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) +'<br/>'+
                        Highcharts.numberFormat(this.y, 2);
                }
            },
            legend: {
                enabled: false
            },
            exporting: {
                enabled: false
            },
            series: [{
                name: title,
                data: (function(){

                    var data = [],
                        time = (new Date()).getTime(),
                        i;

                    for (i = -1 * totalTicks; i <= 0; i++){
                        data.push({
                            x: time + i * 10,
                            y: 0
                        });
                    }

                    return data;
                })()
            }]
        });
    }

    return {
        draw: draw
    };
})();