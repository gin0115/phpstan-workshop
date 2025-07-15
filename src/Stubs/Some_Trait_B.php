<?php declare( strict_types=1 );

namespace Gin0115\PHPStan_Workshop\Stubs;

defined( 'ABSPATH' ) || exit;

// phpcs:disable

/**
 * A simple trait stub
 *
 * @since   1.0.0
 * @version 1.0.0
 */
trait Some_Trait_B {
	/**
	 * A method that returns a string.
	 *
	 * @return string
	 */
	public function get_string(): string {
		return 'Hello from Some_Trait_A';
	}

	/**
	 * A method that returns an integer.
	 *
	 * @return int
	 */
	public function get_integer(): int {
		return 42;
	}
}