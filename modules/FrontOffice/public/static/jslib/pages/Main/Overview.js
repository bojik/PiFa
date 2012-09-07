CaterJS.pages.Main.Overview = (function(){
    var $serverOverview, $domainOverview,
        SQL_SERVER_OVERVIEW = "SELECT * FROM report_by_hostname ORDER BY hostname",
        SQL_DOMAIN_OVERVIEW = "SELECT * FROM report_by_server_name ORDER BY server_name",
        serverOverviewObj, domainOverviewObj;

    function init(){
        updateVars();
        bindEvents();
    }

    function updateVars(){
        $serverOverview = $('#servers-overview');
        $domainOverview = $('#domains-overview');

        serverOverviewObj = new CaterJS.libs.Overview($serverOverview, SQL_SERVER_OVERVIEW, ['hostname', 'req_count', 'req_per_sec'])
                                .addKeyFormat('hostname', '<a href="/server/%s">%s</a>');

        domainOverviewObj = new CaterJS.libs.Overview($domainOverview, SQL_DOMAIN_OVERVIEW, ['server_name', 'req_count', 'req_per_sec'])
                                .addKeyFormat('server_name', '<a href="/domain/%s">%s</a>');
    }

    function bindEvents(){
        setInterval(fillServerOverviewTable, 10000);
        fillServerOverviewTable();
        setInterval(fillDomainOverviewTable, 10000);
        fillDomainOverviewTable();
    }

    function fillServerOverviewTable(){
        serverOverviewObj.execute();
    }

    function fillDomainOverviewTable(){
        domainOverviewObj.execute();
    }

    return {
        init: init
    }
})();