<?php
/**
 * Obtaining scripts information
 *
 * @package Pifa
 * @subpackage FrontOffice_DataHelper_Pinba
 * @author Alexander Rodionov <avrodionov@rbc.ru>
 * $Id: Scripts.class.php 57675 2012-09-06 11:14:19Z avrodionov $
 */

class Pifa_FrontOffice_DataHelper_Pinba_Scripts
{
    const DEFAULT_LIMIT = 10;

    const SQL_SELECT_SCRIPTS = "SELECT %s FROM report_by_hostname_server_and_script WHERE %s ORDER BY %s LIMIT %d OFFSET %d";

    protected $_filter = array (
        '1' => '1'
    );

    protected $_orderBy = "req_count DESC";

    function __construct()
    {

    }

    /**
     * @return int
     */
    function getTotal()
    {
        $fields = 'count(*)';
        $limit = PHP_INT_MAX;
        $offset = 0;
        $filter = $this->_getSqlFilter();
        $orderBy = 'req_count';
        $sql = sprintf(self::SQL_SELECT_SCRIPTS, $fields, $filter, $orderBy, $limit, $offset);
        return Pifa_Db::getDb()->query($sql)->fetchColumn();
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return array
     */
    function getRows($limit = self::DEFAULT_LIMIT, $offset = 0)
    {
        $fields = "script_name, hostname, req_count, req_per_sec, req_time_per_sec, server_name";
        $filter = $this->_getSqlFilter();
        $sql = sprintf(self::SQL_SELECT_SCRIPTS, $fields, $filter, $this->_orderBy, $limit, $offset);
        return Pifa_Db::getDb()->query($sql)->fetchAll();
    }

    /**
     * @param string $field
     * @param bool $desc
     * @return Pifa_FrontOffice_DataHelper_Pinba_Scripts
     */
    function setOrderBy($field, $desc = false)
    {
        $this->_orderBy = sprintf("%s %s", $field, $desc ? "DESC" : "ASC");
        return $this;
    }

    /**
     * @param string $domain
     * @return Pifa_FrontOffice_DataHelper_Pinba_Scripts
     */
    function setFilterDomain($domain)
    {
        $this->_filter['server_name'] = sprintf("server_name = '%s'", Pifa_Db::getDb()->quote($domain));
        return $this;
    }

    /**
     * @param string $server
     * @return Pifa_FrontOffice_DataHelper_Pinba_Scripts
     */
    function setFilterServer($server)
    {
        $this->_filter['hostname'] = sprintf("hostname = '%s'", Pifa_Db::getDb()->quote($server));
        return $this;
    }

    protected function _getSqlFilter()
    {
        return join(' AND ', array_values($this->_filter));
    }

}