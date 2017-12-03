<?php
declare(strict_types=1);

namespace AdventOfCode2017;

class Day02 {

	function solvePart1(string $input): int {
		$lines = explode("\n", $input);

		$sum = 0;
		foreach ($lines as $line) {
			$numbers = explode("\t", $line);
			$min = INF;
			$max = -INF;
			foreach ($numbers as $number) {
				$number = (int)$number;
				$min = min($min, $number);
				$max = max($max, $number);
			}
			$sum += $max - $min;
		}

		return $sum;
	}


	function solvePart2(string $input): int {
		$lines = explode("\n", $input);

		$sum = 0;
		foreach ($lines as $line) {
			$numbers = array_map(
				function($number) {
					return (int)$number;
				},
				explode("\t", $line)
			);
			rsort($numbers);

			foreach ($numbers as $key => $number) {
				for ($i = $key + 1; $i < count($numbers); $i++) {
					$divisor = $numbers[$i];
					if ($number !== $divisor && $number % $divisor === 0) {
						$sum += $number / $divisor;
						break 2;
					}
				}
			}
		}

		return $sum;
	}
}