<?php
/**
 * Block displayed server information
 *
 * @package Pifa
 * @subpackage FrontOffice_ViewBlock
 * @author Alexander Rodionov <avrodionov@rbc.ru>
 * $Id: ServerInfo.class.php 55444 2012-07-11 09:47:33Z avrodionov $
 */
class Pifa_FrontOffice_ViewBlock_ServerInfo extends Miao_Office_ViewBlock
{
    /**
     * @var string
     */
    protected $_server;

    /**
     * @var Pifa_FrontOffice_DataHelper_Pinba_Server
     */
    protected $_serverHelper;

    protected function _processData()
    {
        $this->_server = array_shift(Pifa_FrontOffice_Router::getInstance()->getParams());
        $this->_serverHelper = new Pifa_FrontOffice_DataHelper_Pinba_Server($this->_server);
    }

    protected function _setTemplateVariables()
    {
        $this->_setTmplVar('server', $this->_server);
        $this->_setTmplVar('domains', $this->_serverHelper->getDomains());
    }

}
