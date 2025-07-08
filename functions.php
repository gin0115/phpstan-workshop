<?php declare( strict_types=1 );

use Gin0115\PHPStan_Workshop\Plugin;

defined( 'ABSPATH' ) || exit;

// region META

/**
 * Returns the plugin's main class instance.
 *
 * @since   1.0.0
 * @version 1.0.0
 *
 * @return  Plugin
 */
function phpstan_workshop_get_plugin_instance(): Plugin {
	return Plugin::get_instance();
}

// endregion

// region OTHERS

$phpstan_workshop_files = glob( constant( 'GIN0115_PHPSTAN_WS_DIR_PATH' ) . 'includes/*.php' );
if ( false !== $phpstan_workshop_files ) {
	foreach ( $phpstan_workshop_files as $phpstan_workshop_file ) {
		if ( 1 === preg_match( '#/includes/_#i', $phpstan_workshop_file ) ) {
			continue; // Ignore files prefixed with an underscore.
		}

		require_once $phpstan_workshop_file;
	}
}

// endregion
