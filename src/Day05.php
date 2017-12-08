<?php
declare(strict_types=1);

namespace AdventOfCode2017;

class Day05 {

	function solvePart1(string $input): int {
		$instructions = explode("\n", $input);

		$index = 0;
		$steps = 0;
		while (isset($instructions[$index])) {
			$index += $instructions[$index]++;
			$steps++;
		}

		return $steps;
	}

	function solvePart2(string $input): int {
		$instructions = explode("\n", $input);

		$index = 0;
		$steps = 0;
		while (isset($instructions[$index])) {
			$jump = $instructions[$index];
			if ($instructions[$index] >= 3) {
				$instructions[$index]--;
			} else {
				$instructions[$index]++;
			}
			$index += $jump;
			$steps++;
		}

		return $steps;
	}
}