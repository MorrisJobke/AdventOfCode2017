<?php
declare(strict_types=1);

namespace AdventOfCode2017;

class Day11 {
	// theory of hex maps: http://3dmdesign.com/development/hexmap-coordinates-the-easy-way

	// [se, sw] = [s]
	// [ne, nw] = [n]
	// [nw, s] = [sw]
	// [ne, s] = [se]
	// [sw, n] = [nw]
	// [se, n] = [ne]
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

	function solvePart2(string $steps): int {
		$steps = explode(',', $steps);

		$maxDistance = -INF;
		$coordinates = [0, 0];
		foreach ($steps as $step) {
			switch ($step) {
				case 'nw':
					$coordinates[0]--;
					break;
				case 'n':
					$coordinates[1]++;
					break;
				case 'ne':
					$coordinates[0]++;
					$coordinates[1]++;
					break;
				case 'se':
					$coordinates[0]++;
					break;
				case 's':
					$coordinates[1]--;
					break;
				case 'sw':
					$coordinates[0]--;
					$coordinates[1]--;
					break;
			}
			$diffX = $coordinates[0] - 0;
			$diffY = $coordinates[1] - 0;
			$diff = $diffY - $diffX;
			$distance = max(abs($diffX), abs($diffY), $diff);
			if ($distance > $maxDistance) {
				$maxDistance = $distance;
			}
		}

		return $maxDistance;
	}
}