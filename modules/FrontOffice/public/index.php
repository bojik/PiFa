<?php
require realpath( dirname( __FILE__ ) . '/../../../' ) . '/scripts/bootstrap.php';
try
{
    Pifa_Pinba::useUrlScriptName();
    $request = Miao_Office_Request::getInstance();
    Pifa_FrontOffice_Router::getInstance()->updateRequestParams();
    $params = $_GET;

	$factory = new Miao_Office_Factory( array( 'defaultPrefix' => 'Pifa_FrontOffice' ) );
	$fo = $factory->getOffice( $params, array( '_view' => 'Main' ) );
	$fo->sendResponse( false );
}
catch ( Exception $e )
{
	 // --- dump ---
	echo '<pre>';
	echo __FILE__ . chr( 10 );
	echo __METHOD__ . chr( 10 );
	echo $e->getMessage();
	echo '</pre>';
	// --- // ---
}
