<?php
/**
 * Wrapper for pinba extension
 *
 * @package Pifa
 * @subpackage Pinba
 * @author Alexander Rodionov <avrodionov@rbc.ru>
 * $Id: Pinba.class.php 56406 2012-08-08 08:33:40Z avrodionov $
 */
class Pifa_Pinba
{
    /**
     * Set script name instead of $_SERVER['SCRIPT_NAME']
     *
     * @param string $scriptName
     *
     * @return boolean
     */
    static function setScriptName( $scriptName )
    {
        if ( !self::isExtensionInstalled() )
        {
            return false;
        }
        return pinba_script_name_set( $scriptName );
    }

    /**
     * Set $_SERVER['REQUEST_URI'] as script name instead of $_SERVER['SCRIPT_NAME']
     *
     * @return bool
     */
    static function useUrlScriptName()
    {
        return self::setScriptName( $_SERVER['REQUEST_URI'] );
    }

    /**
     * Returns true if extension is installed, false otherwise
     *
     * @return boolean
     */
    static function isExtensionInstalled()
    {
        return extension_loaded( 'pinba' );
    }

    /**
     * Return information about current request will be sent to pinba server
     *
     * @return array
     */
    static function getInfo()
    {
        if (!self::isExtensionInstalled()){
            return array ();
        }
        return pinba_get_info();
    }

}
