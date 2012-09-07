<?php
/**
 * Page for urls displaying
 *
 * @package Pifa
 * @subpackage FrontOffice_View
 * @author Alexander Rodionov <avrodionov@rbc.ru>
 * $Id: Urls.class.php 56402 2012-08-08 08:18:49Z avrodionov $
 */
class Pifa_FrontOffice_View_Urls extends Pifa_FrontOffice_View
{
    protected function _initializeBlock()
    {
        parent::_initializeBlock();
        $this->_addBlock('Urls', 'Pifa_FrontOffice_ViewBlock_Urls');
    }

}
