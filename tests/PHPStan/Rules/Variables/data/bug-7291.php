<?php declare(strict_types = 1);

namespace Bug7291Variables;

if (rand(0, 1)) {
	$a = rand(0, 1) ? new \stdClass() : null;
}

echo $a?->foo; // warn
echo $a?->foo ?? ''; // warn
echo isset($a?->foo);

if (rand(0, 1)) {
	$b = new \stdClass();
	$b->foo = 'test';
}

echo $b?->foo; // warn
echo $b->foo?->bar; // warn

echo $b?->foo ?? ''; // warn
echo isset($b?->foo);

$c = new \stdClass();
if (rand(0, 1)) {
	$c->foo = new \stdClass();
	$c->foo->bar = 'test';
}

echo $c->foo?->bar; // warn
echo $c->foo?->bar ?? 'test';
echo isset($c->foo?->bar);

class Test {
	public function test(): void {
		if (rand(0, 1)) {
			$a = rand(0, 1) ? new \stdClass() : null;
		}

		echo $a?->foo; // warn
		echo $a?->foo ?? ''; // warn
		echo isset($a?->foo);

		if (rand(0, 1)) {
			$b = new \stdClass();
			$b->foo = 'test';
		}

		echo $b?->foo; // warn
		echo $b->foo?->bar; // warn

		echo $b?->foo ?? ''; // warn
		echo isset($b?->foo);

		$c = new \stdClass();
		if (rand(0, 1)) {
			$c->foo = new \stdClass();
			$c->foo->bar = 'test';
		}

		echo $c->foo?->bar; // warn
		echo $c->foo?->bar ?? 'test'; // warn
		echo isset($c->foo?->bar);
	}
}
