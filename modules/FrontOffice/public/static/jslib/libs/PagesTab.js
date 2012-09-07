CaterJS.libs.PagesTab = (function(){

    var SQL_GET_SLOWEST_SCRIPTS = "SELECT req_count, req_time_total/req_count AS req_time, script_name, server_name, hostname FROM " +
                                  "report_by_hostname_server_and_script WHERE %s ORDER BY req_time DESC LIMIT 10",

        SQL_GET_REQUESTED_SCRIPTS = "SELECT req_count, req_time_total/req_count AS req_time, script_name, server_name, hostname FROM " +
                                    "report_by_hostname_server_and_script WHERE %s ORDER BY req_count DESC LIMIT 10",

        SQL_GET_ERROR_SCRIPTS = "SELECT SUM(req_count) AS req_count, AVG(mem_peak_usage) AS mem_usage, AVG(req_time) AS req_time, " +
                                  "script_name, server_name, hostname, status FROM request WHERE " +
                                  "substr(status, 1, 1) <> '2' AND substr(status, 1, 1) <> '3' AND %s GROUP BY " +
                                  "script_name, server_name, hostname, status ORDER BY req_count DESC LIMIT 10",

        SQL_GET_SLOWEST_SCRIPTS_ABSOLUTE = "SELECT count(*) AS req_count, req_time, script_name, server_name, hostname FROM request WHERE %s GROUP BY script_name, req_time, server_name, hostname ORDER BY req_time DESC LIMIT 10",

        SQL_GET_SCRIPT_STATISTIC = "SELECT req_time, count(*) AS req_count FROM request WHERE script_name = ? AND server_name = ? AND hostname = ? GROUP BY "+
                                    "req_time ORDER BY req_time;";

        fieldNames = {
            req_count: "Кол-во запросов",
            mem_usage: "Память",
            req_time: 'Время запроса',
            script_name: 'Страница',
            server_name: 'Домен',
            hostname: 'Сервер',
            status: 'Статус'
        },

        fieldFormatter = {
            req_time: function(row){
                var v = parseFloat(row['req_time']);
                return v.toFixed(4);
            },
            script_name: function(row){
                return sprintf('<a href="#info-window" data-toggle="modal" data-type="info-window" data-hostname="%s" data-server-name="%s" data-url="%s"  data-title="Запросы">%s</a>',
                       row['hostname'],
                       row['server_name'],
                       row['script_name'],
                       cutString(row['script_name'])
                );
            },
            hostname: function(row){
                return sprintf('<a href="/server/%s">%s</a>', row['hostname'], row['hostname']);
            },
            server_name: function(row){
                return sprintf('<a href="/domain/%s">%s</a>', row['server_name'], row['server_name']);
            }
        };

    function cutString(str, length){
        length = length || 100;
        if (str.length < length){
            return str;
        }
        return str.substr(0, length - 3) + '...';
    }

    function initHrefEvents(){

        $('body').off('.data-api'); // отключаем

        $(document).delegate('[data-type=info-window]', 'click',
            function(){
                var $this = $(this);
                 //alert($this.attr('data-title'));
                 var $window = CaterJS.libs.Helpers.showInfoWindow($this.attr('data-title'), '<img src="/static/img/loading.gif" border="0">');
                 $.executeSql(SQL_GET_SCRIPT_STATISTIC,
                     [$this.attr('data-url'), $this.attr('data-server-name'), $this.attr('data-hostname')],
                     function (data){
                         var container = $window.find('.modal-body').get(0),
                             title = $this.attr('data-server-name') + $this.attr('data-url'),
                             x = [],
                             y = [];
                         for (var i = 0; i < data.length; i++){
                             x.push(parseFloat(data[i].req_time));
                             y.push(parseInt(data[i].req_count));
                         }
                         drawGraph(container, x, y, title);
                    }
                 );
            }
        );
    }


    function drawGraph(container, x, y, title){
        new Highcharts.Chart({
            chart: {
                renderTo: container,
                type: 'column'
            },
            title: {
                text: 'Самые медленные запросы для '
            },
            subtitle: {
                text: title
            },
            xAxis: {
                categories: x
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Кол-во запросов'
                }
            },
            legend: {
                layout: 'vertical',
                backgroundColor: '#FFFFFF',
                align: 'left',
                verticalAlign: 'bottom',
                x: 100,
                y: 70,
                floating: true,
                shadow: true
            },
            tooltip: {
                formatter: function() {
                    return 'Запросов: '+ this.y + "<br>" + "Время: "+this.x;
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Кол-во запросов',
                data: y
            }]
        });
    }

    function load($container){
//        initHrefEvents();
        var server = $container.attr('data-server'),
            domain = $container.attr('data-domain'),
            type = $container.attr('data-type');
        switch (type){
            case 'topSlowestPages':
                fillTable($container, SQL_GET_SLOWEST_SCRIPTS, ['server_name', 'hostname', 'script_name', 'req_time', 'req_count']);
                break;
            case 'topSlowestPagesAbsolute':
                fillTable($container, SQL_GET_SLOWEST_SCRIPTS_ABSOLUTE, ['server_name', 'hostname', 'script_name', 'req_time', 'req_count']);
                break;
            case 'topErrorPages':
                fillTable($container, SQL_GET_ERROR_SCRIPTS, ['server_name', 'hostname', 'script_name', 'status']);
                break;
            case 'topRequestedPages':
                fillTable($container, SQL_GET_REQUESTED_SCRIPTS, ['server_name', 'hostname', 'script_name', 'req_time', 'req_count']);
                break;
        }

    }

    function fillTable($container, sql, fields){
        var sqlWhere = ['1'],
            sqlParams = [];

        if ($container.attr('data-server')){
            sqlWhere.push('hostname = ?');
            sqlParams.push($container.attr('data-server'));
        }
        if ($container.attr('data-domain')){
            sqlWhere.push('server_name = ?');
            sqlParams.push($container.attr('data-domain'));
        }
        var sql = sprintf(sql, sqlWhere.join(' AND '));
        $container.html('<img src="/static/img/loading.gif" border="0">');
        $.executeSql(sql, sqlParams, function(data){
            var html = [],
                i = 0;
            html.push('<table class="table table-bordered table-striped" data-type="data">');
            html.push('<thead>');
            html.push('<tr>');
            for (i = 0; i < fields.length; i++){
                var field = fields[i];
                html.push(sprintf('<th>%s</th>', fieldNames[field]));
            }
            html.push('</tr>');
            html.push('</thead>');
            html.push('<tbody>');
            for (i = 0; i < data.length; i++){
                var row = data[i];
                html.push('<tr>');
                for (var k = 0; k < fields.length; k++){
                    var field = fields[k],
                        val = row[field];
                    if (fieldFormatter[field]){
                        val = fieldFormatter[field](row);
                    }
                    html.push(sprintf('<td>%s</td>', val));
                }
                html.push('</tr>');
            }
            html.push('</tbody>');
            html.push('</table>');
            $container.html(html.join("\n"));
        });
    }

    initHrefEvents();

    return {
        load:load
    };

})();
