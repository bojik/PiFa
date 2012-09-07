<?php
/**
 * Wrapper for pinba timer functions
 *
 * @package Pifa
 * @subpackage Pinba_Timer
 * @author Alexander Rodionov <avrodionov@rbc.ru>
 * $Id: Timer.class.php 56406 2012-08-08 08:33:40Z avrodionov $
 */
class Pifa_Pinba_Timer
{
    /**
     * @var resource
     */
    protected $_resource = null;

    /**
     * @var array
     */
    protected $_tags;

    /**
     * @var array
     */
    protected $_data;

    /**
     * @param array $tags
     * @param array $data
     */
    function __construct( array $tags, array $data = array() )
    {
        $this->_tags = $tags;
        $this->_data = $data;
    }

    /**
     * Starts timer
     * @return bool
     */
    function start()
    {
        if ( !$this->_isExtensionInstalled() )
        {
            return false;
        }
        $this->_resource = pinba_timer_start( $this->_tags, $this->_data );
        return true;
    }

    /**
     * Stops timer
     * @return bool
     */
    function stop()
    {
        if ( !$this->_isExtensionInstalled() || is_null($this->_resource) )
        {
            return false;
        }
        return pinba_timer_stop( $this->_resource );
    }

    /**
     * Deletes timer
     * @return bool
     */
    function delete()
    {
        if ( !$this->_isExtensionInstalled() || is_null($this->_resource) )
        {
            return false;
        }
        return pinba_timer_delete( $this->_resource );
    }

    /**
     * Returns information
     * @return array
     */
    function getInfo()
    {
        if ( !$this->_isExtensionInstalled() || is_null($this->_resource) )
        {
            return array();
        }
        return pinba_timer_get_info($this->_resource);
    }

    protected function _isExtensionInstalled()
    {
        return Pifa_Pinba::isExtensionInstalled();
    }
}
