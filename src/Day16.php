<?php
declare(strict_types=1);

namespace AdventOfCode2017;

class Day16 {

	function dance(string $state, string $step): string {

		$list = str_split($state);
		switch (substr($step, 0, 1)) {
			case 's':
				$count = (int)substr($step, 1);
				$head = array_slice($list, 0, count($list) - $count);
				$tail = array_slice($list, -1 * $count);
				$list = array_merge($tail, $head);
				break;
			case 'x':
				list($positionA, $positionB) = explode('/', substr($step, 1));
				$positionA = (int)$positionA;
				$positionB = (int)$positionB;

				list($list[$positionB], $list[$positionA]) = [$list[$positionA], $list[$positionB]];
				break;
			case 'p':
				list($characterA, $characterB) = explode('/', substr($step, 1));
				$positionA = array_search($characterA, $list);
				$positionB = array_search($characterB, $list);

				list($list[$positionB], $list[$positionA]) = [$list[$positionA], $list[$positionB]];
				break;
		}

		return join('', $list);
	}

	function solvePart1(string $input): string {
		$steps = explode(",", $input);

		$state = 'abcdefghijklmnop';
		foreach ($steps as $step) {
			$state = $this->dance($state, $step);
		}

		return $state;
	}

	function solvePart2(string $input): string {
		$steps = explode(",", $input);

		$state = 'abcdefghijklmnop';
		$outcome = [];
		$repeat = 0;
		for ($i = 0; $i < 1000000000; $i++) {
			if (in_array($state, $outcome)) {
				$repeat = $i;
				break;
			}
			$outcome[$i] = $state;
			foreach ($steps as $step) {
				$state = $this->dance($state, $step);
			}
		}

		return $outcome[1000000000 % $repeat];
	}
}