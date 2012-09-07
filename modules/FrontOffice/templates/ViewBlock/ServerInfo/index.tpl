<?php
$server = $this->getValueOf('server');
$domains = $this->getValueOf('domains');
?>

<header id="overview" class="jumbotron subhead">
<h1><?php echo $server?></h1>
<p class="lead"></p>

<div class="subnav">
    <ul class="nav nav-pills">
        <li><a href="#domains">Обзор по доменам</a></li>
        <li><a href="#pages">Страницы</a></li>
        <li><a href="#graphics">Графики</a></li>
    </ul>
</div>
</header>

<section id="domains">
<h2>Обзор по доменам</h2>
<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>Сервер</th>
        <th>Запросы</th>
        <th>Запросы/сек</th>
    </tr>
    </thead>
    <tbody id="domain-servers">
    </tbody>
</table>
</section>

<section id="pages">
<h2>Страницы</h2>

<ul class="nav nav-tabs" id="pagesInfo">
    <li class="active"><a href="#topRequestedPages">10 самых запрашиваемых страниц</a></li>
    <li><a href="#topSlowestPages">10 самых медленных страниц (среднее)</a></li>
    <li><a href="#topSlowestPagesAbsolute">10 самых медленных страниц</a></li>
    <li><a href="#topErrorPages">10 страниц с ошибками</a></li>
</ul>

<div class="tab-content">

    <div class="tab-pane active pages-info"
         id="topRequestedPages"
         data-type="topRequestedPages"
         data-server="<?php echo $server?>">
    </div>

    <div class="tab-pane pages-info"
         id="topSlowestPages"
         data-type="topSlowestPages"
         data-server="<?php echo $server?>">
    </div>

    <div class="tab-pane pages-info"
         id="topSlowestPagesAbsolute"
         data-type="topSlowestPagesAbsolute"
         data-server="<?php echo $server?>">
    </div>

    <div class="tab-pane pages-info"
         id="topErrorPages"
         data-type="topErrorPages"
         data-server="<?php echo $server?>">
    </div>

</div>
</section>

<section id="graphics">
<h2>Графики</h2>

<?php if (!empty ($domains)):?>
<div style="clear: both;height:400px;">
    <?php foreach ($domains as $domain):?>
    <div class="graph"
         data-graph-type="requests_per_sec"
         data-domain="<?php echo $domain?>"
         data-server="<?php echo $server?>"
         data-title="Запросы к <?php echo $domain?>">
    </div>
    <?php endforeach?>
</div>
<?php endif?>
</section>

<script type="text/javascript">
CaterJS.libs.Data.set('server', <?php echo json_encode($server)?>);
$('#pagesInfo a').click(function (e) {
    e.preventDefault();
    $(this).tab('show');
    CaterJS.libs.PagesTab.load($($(this).attr('href')));
})
</script>