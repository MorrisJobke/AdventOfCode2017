<?php
declare(strict_types=1);

namespace AdventOfCode2017;

class Day03 {

	const UP = [0, -1];
	const DOWN = [0, 1];
	const RIGHT = [1, 0];
	const LEFT = [-1, 0];

	function move(array $field, array $direction, int $x, int $y): array {
		switch($direction) {
			case self::UP:
				if ($field[$x-1][$y] === null) {
					return self::LEFT;
				}
				break;
			case self::DOWN:
				if ($field[$x+1][$y] === null) {
					return self::RIGHT;
				}
				break;
			case self::LEFT:
				if ($field[$x][$y+1] === null) {
					return self::DOWN;
				}
				break;
			case self::RIGHT:
				if ($field[$x][$y-1] === null) {
					return self::UP;
				}
				break;
		}

		return $direction;
	}

	function print(array $field) {
		echo PHP_EOL . PHP_EOL ."Field" . PHP_EOL;
		$border = '';
		$printableRow = [];
		foreach ($field as $rows) {
			$border .= '##########';
			foreach ($rows as $rowNumber => $cell) {
				if (!isset($printableRow[$rowNumber])) {
					$printableRow[$rowNumber] = '';
				}
				$printableRow[$rowNumber] .= sprintf("%7s", $cell);
			}
		}

		echo $border . PHP_EOL;
		foreach ($printableRow as $row) {
			echo $row . PHP_EOL;
		}
		echo $border . PHP_EOL;
	}

	function solvePart1(int $input): int {
		$squareRoot = sqrt($input);
		$dimension = (int)ceil($squareRoot) + 1;

		$field = [];
		for ($x = 0; $x < $dimension; $x++) {
			$field[] = [];
			for ($y = 0; $y < $dimension; $y++) {
				$field[$x][$y] = null;
			}
		}

		$x = (int)floor($dimension / 2);
		$y = $x;
		$start = $x;
		$number = 1;
		$direction = self::DOWN;
		$field[$x][$y] = $number;

		while ($number < $input) {
			$direction = $this->move($field, $direction, $x, $y);
			$x += $direction[0];
			$y += $direction[1];
			$number += 1;
			$field[$x][$y] = $number;
		}

		// DEBUG $this->print($field);


		return abs($start - $x) + abs($start - $y);
	}

	function solvePart2Helper(int $input): int {
		$squareRoot = sqrt($input);
		$dimension = (int)ceil($squareRoot) + 2;

		$field = [];
		for ($x = 0; $x < $dimension; $x++) {
			$field[] = [];
			for ($y = 0; $y < $dimension; $y++) {
				$field[$x][$y] = null;
			}
		}

		$x = (int)floor($dimension / 2);
		$y = $x;
		$number = 1;
		$direction = self::DOWN;
		$value = 1;
		$field[$x][$y] = $value;

		while ($input > $number) {
			$direction = $this->move($field, $direction, $x, $y);
			$x += $direction[0];
			$y += $direction[1];
			$number += 1;
			$value = 0;
			$value += $field[$x-1][$y+1] ?? 0;
			$value += $field[$x][$y+1] ?? 0;
			$value += $field[$x+1][$y+1] ?? 0;
			$value += $field[$x-1][$y] ?? 0;
			$value += $field[$x][$y] ?? 0;
			$value += $field[$x+1][$y] ?? 0;
			$value += $field[$x-1][$y-1] ?? 0;
			$value += $field[$x][$y-1] ?? 0;
			$value += $field[$x+1][$y-1] ?? 0;
			$field[$x][$y] = $value;
		}

		// DEBUG $this->print($field);


		return $value;
	}

	function solvePart2(int $input): int {
		$squareRoot = sqrt($input);
		$dimension = (int)ceil($squareRoot) + 2;

		$field = [];
		for ($x = 0; $x < $dimension; $x++) {
			$field[] = [];
			for ($y = 0; $y < $dimension; $y++) {
				$field[$x][$y] = null;
			}
		}

		$x = (int)floor($dimension / 2);
		$y = $x;
		$number = 1;
		$direction = self::DOWN;
		$value = 1;
		$field[$x][$y] = $value;

		while ($value <= $input) {
			$direction = $this->move($field, $direction, $x, $y);
			$x += $direction[0];
			$y += $direction[1];
			$number += 1;
			$value = 0;
			$value += $field[$x-1][$y+1] ?? 0;
			$value += $field[$x][$y+1] ?? 0;
			$value += $field[$x+1][$y+1] ?? 0;
			$value += $field[$x-1][$y] ?? 0;
			$value += $field[$x][$y] ?? 0;
			$value += $field[$x+1][$y] ?? 0;
			$value += $field[$x-1][$y-1] ?? 0;
			$value += $field[$x][$y-1] ?? 0;
			$value += $field[$x+1][$y-1] ?? 0;
			$field[$x][$y] = $value;
		}

		// DEBUG $this->print($field);

		return $value;
	}
}