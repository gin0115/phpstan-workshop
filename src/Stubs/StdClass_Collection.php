<?php declare( strict_types=1 );

namespace Gin0115\PHPStan_Workshop\Stubs;

defined( 'ABSPATH' ) || exit;

// phpcs:disable

/**
 * A simple collection class to demonstrate PHPStan Workshop concepts.
 *
 * Implements Iterable and ArrayAccess interfaces to allow iteration and array-like access.
 *
 * @template TValue of \stdClass
 * @implements \IteratorAggregate<int, TValue>
 * @implements \ArrayAccess<int, TValue>
 * @since   1.0.0
 * @version 1.0.0
 */
final class StdClass_Collection implements \IteratorAggregate, \ArrayAccess {

	/**
	 * @var array<\stdClass> The internal storage for the collection.
	 */
	private array $items = [];

	/**
	 * Adds an item to the collection.
	 *
	 * @param string $key The key for the item.
	 * @param \stdClass  $value The value of the item.
	 */
	public function add( string $key, \stdClass $value ): void {
		$this->items[ $key ] = $value;
	}

	/**
	 * Gets an item from the collection.
	 *
	 * @param string $key The key of the item to retrieve.
	 *
	 * @return \stdClass|null The value of the item or null if not found.
	 */
	public function get( string $key ): ?\stdClass {
		return $this->items[ $key ] ?? null;
	}

	/**
	 * @return \Traversable<int, \stdClass>
	 */
	public function getIterator(): \Traversable {
		return new \ArrayIterator( $this->items );
	}
	/**
	 * @inheritDoc
	 */
	public function offsetExists( mixed $offset ): bool {
		return isset( $this->items[ $offset ] );
	}
	/**
	 * @return \stdClass|null The value of the item or null if not found.
	 */
	public function offsetGet( mixed $offset ): mixed {
		return $this->items[ $offset ] ?? null;
	}
	/**
	 * @inheritDoc
	 */
	public function offsetSet( mixed $offset, mixed $value ): void {
		if ( ! $value instanceof \stdClass ) {
			throw new \InvalidArgumentException( 'Value must be an instance of \stdClass.' );
		}
		if ( null === $offset ) {
			$this->items[] = $value;
		} else {
			$this->items[ $offset ] = $value;
		}
	}
	/**
	 * @inheritDoc
	 */
	public function offsetUnset( mixed $offset ): void {
		if ( isset( $this->items[ $offset ] ) ) {
			unset( $this->items[ $offset ] );
		}
	}
	/**
	 * Returns the number of items in the collection.
	 *
	 * @return int The count of items.
	 */
	public function count(): int {
		return count( $this->items );
	}
	/**
	 * Checks if the collection is empty.
	 *
	 * @return bool True if the collection is empty, false otherwise.
	 */
	public function isEmpty(): bool {
		return 0 === $this->count();
	}
}