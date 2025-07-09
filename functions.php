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

/**
 * File that returns whatever is passed.
 *
 * @param T $input The input value to return.
 * @return T
 * @template T
 */
function phpstan_workshop_return_input( mixed $input ): mixed {
	return $input;
}

/**
 * Returns a mixed.
 *
 * @param mixed ...$inputs These do nothing.
 *
 * @phpstan-return int|string|float|bool|null|array<string>|array<string, string>|stdClass
 * @return mixed
 */
function phpstan_workshop_return_mixed( mixed ...$inputs ): mixed {
	$options = array(
		'string',
		1,
		1.0,
		true,
		array( 'list', 'of', 'strings' ),
		array( 'key' => 'value' ),
		new stdClass(),
		null,
	);
	return $options[ array_rand( $options ) ];
}

// endregion
