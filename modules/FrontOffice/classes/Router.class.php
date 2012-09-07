<?php
/**
 * Rewrites the _view param for routing
 *
 * @package Pifa
 * @subpackage FrontOffice_Router
 * @author Alexander Rodionov <avrodionov@rbc.ru>
 * $Id: Router.class.php 56870 2012-08-20 15:15:26Z avrodionov $
 */
class Pifa_FrontOffice_Router
{
    /**
     * If view is not set, it will use this one
     */
    const DEFAULT_VIEW = 'Main';

    /**
     * @var Pifa_FrontOffice_Router
     */
    static private $_instance = null;

    protected $_routingParams = array ();

    /**
     * @return Pifa_FrontOffice_Router
     */
    static function getInstance()
    {
        if ( !( self::$_instance instanceof self ) )
        {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function getParams()
    {
        return $this->_routingParams;
    }

    /**
     * It changes $_GET using Routes data
     */
    public function updateRequestParams()
    {
        $routes = Miao_Config::Libs(__CLASS__)->toArray();
        $uri = $this->_getRequestUri();
        foreach ( $routes['route'] as $route )
        {
            $routingParams = array ();
            if ( preg_match( '!^' . $route['url'] . '$!', $uri,  $routingParams) )
            {
                array_shift($routingParams);
                $this->_routingParams = $routingParams;

                if ( isset( $route['action'] ) )
                {
                    $_GET['_action'] = $route['action'];
                }
                else
                {
                    $_GET['_view'] = isset( $route['view'] ) ? $route['view'] : self::DEFAULT_VIEW;
                }
                if ( isset( $route['param'] ) )
                {
                    $params = $route['param'];
                    $request = Miao_Office_Request::getInstance();
                    if ( isset( $params[0] ) )
                    {
                        foreach ( $params as $param )
                        {
                            $request->setValueOf( $param['name'], $param['value'] );
                        }
                    }
                    else
                    {
                        $request->setValueOf( $params['name'], $params['value'] );
                    }
                }
                break;
            }
        }
    }

    protected function _getRequestUri()
    {
        $ret = $_SERVER['REQUEST_URI'];
        list( $ret ) = explode( '?', $ret );
        return $ret;
    }

}
