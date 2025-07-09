<?php declare( strict_types=1 );

namespace Gin0115\PHPStan_Workshop\Basic_Types;

defined( 'ABSPATH' ) || exit;

// phpcs:disable

/**
 * Showcasing how to use primitive types in PHPStan Workshop.
 *
 * @since   1.0.0
 * @version 1.0.0
 */
final class Numbers{

	/**
	 * Im a method that can only accept an integer, but not as a type hint.
	 *
	 * @param integer $input The input integer.
	 *
	 * @return integer The processed integer.
	 */
	public function process_integer_dockblock( $input ) {
		return $input;
	}

	/**
	 * Im a method that can only accept an integer, but not as a type hint or dockblock.
	 *
	 * @param mixed $input The input integer.
	 *
	 * @return integer The processed integer.
	 */
	public function process_integer_no_type_hint( $input ) {
		if ( ! is_int( $input ) ) {
			throw new \InvalidArgumentException( 'Input must be an integer.' );
		}
		return $input;
	}

	/**
	 * Im a method that accepts either an integer or a float, but not as a type hint.
	 *
	 * @param integer|float $input The input number.
	 *
	 * @return integer|float The processed number.
	 */
	public function process_number_no_type_hint( $input ) {

		return $input;
	}

	/**
	 * Im a method only accepts an integer within a range.
	 *
	 * @param int<1, 10> $input The input integer.
	 *
	 * @return integer The processed integer.
	 */
	public function process_integer_range( int $input ): int {
		return $input;
	}

	/**
	 * Im a method that only accepts a positive integer.
	 *
	 * @param positive-int $input The input integer.
	 *
	 * @return positive-int The processed integer.
	 */
	public function process_positive_integer( int $input ): int {
		return $input;
	}

	/**
	 * Im a method that only accepts a negative integer.
	 *
	 * @param negative-int $input The input integer.
	 *
	 * @return int The processed integer.
	 */
	public function process_negative_int( $input ): int {
		return $input;
	}

	/**
	 * Im a method that only accepts a non zero integer.
	 *
	 * @param non-zero-int $input The input integer.
	 *
	 * @return int
	 */
	public function process_non_zero_int( int $input ): int {
		return $input;
	}

	/**
	 * Test the methods.
	 *
	 * @return void
	 */
	public function call_num_methods() {
		// Call with a valid type.
		echo $this->process_integer_dockblock( 2 ); // ✅
		echo $this->process_integer_no_type_hint( 'Hello, World!' ); // 🤷

		// Call with invalid type.
		echo $this->process_integer_dockblock( 2.5 ); // ❌
		echo $this->process_integer_no_type_hint( 2.5 ); // 🤷

		// Can process both integer and float.
		echo $this->process_number_no_type_hint( 2 ); // ✅
		echo $this->process_number_no_type_hint( 2.5 ); // ✅
		echo $this->process_number_no_type_hint( '2.5' ); // ❌

		// Call with a valid range.
		echo $this->process_integer_range( 5 ); // ✅
		echo $this->process_integer_range( 12 ); // ❌

		// Call with a positive integer.
		echo $this->process_positive_integer( 5 ); // ✅
		echo $this->process_positive_integer( -5 ); // ❌

		// Call with a negative float.
		echo $this->process_negative_int( -5 ); // ✅
		echo $this->process_negative_int( 5 ); // ❌

		// Call with a non zero integer.
		echo $this->process_non_zero_int( 5 ); // ✅
		echo $this->process_non_zero_int( 0 ); // ❌

		// This options might return anything, so cant be trusted.
		$some_value = phpstan_workshop_return_mixed('am integer option, trust me bro!');
		echo $this->process_non_zero_int($some_value); // ❌
	}
}