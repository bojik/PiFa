<?php
class Pifa_FrontOffice_DataHelper_JsCssList extends Miao_Office_DataHelper_JsCssList
{
    /**
     *
     * @return Pifa_FrontOffice_DataHelper_JsCssList
     */
    static public function getInstance()
    {
        return parent::_getInstance( __CLASS__ );
    }

    public function js( $compress = false )
    {
        $fileList = $this->getResourceList( self::TYPE_JS );
        $fileList = $this->_client->getJs( $fileList, $compress );
        $result = $this->_makeLinks( $fileList );
        return $result;
    }

    public function css( $compress = false )
    {
        $fileList = $this->getResourceList( self::TYPE_CSS );
        $fileList = $this->_client->getCss( $fileList, $compress );
        $result = $this->_makeLinks( $fileList );
        return $result;
    }

    protected function __construct()
    {
        $minify = ( bool )Miao_Config::Libs( __CLASS__ )->get( 'minify' );
        $dhUrl = Pifa_FrontOffice_DataHelper_Url::getInstance();
        $dstFolder = Miao_Path::getDefaultInstance()->getModuleRoot( 'Pifa_FrontOffice' ) . '/public/static';

        parent::__construct( $dhUrl, $dstFolder, $minify );
    }

    protected function _init()
    {
        $this->_addResource( 'jquery-1.7.2.js', self::TYPE_JS );
        $this->_addResource( 'bootstrap.js', self::TYPE_JS );
        $this->_addResource( 'pifa/sql.js', self::TYPE_JS );
        $this->_addResource( 'caterjs.js', self::TYPE_JS );
        $this->_addResource( 'sprintf.js', self::TYPE_JS );
        $this->_addResource( 'highcharts/highcharts.js', self::TYPE_JS );
        $this->_addResource( 'jqgrid/jquery.jqGrid.min.js', self::TYPE_JS );
        $this->_addResource( 'jqgrid/i18n/grid.locale-ru.js', self::TYPE_JS );

        $this->_addResource( 'libs/Overview.js', self::TYPE_JS );
        $this->_addResource( 'libs/Helpers.js', self::TYPE_JS );
        $this->_addResource( 'libs/Data.js', self::TYPE_JS );
        $this->_addResource( 'libs/Graph.js', self::TYPE_JS );
        $this->_addResource( 'libs/PagesTab.js', self::TYPE_JS );

        $this->_addResource( 'widgets/GraphWidget.js', self::TYPE_JS );
        $this->_addResource( 'widgets/PagesTabWidget.js', self::TYPE_JS );

        $this->_addResource( 'pages/Main/__init__.js', self::TYPE_JS );
        $this->_addResource( 'pages/Main/Overview.js', self::TYPE_JS );

        $this->_addResource( 'pages/DomainInfo/__init__.js', self::TYPE_JS );
        $this->_addResource( 'pages/DomainInfo/Servers.js', self::TYPE_JS );

        $this->_addResource( 'pages/ServerInfo/__init__.js', self::TYPE_JS );
        $this->_addResource( 'pages/ServerInfo/Domains.js', self::TYPE_JS );

        // css
        $this->_addResource( 'skin/jquery-ui/jquery-ui-1.8.16.custom.css', self::TYPE_CSS );
        $this->_addResource( 'skin/jqgrid/ui.jqgrid.css', self::TYPE_CSS );
        $this->_addResource( 'skin/bootstrap.css', self::TYPE_CSS );
        $this->_addResource( 'skin/bootstrap-responsive.css', self::TYPE_CSS );
        $this->_addResource( 'skin/pifa.css', self::TYPE_CSS );

    }
}