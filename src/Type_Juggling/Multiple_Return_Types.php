<?php declare(strict_types=1);
namespace Gin0115\PHPStan_Workshop\Type_Juggling;

defined( 'ABSPATH' ) || exit;

// phpcs:disable
/**
 * Showcasing how to juggle types in PHPStan.
 *
 * @since   1.0.0
 * @version 1.0.0
 */
class Multiple_Return_Types {

	/**
	 * Call the methods to get all posts id from a query.
	 *
	 * @return void
	 */
	public function run_posts_as_ids(): void {
		$posts = $this->get_posts_as_ids(
			array(
				'fields' => 'objects',
				'post_type' => 'post'
			)
		);

		foreach ( $posts as $post ) {
			// Do something with each post ID.
			echo "Post ID: " . absint( $post ) . "<br>";
		}
	}


	/**
	 * In this method we show how you can juggle multiple return types.
	 *
	 * @return void
	 */
	public function get_post_ids(): void {
		// This method returns an array of post IDs.
		$post_ids = $this->get_posts_as_posts( [ 'post_type' => 'post' ] );

		foreach ( $post_ids as $post ) {
			// Do something with each post ID.
			echo "Post ID: " . absint( $post->ID ) . "<br>";
		}
	}

	/**
	 * Run creating a post and returning it, while asserting the type.
	 *
	 * @return void
	 */
	public function run_example_of_type_narrowing_with_assert(): void {
		$post = $this->example_of_type_narrowing_with_assert();
		echo $post->post_title . '<br>';
	}


	/**
	 * This method shows how you can use @var to force a type in PHPStan.
	 *
	 * @return void
	 */
	public function decode_and_use_json(): void {
	$name = 'Alice';
		$json = json_encode(['name' => $name, 'age' => 30]);

		if ($json === false) {
			// json_encode failed, handle the error or return early
			return;
		}

		$data = json_decode($json, true);

		if (!is_array($data)) {
			return;
		}

		/** @var array{name: string, age: int, other?: mixed} $data */
		echo 'Name: ' . $data['name'] . ', Age: ' . $data['age'] . ( isset($data['other']) ? ', Other: ' . $data['other'] : '') . '<br>';
	}


	/**
	 * Do a WP_Query and return the results as Posts
	 *
	 * @param array<string, mixed> $args
	 *
	 * @return \WP_Post[]
	 */
	public function get_posts_as_posts( array $args ): array {
		$query = new \WP_Query( $args );


		if ( ! $query->have_posts() ) {
			return [];
		}

		$posts = $query->posts;

		// Here we juggle the return type to ensure it is always an array of WP_Post objects.
		$posts = array_map(
			function ( $post ) {
				if ( ! $post instanceof \WP_Post ) {
					$post = get_post( absint( $post ) );
					// If post is still not a WP_Post, return null.
					if ( ! $post instanceof \WP_Post ) {
						return null;
					}
				}
				return $post;
			},
			$posts
		);
		// Remove any null values from the array.
		$posts = array_filter( $posts );

		return $posts;
	}

	/**
	 * Do a WP_Query and return the results as IDs.
	 *
	 * @param array<string, mixed> $args
	 *
	 * @return int[]
	 */
	public function get_posts_as_ids( array $args ): array {
		// Force the field 'fields' to 'ids' to ensure we get an array of IDs.
		$args['fields'] = 'ids'; // <-- PHPSTAN WILL NOT UNDERSTAND THIS LINE


		$query = new \WP_Query( $args );

		if ( ! $query->have_posts() ) {
			return [];
		}

		// Like the post one above we need to ensure the type is correct before we return.

		return $query->posts;
	}

	/**
	 * This is an example of using the type juggling in PHPStan.
	 *
	 * @return \WP_Post|null
	 */
	public function example_of_type_narrowing_with_assert(): ?\WP_Post {
		// Lets create a post.
		$post_id = wp_insert_post(
			array(
				'post_title'   => 'Example Post',
				'post_content' => 'This is an example post.',
				'post_status'  => 'publish',
				'post_type'    => 'post',
			),
			true // This will return a \WP_Error on failure.
		);

		if($this->is_error( $post_id )) {
			// If we have an error, we return null.
			return null;
		}

		// Assert that the post ID is an integer.
		assert( is_int( $post_id ) );

		// If we have a valid post ID, let's return the post object.
		return get_post( $post_id );
	}

	/**
	 * Helper function to check if something is an error.
	 *
	 * @param mixed $value
	 *
	 * @return bool
	 */
	public function is_error( $value ): bool {
		if(is_string($value)){
			return false;
		}

		if(\is_numeric($value)) {
			return false;
		}

		if ( \is_array( $value ) ) {
			return false;
		}

		if(is_null($value)) {
			return false;
		}

		$class_name = 'WP' . '_' . 'Error';
		if ( $value instanceof $class_name ) {
			return true;
		}

		return false;
	}


}
