<?php
namespace Gin0115\PHPStan_Workshop\Arrays;

defined( 'ABSPATH' ) || exit;

// phpcs:disable
/**
 * Showcasing how to use file based array templates in PHPStan.
 *
 * @since   1.0.0
 * @version 1.0.0
 *
 * @template TemplatedArray as array{id: int, name: string, otherName?: string}
 */
class Array_Template_File_Based {

	/**
	 * Holds a template array.
	 *
	 * @var TemplatedArray
	 */
	public $template;

	/**
	 * Constructor.
	 *
	 * @since   1.0.0
	 * @version 1.0.0
	 *
	 * @param   TemplatedArray $template The template array.
	 */
	public function __construct( array $template ) {
		$this->template = $template;
	}

	/**
	 * @template OptionalArray as array{id: int, otherName: string}
	 * @param   OptionalArray $array The array to combine with the template.
	 * @return  string
	 */
	public function combine(array $array): string {
		return sprintf(
			'ID: %d, Name: %s, Other Name: %s',
			$array['id'] ?? 0,
			$this->template['name'] ?? 'N/A',
			$array['otherName'] ?? 'N/A'
		);
	}

	/**
	 * This is an example of using a template within another shape.
	 *
	 * @param array{id: int, user:TemplatedArray} $array The array to combine with the template.
	 * @return string
	 */
	public function do_thingy( array $array ): string {
		return sprintf(
			'%d (ID: %d, User Name: %s)',
			$array['id'] ?? 0,
			$array['user']['id'] ?? 0,
			$array['user']['name'] ?? 'N/A',
		);
	}

	/**
	 * This is a method that will use a type defined in the neon configuration.
	 *
	 * @param string $foo The foo parameter.
	 * @param string $bar The bar parameter.
	 *
	 * @return NeonFooBar
	 */
	public function use_neon_type( string $foo, string $bar ): array {
		return [
			'foo' => $foo,
			'bar' => $bar,
		];
	}

	/**
	 * This will fail if we try and use the OptionalArray which is defined on another method.
	 *
	 * @param OptionalArray $array The array to combine with the template.
	 * @return string
	 */
	public function fail_on_optional_array( array $array ): string {
		return sprintf(
			'ID: %d, Other Name: %s',
			$array['id'] ?? 0,
			$array['otherName'] ?? 'N/A'
		);
	}


}
