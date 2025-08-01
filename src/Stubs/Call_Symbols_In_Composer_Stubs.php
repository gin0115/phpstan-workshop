<?php declare( strict_types=1 );

namespace Gin0115\PHPStan_Workshop\Stubs;

defined( 'ABSPATH' ) || exit;

// phpcs:disable

/**
 * Showcasing how to composer based Stubs can be used.
 *
 * @since   1.0.0
 * @version 1.0.0
 *
 * This makes use of the buddyyPress stubs lib
 * https://raw.githubusercontent.com/gin0115/BuddyPress-Stubs/refs/heads/v11-1-0/buddypress-stubs.php
 * https://raw.githubusercontent.com/gin0115/BuddyPress-Stubs/
 */
final class Call_Symbols_In_Composer_Stubs{

	/**
	 * This methods calls a function which is defined in a compose based Stub lib
	 *
	 * BuddyPress is used as an example, but you can use any other plugin
	 *
	 * @param integer $user The user ID for which to get the total friend count.
	 *
	 * @return integer
	 */
	public function get_bp_user_count(int $user): int{
		return bp_get_total_friend_count( $user );  // ✅
	}

	/**
	 * This method calls a class which is held in a composer based Stub lib
	 *
	 * @return boolean
	 */
	public function get_bp_is_active(): bool {
		$bp = new \BP_Members_Invitation_Manager();  // ✅
		return $bp->run_send_action(new \BP_Invitation(12));  // ✅
	}

	/**
	 * This method is not defined in the composer based Stubs, so it will throw an error
	 *
	 * @param string $foo Some string parameter.
	 *
	 * @return integer
	 */
	public function cget_undefined_function( string $foo ): int {
		return some_undefined_function( $foo ); // ❌
	}

	/**
	 * This method should throw an error as its calling a object method that is not defined in the composer based Stubs
	 *
	 * @return string
	 */
	public function get_undefined_method(): string {
		$bp = new \BP_Members_Invitation_Manager();  // ✅
		return $bp->get_undefined_method(); // ❌
	}

	/**
	 * THis method uses a constant that is defined in the composer based Stubs
	 *
	 * @return string
	 */
	public function get_bp_constant(): string {
		return BP_REQUIRED_PHP_VERSION;  // ✅
	}

}
