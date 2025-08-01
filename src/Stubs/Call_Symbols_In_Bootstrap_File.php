<?php declare( strict_types=1 );

namespace Gin0115\PHPStan_Workshop\Stubs;

defined( 'ABSPATH' ) || exit;

// phpcs:disable

/**
 * Showcasing how to a bootstrap local stub file can be used.
 *
 * @since   1.0.0
 * @version 1.0.0
 */
final class Call_Symbols_In_Bootstrap_File{

	/**
	 * Calls a method that takes a user array as a param.
	 *
	 * @return integer
	 */
	public function get_user_id(): int {
		$user = [
			'id'   => 42,
			'name' => 'Gin0115',
		];

		return some_user_function( $user ); // ✅
	}

	/**
	 * Calls the get user with the optional otherName parameter.
	 *
	 * @return integer
	 */
	public function get_user_id_with_optional(): int {
		$user = [
			'id'        => 42,
			'name'      => 'Gin0115',
			'otherName' => 'Gin0115 Other',
		];

		return some_user_function( $user ); // ✅
	}

	/**
	 * Calls a method that is defined in the bootstrap file, but with incorrect parameters.
	 *
	 * @return integer
	 */
	public function get_user_id_with_incorrect_params(): int {
		return some_user_function( true ); // ❌ This will throw an error as the parameter is not an array.
	}

	/**
	 * This method calls a class that is defined in the bootstrap file.
	 *
	 * @return string
	 */
	public function get_some_class_method(): string {
		$some_class = new \Gin0115\Some\Lib\SomeClass(); // ✅
		return $some_class->someMethod();  // ❌
	}

	/**
	 * This method calls a method on a class defined in the bootstrap file, but with incorrect parameters.
	 *
	 * @return string
	 */
	public function get_some_other_class_method(): string {
		$some_other_class = new \SomeOther\Lib\SomeOtherClass(); // ✅
		return $some_other_class->someOtherMethod(); // ✅
	}
}
