<?php
class Pifa_FrontOffice_DataHelper_Url
	extends Miao_Office_DataHelper_Url
	implements Miao_Office_DataHelper_Url_Interface
{
	/**
	 *
	 * @return Miao_Office_DataHelper_Url
	 */
	static public function getInstance()
	{
		return parent::_getInstance( __CLASS__ );
	}

	protected function _init()
	{
		$config = Miao_Config::Libs( __CLASS__ );
		$this->setHost( $config->get( 'host' ) );
		$this->setPics( $config->get( 'pics' ) );
	}
}