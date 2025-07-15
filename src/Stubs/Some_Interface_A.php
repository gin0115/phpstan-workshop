<?php declare( strict_types=1 );

namespace Gin0115\PHPStan_Workshop\Stubs;

defined( 'ABSPATH' ) || exit;

// phpcs:disable

/**
 * A sample interface stub
 *
 * @since   1.0.0
 * @version 1.0.0
 */
interface Some_Interface_A {
	/**
	 * A method that returns a string.
	 *
	 * @return string
	 */
	public function get_string(): string;

	/**
	 * A method that returns an integer.
	 *
	 * @return int
	 */
	public function get_integer(): int;

	/**
	 * A method that accepts a string and returns a boolean.
	 *
	 * @param string $input The input string.
	 * @return bool
	 */
	public function process_string( string $input ): bool;
}
// phpcs:enable