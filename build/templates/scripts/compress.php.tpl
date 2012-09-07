<?php
require_once '#phing:libs.Pifa.deploy.dst#/scripts/bootstrap.php';
$helper = Pifa_FrontOffice_DataHelper_JsCssList::getInstance();

$helper->css( true );
$helper->js( true );