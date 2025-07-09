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
final class Strings {

	/**
	 * Im a method that only acceopts a string, but not as a type hint.
	 *
	 * @param string $input The input string.
	 *
	 * @return string The processed string.
	 */
	public function process_string_dockblock( $input ) {
		return $input;
	}

	/**
	 * Im a method that only accepts a string, but not as a type hint or dockblock.
	 *
	 * @param mixed $input The input string.
	 *
	 * @return string The processed string.
	 */
	public function process_string_no_type_hint( $input ) {
		if ( ! is_string( $input ) ) {
			throw new \InvalidArgumentException( 'Input must be a string.' );
		}
		return $input;
	}

	/**
	 * Im a method tht only allows the string 'mint'
	 *
	 * @param 'mint' $input The input string.
	 *
	 * @return 'mint' The processed string.
	 */
	public function process_string_mint( $input ): string {
		if ( $input !== 'mint' ) {
			throw new \InvalidArgumentException( 'Input must be "mint".' );
		}
		return $input;
	}

	/**
	 * Im a method that accepts a string from a selection of strings.
	 *
	 * @param 'wide'|'normal'|'thin' $size The input string.
	 *
	 * @return string The processed string.
	 */
	public function process_string_size( string $size ): string {
		return $size;
	}

	/**
	 * Im a method that only accepts a string name of a class.
	 *
	 * @param class-string<\DateTime>|class-string<\DateTimeImmutable> $class_name The name of the class.
	 *
	 * @return boolean
	 */
	public function is_date_class( string $class_name ): bool {
		return in_array( $class_name, [ \DateTime::class, \DateTimeImmutable::class ], true );
	}

	/**
	 * Is a method that only allows an non empty string.
	 *
	 * @param non-empty-string $input The input string.
	 *
	 * @return non-empty-string The processed string.
	 */
	public function process_non_empty_string( string $input ): string {
		return $input;
	}

	/**
	 * Im a method that only accepts a callable string.
	 *
	 * @param callable-string $callback The callback string.
	 * @param array<mixed> $args The arguments to pass to the callback.
	 *
	 * @return mixed The result of the callback.
	 */
	public function call_string_callback( string $callback, array $args = [] ) {
		return call_user_func_array( $callback, $args );
	}

	/**
	 * Im a method that allows 2 numerical strings to be added.
	 *
	 * @param numeric-string $a The first number.
	 * @param numeric-string $b The second number.
	 *
	 * @return integer|float The sum of the two numbers.
	 */
	public function add_numeric_strings( string $a, string $b ): float|int {
		return $a + $b;
	}

	/**
	 * Calls our string methods.
	 *
	 * @return void
	 */
	public function call_string_methods(): void {
		// Call with a valid type.
		echo $this->process_string_dockblock( 'Hello, World!' ); // ✅
		echo $this->process_string_no_type_hint( 'Hello, World!' ); // 🤷

		// Call with an invalid type.
		echo $this->process_string_dockblock( 123 ); // ❌
		echo $this->process_string_no_type_hint( 123 ); // 🤷

		// Call with a specific string.
		echo $this->process_string_mint( 'mint' ); // ✅.
		echo $this->process_string_mint( 'apple' ); // ❌

		// Call with a specific size.
		echo $this->process_string_size( 'wide' ); // ✅.
		echo $this->process_string_size( 'normal' ); // ✅.
		echo $this->process_string_size( 'thin' ); // ✅.
		echo $this->process_string_size( 'extra-wide' ); // ❌

		// Call with a class name.
		echo $this->is_date_class( \DateTime::class ) ? 'Valid.' : 'Invalid'; // ✅
		echo $this->is_date_class( \DateTimeImmutable::class ) ? 'Valid' : 'Invalid'; // ✅
		echo $this->is_date_class( get_class( new \DateTime() ) ) ? 'Valid' : 'Invalid'; // ✅
		echo $this->is_date_class( \stdClass::class ) ? 'Valid class.' : 'Invalid class.'; // ❌

		// Non empty string.
		echo $this->process_non_empty_string( 'This is a non-empty string.' ); // ✅.
		echo $this->process_non_empty_string( '' ); // ❌
		// Randomly call with a string or empty.
		echo $this->process_non_empty_string( boolval(rand( 0, 1 )) ? 'Random String' : '' ); // ❌

		// Call with a callable string.
		echo $this->call_string_callback( 'strtoupper', [ 'hello world' ] ); // ✅
		echo $this->call_string_callback( 'non_existent_function', [] ); // ❌

		// Call with numeric strings.
		echo $this->add_numeric_strings( '10', '20' ); // ✅
		echo $this->add_numeric_strings( '10.5', '20.5' ); // ✅
		echo $this->add_numeric_strings( '10', 'twenty' ); // ❌
	}
}
