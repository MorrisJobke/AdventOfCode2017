<?php
declare(strict_types=1);

namespace AdventOfCode2017;

class Day01 {

	function solvePart1(string $input): int {
		$list = str_split($input);
		$length = count($list);
		$sum = 0;
		$step = 1;
		for($i = 0; $i < $length; $i++) {
			$j = ($i + $step) % $length;
			if ($list[$i] === $list[$j]) {
				$sum += $list[$i];
			}
		}
		return $sum;
	}

	function solvePart2(string $input): int {
		$list = str_split($input);
		$length = count($list);
		$sum = 0;
		$step = $length / 2;
		for($i = 0; $i < $length; $i++) {
			$j = ($i + $step) % $length;
			if ($list[$i] === $list[$j]) {
				$sum += $list[$i];
			}
		}
		return $sum;
	}
}