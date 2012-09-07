<?php
/**
 * Pinba settings defined into mysql config
 *
 * @package Pifa
 * @subpackage FrontOffice_DataHelper_Pinba
 * @author Alexander Rodionov <avrodionov@rbc.ru>
 * $Id: Settings.class.php 55444 2012-07-11 09:47:33Z avrodionov $
 */
class Pifa_FrontOffice_DataHelper_Pinba_Settings
{
    const STATS_HISTORY = 'pinba_stats_history';
    const STATS_GETHERING_PERIOD = 'pinba_stats_gathering_period';
    const PORT = 'pinba_port';
    const ADDRESS = 'pinba_address';
    const TEMP_POOL_SIZE = 'pinba_temp_pool_size';
    const REQUEST_POOL_SIZE = 'pinba_request_pool_size';
    const TAG_REPORT_TIMEOUT = 'pinba_tag_report_timeout';

    static protected $_settings = null;

    /**
     * Returns all variables were set into mysql config
     *
     * @return array
     */
    static function getVars()
    {
        if ( is_null( self::$_settings ) )
        {
            $settings = Pifa_Db::getVariables();
            $reflection = new ReflectionClass( __CLASS__ );
            $consts = $reflection->getConstants();
            foreach ( $settings as $a )
            {
                foreach ( $consts as $const )
                {
                    if ( substr( $const, 0, 6 ) == 'pinba_' )
                    {
                        if ( $a['Variable_name'] == $const )
                        {
                            self::$_settings[$a['Variable_name']] = $a['Value'];
                        }
                    }
                }
            }
        }
        return self::$_settings;
    }

    /**
     * Returns the variable was set into mysql config
     *
     * @return string|null
     */
    static function getVar( $name )
    {
        $settings = self::getVars();
        return isset( $settings[$name] ) ? $settings[$name] : null;
    }
}
