<?php declare(strict_types=1);

/**
 * This is a file that contains some custom stubs for PHPStan.
 */
namespace Gin0115\Some\Lib{
	class SomeClass {
		/**
		 * @return integer
		 */
		public function someMethod(): int {
		}
	}
}

namespace SomeOther\Lib{
	class SomeOtherClass {
		/**
		 * @return string
		 */
		public function someOtherMethod(): string {
		}
	}
}

namespace {
	/**
	 * @param array{id: int, name:string otherName?:string} $foo The args for the user function.
	 * @return integer
	 */
	function some_user_function( array $foo ): int {
		return 42;
	}
}
