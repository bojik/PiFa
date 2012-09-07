<?php
$settings = $this->_getValueOf('settings');
$settingNames = array (
    Pifa_FrontOffice_DataHelper_Pinba_Settings::ADDRESS => 'IP адреса приема данных',
    Pifa_FrontOffice_DataHelper_Pinba_Settings::PORT => 'Порт демона',
    Pifa_FrontOffice_DataHelper_Pinba_Settings::REQUEST_POOL_SIZE => 'Максимальное кол-во хранимых запросов',
    Pifa_FrontOffice_DataHelper_Pinba_Settings::STATS_GETHERING_PERIOD => 'Интервал сбора данных (мс)',
    Pifa_FrontOffice_DataHelper_Pinba_Settings::STATS_HISTORY => 'Время хранения статистики (сек)',
    Pifa_FrontOffice_DataHelper_Pinba_Settings::TAG_REPORT_TIMEOUT => 'Время хранения данных по тэгам (сек)',
    Pifa_FrontOffice_DataHelper_Pinba_Settings::TEMP_POOL_SIZE => 'Максимальный размер временной очереди',
);
?>
<div id="settings-window" class="modal hide">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Настройки сервера</h3>
    </div>
    <div class="modal-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Переменная</th>
                    <th>Значение</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($settings as $s=>$v):?>
            <tr>
                <td><?php printf('%s / %s', $settingNames[$s], $s)?></td>
                <td><?php echo $v?></td>
            </tr>
            <?php endforeach?>
            </tbody>
        </table>
    </div>
</div>