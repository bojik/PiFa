<?php
/**
 * Handler for json requests
 *
 * @package Pifa
 * @subpackage FrontOffice_View
 * @author Alexander Rodionov <avrodionov@rbc.ru>
 * $Id$
 */
class Pifa_FrontOffice_View_Json extends Pifa_FrontOffice_View
{
    protected $_defaultLayout = 'layouts/json.tpl';

    protected function _initializeBlock()
    {
        $request = Miao_Office_Request::getInstance();
        $block = $request->getValueOf('_viewBlock');
        $class = 'Pifa_FrontOffice_ViewBlock_Json_'.$block;
        $this->_addBlock('Result', $class);
    }
}
