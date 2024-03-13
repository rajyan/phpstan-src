<?php

namespace TooWideMethodParameterOut;

class Foo
{

	public function doFoo(?string &$p): void
	{

	}

	public function doBar(?string &$p): void
	{
		$p = 'foo';
	}

	/**
	 * @param-out string|null $p
	 */
	public function doBaz(?string &$p): void
	{
		$p = 'foo';
	}

	public function doLorem(?string &$p): void
	{
		$p = 'foo';
	}

}