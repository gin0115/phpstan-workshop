<?php

namespace Gin0115\PHPStan_Workshop\Arrays;

use Gin0115\PHPStan_Workshop\Arrays\Array_Template_File_Based;

defined( 'ABSPATH' ) || exit;

// phpcs:disable

/**
 * Test class for PHPStan array templates.
 *
 * @since   1.0.0
 * @version 1.0.0
 */
class Test {

	/**
	 * Testing the Array Template File Based class.
	 */
	public function template_array_valid(): void {
		$template = [
			'id' => 1,
			'name' => 'Test',
			'otherName' => 'Other Test',
		];

		$arrayTemplate = new Array_Template_File_Based( $template );

		echo $arrayTemplate->template['id']; // Should output 1.
		echo $arrayTemplate->template['name']; // Should output 'Test'.
		if ( isset( $arrayTemplate->template['otherName'] ) ) {
			echo $arrayTemplate->template['otherName']; // Should output 'Other Test'.
		}


	}
}
