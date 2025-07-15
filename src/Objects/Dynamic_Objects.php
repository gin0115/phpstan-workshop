<?php declare( strict_types=1 );

namespace Gin0115\PHPStan_Workshop\Objects;

use Gin0115\PHPStan_Workshop\Stubs\Person;

defined( 'ABSPATH' ) || exit;

// phpcs:disable

/**
 * Showcasing how to use dynamic objects in PHPStan Workshop.
 *
 * @since   1.0.0
 * @version 1.0.0
 *
 * Define a custom shape for a PersonLike object that has an id and name property.
 * @phpstan-type PersonLike = object{id: int, name: string}
 */
final class Dynamic_Objects{

	/**
	 * This methods only accepts an object with an id and name property.
	 *
	 * @param object{id: int, name: string} $input The input object.
	 *
	 * @return string
	 */
	public function process_object_with_properties( object $input ): string {
		return sprintf( 'ID: %d, Name: %s', $input->id, $input->name );
	}

	/**
	 * This method accepts a PersonLike object.
	 *
	 * @param PersonLike $input The input object.
	 *
	 * @return string
	 */
	public function process_person_like( object $input ): string {
		return sprintf( 'ID: %d, Name: %s', $input->id, $input->name );
	}



	/**
	 * Call the methods to test.
	 *
	 * @return void
	 */
	public function test_methods(): void {
		// Object With properties.
		echo $this->process_object_with_properties( (object)['id' => 12, 'name' => 'Glynn'] ); // ✅
		echo $this->process_object_with_properties( new Person(1, 'Glynn') ); // ✅
		echo $this->process_object_with_properties( (object)['id' => 1, 'noname' => 'John'] ); // ❌

		// This will not work with stdClass
		$instance = new \stdClass();
		$instance->id   = 1;
		$instance->name = 'John';
		echo $this->process_object_with_properties( new \stdClass() ); // ❌

		// You should be able to pass any object that has the required properties, to a PersonLike
		$this->process_person_like( (object)['id' => 1, 'name' => 'John'] ); // ✅
		$this->process_person_like( new Person(1, 'John') ); // ✅



	}
}