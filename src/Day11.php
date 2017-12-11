<?php
declare(strict_types=1);

namespace AdventOfCode2017;

class Day11 {
	// [se, sw] = [s]
	// [ne, nw] = [n]
	// [ne, sw] = []
	// [nw, se] = []
	// [n, s] = []

	function solvePart1(string $steps): int {
		$steps = explode(',', $steps);

		$stepCount = array_count_values($steps);
		$stepCount = array_merge(['ne' => 0, 'n' => 0, 'nw' => 0, 'se' => 0, 's' => 0, 'sw' => 0], $stepCount);

		$previousCounts = [];

		while ($previousCounts !== $stepCount) {
			$previousCounts = $stepCount;

			while ($stepCount['ne'] > 0 && $stepCount['nw'] > 0) {
				$stepCount['ne']--;
				$stepCount['nw']--;
				$stepCount['n']++;
			}
			while ($stepCount['se'] > 0 && $stepCount['sw'] > 0) {
				$stepCount['se']--;
				$stepCount['sw']--;
				$stepCount['s']++;
			}
			while ($stepCount['ne'] > 0 && $stepCount['s'] > 0) {
				$stepCount['ne']--;
				$stepCount['s']--;
				$stepCount['se']++;
			}
			while ($stepCount['nw'] > 0 && $stepCount['s'] > 0) {
				$stepCount['nw']--;
				$stepCount['s']--;
				$stepCount['sw']++;
			}
			while ($stepCount['se'] > 0 && $stepCount['n'] > 0) {
				$stepCount['se']--;
				$stepCount['n']--;
				$stepCount['ne']++;
			}
			while ($stepCount['sw'] > 0 && $stepCount['n'] > 0) {
				$stepCount['sw']--;
				$stepCount['n']--;
				$stepCount['nw']++;
			}
			while ($stepCount['n'] > 0 && $stepCount['s'] > 0) {
				$stepCount['n']--;
				$stepCount['s']--;
			}
			while ($stepCount['ne'] > 0 && $stepCount['sw'] > 0) {
				$stepCount['ne']--;
				$stepCount['sw']--;
			}
			while ($stepCount['nw'] > 0 && $stepCount['se'] > 0) {
				$stepCount['nw']--;
				$stepCount['se']--;
			}

		}

		return array_reduce($stepCount, function($a, $b) { return $a + $b;}, 0);
	}
}