<?php
declare(strict_types=1);

namespace AdventOfCode2017;

class Day15 {
	function solvePart1(int $currentA, int $currentB): int {
		$result = 0;

		$generatorA = 16807;
		$generatorB = 48271;

		for ($i = 0; $i < 40000000; $i++) {
			$currentA = ($currentA * $generatorA) % 2147483647;
			$currentB = ($currentB * $generatorB) % 2147483647;

			if (substr(decbin($currentA), -16) === substr(decbin($currentB), -16)) {
				$result++;
			}
		}

		return $result;
	}
}