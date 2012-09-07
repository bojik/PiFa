CaterJS.pages.ServerInfo.Domains = (function () {
    var $serverOverview, serverName, overView,
        SQL_SERVER_OVERVIEW = "SELECT server_name, req_count, req_per_sec FROM report_by_hostname_and_server WHERE hostname = ? ";


    function init() {
        updateVars();
        bindEvents();
    }

    function updateVars() {
        $serverOverview = $('#domain-servers');
        serverName = CaterJS.libs.Data.get('server');
        overView = new CaterJS.libs.Overview($serverOverview, SQL_SERVER_OVERVIEW, ['server_name', 'req_count', 'req_per_sec'])
            .setSql(SQL_SERVER_OVERVIEW, [serverName])
            .addKeyFormat('hostname', '<a href="/domain/%s">%s</a>');
    }

    function bindEvents() {
        setInterval(fillServerOverviewTable, 10000);
        fillServerOverviewTable();
    }

    function fillServerOverviewTable(){
        overView.execute();
    }

    return {
        init:init
    }
})();
