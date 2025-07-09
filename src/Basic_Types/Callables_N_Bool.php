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
final class Callables_N_Bool{

	/**
	 * Im a method that accepts only true.
	 *
	 * @param true $input The input boolean.
	 *
	 * @return true The processed boolean.
	 */
	public function process_true( $input ): bool {
		return $input;
	}

	/**
	 * Im a method that accepts only false.
	 *
	 * @param false $input The input boolean.
	 *
	 * @return false The processed boolean.
	 */
	public function process_false( $input ): bool {
		return $input;
	}

	/**
	 * Im a method that accepts either true or null
	 *
	 * @param true|null $input The input boolean.
	 *
	 * @return true|null The processed boolean.
	 */
	public function process_true_or_null( ?bool $input ): ?bool {
		return $input;
	}

	/**
	 * Im a method that accepts a callable that takes a string as an arg and returns boolean.
	 *
	 * @param callable(string):bool $callback The callback function.
	 *
	 * @return string
	 */
	public function process_callback( callable $callback ): string {
		return 'done';
	}

	/**
	 * Im a method that accepts a callable that takes a string as an arg, a second option int arg and returns a string.
	 *
	 * @param callable(string, int=):string $callback The callback function.
	 *
	 * @return string
	 */
	public function process_callback_with_optional_arg( callable $callback ): string {
		return 'done with default';
	}

	/**
	 * Im a method that only allows a Closure string that takes a mixed value and returns an int.
	 *
	 * @param \Closure(mixed):int $callback The callback string.
	 *
	 * @return int The result of the callback.
	 */
	public function process_callable_string( callable $callback ): int {
		return 42; // Just a placeholder return value.
	}

	/**
	 * Im a method that only allows callables that are pure.
	 *
	 * @param pure-callable(string): string $callback The callback function.
	 *
	 * @return string
	 */
	public function process_pure_callable( callable $callback ): string {
		return 'pure done';
	}

	/**
	 * Im a method that is a bottom type.
	 *
	 * I never return, you can use the following types.
	 *  - never
	 *  - never-return
	 *  - never-returns
	 *  - no-return
	 *
	 * @return never
	 */
	public function process_never(): never {
		throw new \RuntimeException( 'This method never returns.' );
	}

	/**
	 * Another example of a method that is a bottom type.
	 *
	 * @return no-return
	 */
	public function process_no_return() {
		\wp_safe_redirect('https://example.com');
		exit; // This will stop the script execution, making it a no-return method.
	}

	/**
	 * Call the methods to test.
	 *
	 * @return void
	 */
	public function test_methods(): void {
		// True only
		echo $this->process_true( true ); // ✅
		echo $this->process_true( false ); // ❌

		// False only
		echo $this->process_false( false ); // ✅
		echo $this->process_false( true ); // ❌

		// True or null
		echo $this->process_true_or_null( true ); // ✅
		echo $this->process_true_or_null( null ); // ✅
		echo $this->process_true_or_null( false ); // ❌

		// Callback
		echo $this->process_callback( fn(string $e): bool => $e === 'test' ); // ✅
		echo $this->process_callback( fn(int $e): bool => $e > 0 ); // ❌

		// Callback with optional 2nd arg.
		echo $this->process_callback_with_optional_arg( fn(string $e, int $i = 0): string => 'a'  ); // ✅
		echo $this->process_callback_with_optional_arg( fn(string $e): string => 'a'); // ✅
		echo $this->process_callback_with_optional_arg( fn(int $e): string => 'a' ); // ❌
		echo $this->process_callback_with_optional_arg( fn(string $e, float $i): string => 'a' ); // ❌

		// Callable string
		echo $this->process_callable_string( fn($e) => 1 ); // ✅
		echo $this->process_callable_string( 'absint' ); // ❌
		echo $this->process_callable_string( 'wp_strip_all_tags' ); // ❌

		// Pure callable
		echo $this->process_pure_callable( fn(string $e): string => 'pure' ); // ✅
		echo $this->process_pure_callable( fn(string $e) => get_bloginfo( 'name' ) ); // ❌

	}
}