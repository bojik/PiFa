<?php
/**
 * Generates json of urls for grid
 *
 * @package Pifa
 * @subpackage FrontOffice_Action_Json
 * @author Alexander Rodionov <avrodionov@rbc.ru>
 * $Id: Urls.class.php 57675 2012-09-06 11:14:19Z avrodionov $
 */
class Pifa_FrontOffice_Action_Json_Urls extends Pifa_FrontOffice_Action_Json
{
    /**
     * Returns array of values for json response
     *
     * @return array
     */
    protected function _getData()
    {
        $request = Miao_Office_Request::getInstance();
        $page = $request->getValueOf( 'page', 1 );
        $limit = $request->getValueOf( 'rows', 10 );
        $sortField = $request->getValueOf( 'sidx', 'script_name' );
        $sortDirection = $request->getValueOf( 'sord', 'asc' );

        $helper = new Pifa_FrontOffice_DataHelper_Pinba_Scripts();
        $helper->setOrderBy( $sortField, strtolower( $sortDirection ) != 'desc' );
        $a = $helper->getRows( $limit, ( $page - 1 ) * $limit );
        $rows = array();
        $i = 0;
        foreach ( $a as $r )
        {
            $rows[] = array(
                'id' => $i + $page * $limit,
                'cell' => array(
                    $r['script_name'],
                    $r['hostname'],
                    $r['server_name'],
                    $r['req_count'],
                    $r['req_per_sec'],
                )
            );
            $i++;
        }
        $total = $helper->getTotal();
        $totalPages = ceil($total/$limit);
        $ret = array(
            'page' => $page,
            'total' => $totalPages,
            'records' => intval( $total ),
            'rows' => $rows,
        );
        return $ret;
    }

}
