<?php
/**
 * Pinba settings
 *
 * @package Pifa
 * @subpackage FrontOffice_ViewBlock
 * @author Alexander Rodionov <avrodionov@rbc.ru>
 * $Id: Settings.class.php 55444 2012-07-11 09:47:33Z avrodionov $
 */
class Pifa_FrontOffice_ViewBlock_Settings extends Miao_Office_ViewBlock
{
    protected $_settings;

    protected function _processData()
    {
        $this->_settings = Pifa_FrontOffice_DataHelper_Pinba_Settings::getVars();
    }

    protected function _setTemplateVariables()
    {
        $this->_setTmplVar('settings', $this->_settings);
    }

}
