<?php
/**
 * Action for requests that execute sql statements and return result
 * Params:
 * sql - sql query
 * params - sql execution params
 *
 * @package Pifa
 * @subpackage FrontOffice_Action_Json
 * @author Alexander Rodionov <avrodionov@rbc.ru>
 * $Id: Sql.class.php 56359 2012-08-07 12:07:53Z avrodionov $
 */
class Pifa_FrontOffice_Action_Json_Sql extends Pifa_FrontOffice_Action_Json
{
    /**
     * Returns array of values for json response
     *
     * @return array
     */
    protected function _getData()
    {
        $request = Miao_Office_Request::getInstance();
        $sql = $request->getValueOf( 'sql', '' );
        $params = $request->getValueOf( 'params', array() );
        $ret = array ();
        if ( !empty( $sql ) )
        {
            $db = Pifa_Db::getDb();
            try
            {
                $timer = new Pifa_Pinba_Timer(array ('sql' => $sql, 'params' => serialize($params)));
                $timer->start();
                $result = $db->query( $sql, $params )->fetchAll();
                $timer->stop();
                $ret = array (
                    'success' => true,
                    'result' => $result
                );
            }
            catch (Zend_Db_Exception $e)
            {
                $ret = array (
                    'success' => false,
                    'error' => $e->getMessage()
                );
            }
        }
        return $ret;
    }

}
