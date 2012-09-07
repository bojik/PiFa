<?php
/**
 * Information about domain
 *
 * @package Pifa
 * @subpackage FrontOffice_ViewBlock
 * @author Alexander Rodionov <avrodionov@rbc.ru>
 * $Id: DomainInfo.class.php 55444 2012-07-11 09:47:33Z avrodionov $
 */
class Pifa_FrontOffice_ViewBlock_DomainInfo extends Miao_Office_ViewBlock
{
    /**
     * @var string
     */
    protected $_domain;

    /**
     * @var Pifa_FrontOffice_DataHelper_Pinba_Domain
     */
    protected $_domainHelper = null;

    protected function _processData()
    {
        $this->_domain = array_shift(Pifa_FrontOffice_Router::getInstance()->getParams());
        $this->_domainHelper = new Pifa_FrontOffice_DataHelper_Pinba_Domain($this->_domain);
    }

    protected function _setTemplateVariables()
    {
        $this->_setTmplVar('domain', $this->_domain);
        $this->_setTmplVar('servers', $this->_domainHelper->getServers());
    }

}
