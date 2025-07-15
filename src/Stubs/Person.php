<?php declare( strict_types=1 );

namespace Gin0115\PHPStan_Workshop\Stubs;

defined( 'ABSPATH' ) || exit;

// phpcs:disable

/**
 * A simple person stub
 *
 * @since   1.0.0
 * @version 1.0.0
 */
class Person {

	public function __construct(
		public int $id,
		public string $name,
	) {}

	/**
	 * Get the person's name.
	 *
	 * @return string
	 */
	public function get_name(): string {
		return $this->name;
	}

	/**
	 * Get the person's ID.
	 *
	 * @return int
	 */
	public function get_id(): int {
		return $this->id;
	}
}