<?php
declare(strict_types=1);

namespace AdventOfCode2017;

class Day17 {

	function solvePart1(int $steps): int {
		echo "\n";
		$memory = [ 0 ];

		$position = 0;
		for ($i = 1; $i < 2018; $i++) {
			$position = ($position + $steps) % ($i);
			$position += 1;
			$memory = array_merge(array_slice($memory, 0, $position), [$i], array_slice($memory, $position));
			#echo "After: Position: $position Round: $i\n";
			#echo join(" ", $memory) . "\n";
		}

		return $memory[$position + 1];
	}

}