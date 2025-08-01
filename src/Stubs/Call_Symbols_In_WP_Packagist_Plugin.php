<?php declare( strict_types=1 );

namespace Gin0115\PHPStan_Workshop\Stubs;

defined( 'ABSPATH' ) || exit;

// phpcs:disable

/**
 * Showcasing how to use wp-packagist plugin stubs.
 *
 * @since   1.0.0
 * @version 1.0.0
 */
final class Call_Symbols_In_WP_Packagist_Plugin {

	/**
	 * This method calls a function that is defined in contact-form-7 plugin stubs.
	 *
	 * @return void
	 */
	public function cf7_function_call(): void {
		if ( wpcf7_include_module_file( 'contact-form-7' ) ) {
			// Do something with the contact form
		}
	}

	/**
	 * This method calls a class that is defined in the contact-form-7 plugin stubs.
	 *
	 * @return void
	 */
	public function cf7_class_call(): void {
		$pipe = new \WPCF7_Pipe('hello|world');
		print $pipe->before;
		print $pipe->after;
	}

	/**
	 * This method uses a constant that is defined in the contact-form-7 plugin stubs.
	 *
	 * @return string
	 */
	public function cf7_constant_call(): string {
		return \WPCF7_VERSION;
	}
}
