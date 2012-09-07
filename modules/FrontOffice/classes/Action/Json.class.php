<?php
/**
 * Action for all json requests of the project
 *
 * @package Pifa
 * @subpackage FrontOffice_Action
 * @author Alexander Rodionov <avrodionov@rbc.ru>
 * $Id: Json.class.php 55444 2012-07-11 09:47:33Z avrodionov $
 */
abstract class Pifa_FrontOffice_Action_Json extends Pifa_FrontOffice_Action
{
    public function execute()
    {
        return json_encode($this->_getData());
    }

    /**
     * Returns array of values for json response
     * @return array
     */
    abstract protected function _getData();
}
