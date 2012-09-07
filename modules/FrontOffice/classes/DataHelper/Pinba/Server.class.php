<?php
/**
 * Helper to obtain information about server
 *
 * @package Pifa
 * @subpackage FrontOffice_DataHelper_Pinba
 * @author Alexander Rodionov <avrodionov@rbc.ru>
 * $Id: Server.class.php 55444 2012-07-11 09:47:33Z avrodionov $
 */
class Pifa_FrontOffice_DataHelper_Pinba_Server
{
    const SQL_SELECT_DOMAINS = "SELECT server_name FROM report_by_hostname_and_server WHERE hostname = ?;";

    /**
     * @var string
     */
    protected $_server;

    function __construct($server)
    {
        $this->_server = $server;
    }

    /**
     * Returns domains for given server
     * @return array
     */
    function getDomains()
    {
        $res = Pifa_Db::getDb()->query( self::SQL_SELECT_DOMAINS, array( $this->_server ) )->fetchAll();
        $ret = array();
        foreach ( $res as $row )
        {
            $ret[] = $row['server_name'];
        }
        return $ret;
    }
}
