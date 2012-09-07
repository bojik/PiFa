<?php
/**
 * Domain info on server side
 *
 * @package Pifa
 * @subpackage FrontOffice_DataHelper_Pinba
 * @author Alexander Rodionov <avrodionov@rbc.ru>
 * $Id: Domain.class.php 55444 2012-07-11 09:47:33Z avrodionov $
 */
class Pifa_FrontOffice_DataHelper_Pinba_Domain
{
    /**
     * Select all servers for given domain
     */
    const SQL_SELECT_SERVERS = "SELECT hostname FROM report_by_hostname_and_server WHERE server_name = ?;";

    /**
     * @var string
     */
    protected $_domain;

    function __construct( $domain )
    {
        $this->_domain = $domain;
    }

    /**
     * Returns servers for given domain
     *
     * @return array
     */
    function getServers()
    {
        $res = Pifa_Db::getDb()->query( self::SQL_SELECT_SERVERS, array( $this->_domain ) )->fetchAll();
        $ret = array();
        foreach ( $res as $row )
        {
            $ret[] = $row['hostname'];
        }
        return $ret;
    }

}
