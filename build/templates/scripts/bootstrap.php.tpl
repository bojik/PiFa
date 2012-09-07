<?php
/**
 * Bootstrap file, include this file in all your php scripts
 */

/**
 * Register Miao autoload.
 * You can use glue miao in your prod platform
 * @param unknown_type $config
 */
function autoloadInit( $config )
{
	$isMinify = isset( $config[ 'use_glue' ] ) ? $config[ 'use_glue' ] : false;
	if ( !$isMinify )
	{
		require_once '#phing:libs.Miao.deploy.dst#/modules/Autoload/classes/Autoload.class.php';
	}
	else
	{
		$miaoFilename = '#phing:libs.Miao.deploy.dst#/scripts/miao.php';
		if ( file_exists( $miaoFilename ) )
		{
			require_once $miaoFilename;
		}
		else
		{
			$msg = sprintf( 'Run command from console: %s',  '#phing:libs.Miao.deploy.dst#/scripts/glue.php' );
			die( $msg );
		}
	}
}
$config = include '#phing:libs.Pifa.deploy.dst#/data/config_map.php';
autoloadInit( $config );

Miao_Autoload::register( $config['libs'] );
Miao_Path::register( $config );
Miao_Env::defaultRegister();
