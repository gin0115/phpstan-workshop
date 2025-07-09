<?php declare( strict_types=1 );

namespace Gin0115\PHPStan_Workshop\Stubs;

defined( 'ABSPATH' ) || exit;

// phpcs:disable

/**
 * A simple typed stub
 *
 * @since   1.0.0
 * @version 1.0.0
 */
final class Some_Type{

	public function __construct(
		public int $id,
		public string $name,
		public ?string $description = null,
	) {}
}
