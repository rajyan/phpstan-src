<?php

namespace NoopImpurePoints;

class Foo
{

	private static $staticProp = 1;

	public function doFoo(bool $b): void
	{
		$b && $this->doBar();
		$b && $this->doBaz();
		$b && $this->doLorem();
	}

	/**
	 * @phpstan-pure
	 */
	public function doBar(): bool
	{
		return true;
	}

	/**
	 * @phpstan-impure
	 */
	public function doBaz(): bool
	{
		return true;
	}

	public function doLorem(): bool
	{
		return true;
	}

	public function doExit(): void
	{
		exit(1);
	}

	public function doAssign(bool $b): void
	{
		$b ? $a = 1 : '';
		$b ? $this->foo = 1 : '';
	}

	public function doClosures(int $i): void
	{
		$a = static function () {
			echo '1';
		};
		$a();

		$b = static function () {
			return 1 + 1;
		};
		$b();

		$ref = 1;
		$c = static function () use (&$ref) {
			$ref++;
		};
		$c();

		$d = function () {
			self::$foo = 1;
		};
		$d();

		$e = function () {
			self::$staticProp = 1;
		};
		$e();

		$i();
	}

	public function doFunctionWithByRef(bool $b, array $a): void
	{
		$func = $b ? 'array_unshift' : 'array_push';
		$func($a, 1);
	}

	public function anonymousClassWithSideEffect(): void
	{
		new class () {
			public function __construct()
			{
				echo '1';
			}
		};
	}

	public function anonymousClassWithoutConstructor(): void
	{
		new class () {
		};
	}

	public function anonymousClassWithPureConstructor(): void
	{
		new class () {

			/** @var int */
			private $i;

			public function __construct()
			{
				$this->i = 1;
			}

		};
	}

}
