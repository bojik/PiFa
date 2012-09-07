<?php
/**
 * Base class of db working
 *
 * @package Pifa
 * @subpackage Db
 * @author Alexander Rodionov <avrodionov@rbc.ru>
 * $Id: Db.class.php 56845 2012-08-20 12:58:44Z avrodionov $
 */
class Pifa_Db
{
    static private $_db = null;

    /**
     * Returns db
     *
     * @return Zend_Db_Adapter_Abstract
     */
    static function getDb()
    {
        if ( !( self::$_db instanceof Zend_Db ) )
        {
            $config = Miao_Config::Libs(__CLASS__)->toArray();
            self::$_db = Zend_Db::factory( 'PDO_MYSQL', $config );
        }
        return self::$_db;
    }

    /**
     * Returns db variables
     *
     * @return array
     */
    static function getVariables()
    {
        $db = self::getDb();
        $res = $db->query( 'SHOW VARIABLES' )->fetchAll();
        return $res;
    }
}