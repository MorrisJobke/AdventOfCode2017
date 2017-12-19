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

	function solvePart2(int $currentA, int $currentB): int {
		ini_set('memory_limit', '2G');
		$generatorA = 16807;
		$generatorB = 48271;

		$matchesA = [];
		$matchesB = [];
		$i = 0;
		while ($i < 5000000) {
			$currentA = ($currentA * $generatorA) % 2147483647;

			if ($currentA % 4 === 0) {
				$matchesA[] = $currentA;
				$i++;
			}
		}
		$i = 0;
		while ($i < 5000000) {
			$currentB = ($currentB * $generatorB) % 2147483647;

			if ($currentB % 8 === 0) {
				$matchesB[] = $currentB;
				$i++;
			}
		}

		$result = 0;
		for ($i = 0; $i < 5000000; $i++) {
			$currentA = $matchesA[$i];
			$currentB = $matchesB[$i];
			if (substr(decbin($currentA), -16) === substr(decbin($currentB), -16)) {
				$result++;
			}
		}

		return $result;
	}
}