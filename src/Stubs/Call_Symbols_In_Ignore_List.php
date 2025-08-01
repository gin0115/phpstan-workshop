<?php declare( strict_types=1 );

namespace Gin0115\PHPStan_Workshop\Stubs;

defined( 'ABSPATH' ) || exit;

// phpcs:disable

/**
 * Showcasing how to supress errors to get around issues with symbols in the ignore list.
 *
 * @since   1.0.0
 * @version 1.0.0
 */
final class Call_Symbols_In_Ignore_List {

	/**
	 * This method calls a function that is defined in the ignore list.
	 *
	 * @return string
	 */
	public function get_ignored_function(): string {
		return some_ignored_function();
	}

	/**
	 * This method calls a class that is defined in the ignore list.
	 *
	 * @return string
	 */
	public function get_ignored_class(): string {
		$ignored_class = new \Ignored_Class();
		return $ignored_class->get_ignored_method();
	}

	/**
	 * This method calls a function that is not defined in the ignore list.
	 *
	 * @return string
	 */
	public function get_non_ignored_function(): string {
		return some_non_ignored_function();
	}
}
