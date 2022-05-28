<?php

namespace Bug7291Certainty;

use PHPStan\TrinaryLogic;
use function PHPStan\Testing\assertType;
use function PHPStan\Testing\assertVariableCertainty;

class HelloWorld {
	public function doFoo(): void {
		if (rand(0, 1)) {
			$a = rand(0, 1) ? new \stdClass() : null;
		}

		assertType('stdClass|null', $a);
		assertVariableCertainty(TrinaryLogic::createMaybe(), $a);

		echo $a?->foo;

		assertType('stdClass|null', $a);
		assertVariableCertainty(TrinaryLogic::createMaybe(), $a);
	}
}
