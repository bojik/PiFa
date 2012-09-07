CaterJS.pages.Main.Projects = (function(){

    var $container,
        $submenu,
        SQL_GET_PROJECTS = "SELECT DISTINCT server_name FROM report_by_server_name ORDER BY server_name";

    function init(){
        updateVars();
        bindEvents();
    }

    function updateVars(){
        $container = $('#hosts-container');
        $submenu = $('#submenu');
//        setInterval(updateProjects, 10000);
//        updateProjects();
    }

    function updateProjects(){
        $.executeSql(SQL_GET_PROJECTS, [], function (data){
            var html = [],
                menu = [];
            for (var i = 0; i < data.length; i++){
                html.push(formatRow(data[i]));
                menu.push(formatMenu(data[i]));
            }
            $container.html(html.join(''));
            $submenu.html(menu.join(''));
        });
    }

    function formatRow(row){
        var ret = '<div class="row" data-server-name="'+row.server_name+'" id="'+getIdByHost(row.server_name)+'">';
        ret += '<div class="span8">'+row.server_name+'</div>';
        ret += '<div class="span4"><a href="#" class="btn">test</a></div>';
        ret += '</div>';
        return ret;
    }

    function getIdByHost(host){
        var id = host.replace(/\./g, '-');
        return 'project-'+id;
    }

    function formatMenu(row){
        var ret = '<li><a href="#'+getIdByHost(row.server_name)+'">'+row.server_name+'</a></li>';
        return ret;
    }

    function bindEvents(){

    }

    return {
        init:init
    };
})();