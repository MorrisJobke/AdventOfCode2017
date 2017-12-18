<?php
declare(strict_types=1);

namespace AdventOfCode2017;

class Day17 {

	function solvePart1(int $steps): int {
		$memory = [ 0 ];

		$position = 0;
		for ($i = 1; $i < 2018; $i++) {
			$position = ($position + $steps) % $i + 1;
			array_splice($memory, $position, 0, $i);
		}

		return $memory[$position + 1];
	}

	function solvePart2(int $steps, int $iterations): int {
		$position = 0;
		$start = microtime(true);
		$result = 0;
		for ($i = 1; $i <= $iterations; $i++) {
			$position = (($position + $steps) % $i) + 1;
			if ($position === 1) {
				$result = $i;
				#echo "Found $i\n";
			}
		}

		$diff = microtime(true) - $start;
		#echo "\nIt took $diff seconds\n";
		$estimation = $diff / $iterations * 50000000;
		#echo "Estimated for 500 million: $estimation seconds\n";

		return $result;
	}

}