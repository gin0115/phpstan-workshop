<?php declare( strict_types=1 );

namespace Gin0115\PHPStan_Workshop\Basic_Types;

use Gin0115\PHPStan_Workshop\Stubs\Some_Collection;
use Gin0115\PHPStan_Workshop\Stubs\Some_Type;
use Gin0115\PHPStan_Workshop\Stubs\StdClass_Collection;

defined( 'ABSPATH' ) || exit;

// phpcs:disable

/**
 * Showcasing how to use primitive types in PHPStan Workshop.
 *
 * @since   1.0.0
 * @version 1.0.0
 */
final class Iterables {

	/**
	 * Im a method that accepts a an array of strings, but not as a type hint.
	 *
	 * @param string[] $input The input list of strings.
	 *
	 * @return string
	 */
	public function process_array_of_strings( $input ) {
		return 'a';
	}


	/**
	 * Im a method that accepts an array of string with string keys.
	 *
	 * @param array<string, string> $input The input array of strings with string keys.
	 *
	 * @return string
	 */
	public function process_array_of_strings_with_string_indexes( $input ) {
		return 'b';
	}

	/**
	 * Im a method that only accepts filled array of strings.
	 *
	 * @param non-empty-array<string> $input The input array.
	 *
	 * @return string
	 */
	public function process_non_empty_array_of_strings( $input ): string {
		return 'c';
	}

	/**
	 * Only accepts a list of strings.
	 *
	 * @param list<string> $input The input list of strings.
	 *
	 * @return string
	 */
	public function process_list_of_strings( array $input ): string {
		return 'd';
	}

	/**
	 * Im a method that only accepts a Collection of Some_Type instances.
	 *
	 * @param iterable<Some_Type> $input The input collection of Some_Type instances.
	 */
	public function process_collection_of_some_type( $input ): string {
		return 'e';
	}

	/**
	 * Call the methods to check.
	 *
	 * @return void
	 */
	public function check(): void {
		// Accept  array of string.
		echo $this->process_array_of_strings( [ 'a', 'b', 'c' ] ); // ✅
		echo $this->process_array_of_strings( [ 1,2,3 ] ); // ❌
		// Its ok with mixed indexes types
		echo $this->process_array_of_strings( [ 34 => 'a', 45 => 'b', 877 => 'c' ] ); // ✅
		echo $this->process_array_of_strings( [ 'a' => 'b', 'c' => 'd' ] ); // ✅
		echo $this->process_array_of_strings( [ 'a' => 'a', 2 => 'b', 'c' ] ); //  ✅


		// Accept array of string with string keys. (use a list for int only)
		echo $this->process_array_of_strings_with_string_indexes( [ 'a' => 'b', 'c' => 'd' ] ); // ✅
		echo $this->process_array_of_strings_with_string_indexes( [ 1 => 'b', 2 => 'c' ] ); // ❌
		echo $this->process_array_of_strings_with_string_indexes( [ 'a' => 1, 'b' => 2 ] ); // ❌

		// Accept non-empty array of strings.
		echo $this->process_non_empty_array_of_strings( [ 'a', 'b', 'c' ] ); // ✅
		echo $this->process_non_empty_array_of_strings( [] ); // ❌
		echo $this->process_non_empty_array_of_strings( [ 'a', 1, 'c' ] ); // ❌

		// Accept list of strings.
		echo $this->process_list_of_strings( [ 'a', 'b', 'c' ] ); // ✅
		echo $this->process_list_of_strings( [ 'a' => 'a', 'b', 'c' ] ); // ❌

		// Accept collection of Some_Type.
		$collection = new Some_Collection();
		$collection->add( 'key1', new Some_Type(1, 'value1' ) );
		$collection->add( 'key2', new Some_Type(2, 'value2' ) );
		echo $this->process_collection_of_some_type( $collection ); // ✅
		echo $this->process_collection_of_some_type( [ new Some_Type(1,'a'), new Some_Type(2,'b') ] ); // ✅
		echo $this->process_collection_of_some_type( new \ArrayIterator( [ new Some_Type(1,'a'), new Some_Type(2,'b') ] ) ); // ✅

		// Fail if the collection is not of Some_Type.
		$invalid_collection = new StdClass_Collection();
		$invalid_collection->add( 'key1', new \stdClass() );
		$invalid_collection->add( 'key2', new \stdClass() );
		echo $this->process_collection_of_some_type( $invalid_collection ); // ❌
		echo $this->process_collection_of_some_type( [ new \stdClass(), new \stdClass() ] ); // ❌
		echo $this->process_collection_of_some_type( new \ArrayIterator( [ new \stdClass(), new \stdClass() ] ) ); // ❌
	}

}