<?php
/**
 * Page for displaying domain information
 *
 * @package Pifa
 * @subpackage FrontOffice_View
 * @author Alexander Rodionov <avrodionov@rbc.ru>
 * $Id: Domain.class.php 55444 2012-07-11 09:47:33Z avrodionov $
 */
class Pifa_FrontOffice_View_Domain extends Pifa_FrontOffice_View
{
    protected $_jsAutoStart = 'DomainInfo';

    protected function _initializeBlock()
    {
        parent::_initializeBlock();
        $this->_addBlock( 'DomainInfo', 'Pifa_FrontOffice_ViewBlock_DomainInfo');
    }
}
