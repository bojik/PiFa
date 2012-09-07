<?php
class Pifa_FrontOffice_View extends Miao_Office_View
{
    /**
     * Defined js auto start object
     * @var string
     */
    protected $_jsAutoStart = '';

	protected function _initializeBlock()
	{
		$this->_addBlock( 'Scripts', array(
			'Pifa_FrontOffice_ViewBlock_Static',
            array ('js') ), array( 'js.tpl' ) );

		$this->_addBlock( 'Styles', array(
			'Pifa_FrontOffice_ViewBlock_Static',
			array( 'css' ) ), array( 'js.tpl' ) );

        $this->setTmplVars('jsAutoStart', $this->_jsAutoStart);

        $this->_addBlock( 'PinbaSettings', 'Pifa_FrontOffice_ViewBlock_Settings');
    }
}