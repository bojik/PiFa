CaterJS.pages.DomainInfo.Servers = (function () {
    var $serverOverview, domainName, overView,
    SQL_SERVER_OVERVIEW = "SELECT hostname, req_count, req_per_sec FROM report_by_hostname_and_server WHERE server_name = ? ";


    function init() {
        updateVars();
        bindEvents();
    }

    function updateVars() {
        $serverOverview = $('#servers-domain');
        domainName = CaterJS.libs.Data.get('domain');
        overView = new CaterJS.libs.Overview($serverOverview, SQL_SERVER_OVERVIEW, ['hostname', 'req_count', 'req_per_sec'])
            .setSql(SQL_SERVER_OVERVIEW, [domainName])
            .addKeyFormat('hostname', '<a href="/server/%s">%s</a>');
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
