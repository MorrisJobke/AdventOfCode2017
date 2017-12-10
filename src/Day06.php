<?php
declare(strict_types=1);

namespace AdventOfCode2017;

class Day06 {

	function solve(string $input): array {
		$memory = array_map(function($e) { return (int)$e; }, explode(" ", $input));
		$memorySize = count($memory);

		$cycles = 0;
		$states = [];
		$state = '';

		while(!isset($states[$state])) {
			$states[$state] = $cycles;
			$cycles++;

			// find highest
			$max = -INF;
			$index = 0;
			foreach ($memory as $key => $number) {
				if ($number > $max) {
					$index = $key;
					$max = $number;
				}
			}

			$blocks = $max;
			$memory[$index] = 0;
			while ($blocks > 0) {
				$index = ($index + 1) % $memorySize;
				$memory[$index]++;
				$blocks--;
			}

			$state = join(' ', $memory);
		}

		return [$cycles, $cycles - $states[$state]];
	}
}