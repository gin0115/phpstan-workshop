<?php
/**
 * The PHPStan Workshop bootstrap file.
 *
 * @since       1.0.0
 * @version     1.0.0
 * @package     A8C\SpecialProjects\Plugins
 * @author      WordPress.com Special Projects
 * @license     GPL-3.0-or-later
 *
 * @noinspection    ALL
 *
 * @wordpress-plugin
 * Plugin Name:             PHPStan Workshop
 * Plugin URI:              https://wpspecialprojects.wordpress.com
 * Description:             A sample project to see how to work with PHPStan in WP projects
 * Version:                 1.0.0
 * Requires at least:       6.7
 * Tested up to:            6.7
 * Requires PHP:            8.3
 * Author:                  WordPress.com Special Projects
 * Author URI:              https://wpspecialprojects.wordpress.com
 * License:                 GPL v3 or later
 * License URI:             https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:             phpstan-workshop
 * Domain Path:             /languages
 * WC requires at least:    9.5
 * WC tested up to:         9.5
 **/

defined( 'ABSPATH' ) || exit;

// Define plugin constants.
define( 'GIN0115_PHPSTAN_WS_BASENAME', plugin_basename( __FILE__ ) );
define( 'GIN0115_PHPSTAN_WS_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'GIN0115_PHPSTAN_WS_DIR_URL', plugin_dir_url( __FILE__ ) );

// Load the rest of the bootstrap functions.
require_once GIN0115_PHPSTAN_WS_DIR_PATH . '/functions-bootstrap.php';

// Load plugin translations so they are available even for the error admin notices.
add_action(
	'init',
	static function () {
		load_plugin_textdomain(
			phpstan_workshop_get_plugin_metadata( 'TextDomain' ),
			false,
			dirname( GIN0115_PHPSTAN_WS_BASENAME ) . phpstan_workshop_get_plugin_metadata( 'DomainPath' )
		);
	}
);

// Declare compatibility with WC features.
add_action(
	'before_woocommerce_init',
	static function () {
		if ( class_exists( \Automattic\WooCommerce\Utilities\FeaturesUtil::class ) ) {
			\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );
		}
	}
);

// Load the autoloader.
if ( ! is_file( GIN0115_PHPSTAN_WS_DIR_PATH . '/vendor/autoload.php' ) ) {
	phpstan_workshop_output_requirements_error( new WP_Error( 'missing_autoloader' ) );
	return;
}
require_once GIN0115_PHPSTAN_WS_DIR_PATH . '/vendor/autoload.php';

// Bootstrap the plugin (maybe)!
define( 'GIN0115_PHPSTAN_WS_REQUIREMENTS', phpstan_workshop_validate_requirements() );
if ( is_wp_error( GIN0115_PHPSTAN_WS_REQUIREMENTS ) ) {
	phpstan_workshop_output_requirements_error( GIN0115_PHPSTAN_WS_REQUIREMENTS );
} else {
	require_once GIN0115_PHPSTAN_WS_DIR_PATH . '/functions.php';
	add_action( 'plugins_loaded', array( phpstan_workshop_get_plugin_instance(), 'maybe_initialize' ) );
}
