<?php
$domain = $this->getValueOf('domain');
$servers = $this->getValueOf('servers');
?>
<header id="overview" class="jumbotron subhead">
<h1><?php echo $domain?></h1>
<p class="lead"></p>
    <div class="subnav">
        <ul class="nav nav-pills">
            <li><a href="#servers">Обзор по серверам</a></li>
            <li><a href="#pages">Страницы</a></li>
            <li><a href="#graphics">Графики</a></li>
        </ul>
    </div>
</header>

<section id="servers">
<h2>Обзор по серверам</h2>
<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>Сервер</th>
        <th>Запросы</th>
        <th>Запросы/сек</th>
    </tr>
    </thead>
    <tbody id="servers-domain">
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
         data-domain="<?php echo $domain?>">
    </div>

    <div class="tab-pane pages-info"
         id="topSlowestPages"
         data-type="topSlowestPages"
         data-domain="<?php echo $domain?>">
    </div>

    <div class="tab-pane pages-info"
         id="topSlowestPagesAbsolute"
         data-type="topSlowestPagesAbsolute"
         data-domain="<?php echo $domain?>">
    </div>

    <div class="tab-pane pages-info"
         id="topErrorPages"
         data-type="topErrorPages"
         data-domain="<?php echo $domain?>">
    </div>

</div>
</section>

<section id="graphics">
    <h2>Графики</h2>
<?php if (!empty ($servers)):?>
<div style="clear: both;height:900px;">
<?php foreach ($servers as $server):?>
<div class="graph"
     data-graph-type="requests_per_sec"
     data-domain="<?php echo $domain?>"
     data-server="<?php echo $server?>"
     data-title="Запросы на <?php echo $server?>">
</div>
<?php endforeach?>
</div>
<?php endif?>
</section>

<script type="text/javascript">
CaterJS.libs.Data.set('domain', <?php echo json_encode($domain) ?>);
$('#pagesInfo a').click(function (e) {
    e.preventDefault();
    $(this).tab('show');
    CaterJS.libs.PagesTab.load($($(this).attr('href')));
})
</script>