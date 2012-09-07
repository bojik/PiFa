<?php
/**
 * Page for displaying server details
 *
 * @package Pifa
 * @subpackage FrontOffice_View
 * @author Alexander Rodionov <avrodionov@rbc.ru>
 * $Id: Server.class.php 55444 2012-07-11 09:47:33Z avrodionov $
 */
class Pifa_FrontOffice_View_Server extends Pifa_FrontOffice_View
{
    protected $_jsAutoStart = 'ServerInfo';

    protected function _initializeBlock()
    {
        parent::_initializeBlock();
        $this->_addBlock( 'ServerInfo', 'Pifa_FrontOffice_ViewBlock_ServerInfo');
    }

}
