<table id="list4"></table>
<div id="pager2"></div>
<script type="text/javascript">
    jQuery("#list4").jqGrid({
        url:'/urls/json',
        datatype:"json",
        colNames:['Скрипт', 'Сервер', 'Хост', 'Запросы', 'Запросы/сек'],
        colModel:[
            {name:'script_name', index:'script_name', width:400, sorttype:"string"},
            {name:'hostname', index:'hostname', width:200, sorttype:"string"},
            {name:'server_name', index:'server_name', width:200, sorttype:"string"},
            {name:'req_count', index:'req_count', width:60, sorttype:"int"},
            {name:'req_per_sec', index:'req_per_sec', width:100, sorttype:"float"}
        ],
        height: 250,
        rowNum: 10,
        rowList:[10, 20, 30],
        pager:'#pager2',
        sortname:'script_name',
        viewrecords:true,
        sortorder:"asc",
        loadonce:false,
        caption:"Urls"
    });
</script>