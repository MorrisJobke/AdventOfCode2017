<?php
declare(strict_types=1);

namespace AdventOfCode2017;

class Day14 {
	private $chars = [
		'0' => '0000',
		'1' => '0001',
		'2' => '0010',
		'3' => '0011',
		'4' => '0100',
		'5' => '0101',
		'6' => '0110',
		'7' => '0111',
		'8' => '1000',
		'9' => '1001',
		'a' => '1010',
		'b' => '1011',
		'c' => '1100',
		'd' => '1101',
		'e' => '1110',
		'f' => '1111',
	];

	function convertHex(string $char): string {
		return $this->chars[$char];
	}

	function convertString(string $string): string {
		$chars = str_split($string);
		$result = '';
		foreach ($chars as $char) {
			$result .= $this->convertHex($char);
		}

		return $result;
	}

	function solvePart1(string $input): int {
		$day10 = new Day10();
		$result = 0;
		for($i = 0; $i < 128; $i++) {
			$hash = $day10->solvePart2("$input-$i");
			$row = $this->convertString($hash);

			$result += count_chars($row)[49];
		}

		return $result;
	}

	function eliminate(array $map, int $x, int $y) {
		if ($map[$x][$y] === 0) {
			#echo "I'm 0\n";
			return $map;
		}

		#echo "Eliminate myself [$x, $y]\n";
		$map[$x][$y]  = 0;

		if ($x !== 0) {
			#echo "Eliminate [$x-1, $y]\n";
			$map = $this->eliminate($map, $x - 1, $y);
		}

		if ($y !== 0) {
			#echo "Eliminate [$x, $y-1]\n";
			$map = $this->eliminate($map, $x, $y - 1);
		}

		if ($x !== 127) {
			#echo "Eliminate [$x+1, $y]\n";
			$map = $this->eliminate($map, $x + 1, $y);
		}

		if ($y !== 127) {
			#echo "Eliminate [$x, $y+1]\n";
			$map = $this->eliminate($map, $x, $y + 1);
		}



		return $map;
	}

	function solvePart2(string $input): int {
		$day10 = new Day10();
		$map = [];
		for($i = 0; $i < 128; $i++) {
			$hash = $day10->solvePart2("$input-$i");
			$row = $this->convertString($hash);

			$cells = str_split($row);
			$map[$i] = array_map('intval', $cells);
		}

		$groups = 0;

		for ($x = 0; $x < 128; $x++) {
			for ($y = 0; $y < 128; $y++) {
				if ($map[$x][$y] !== 0) {
					$map = $this->eliminate($map, $x, $y);
					$groups++;
				}
			}
		}

		return $groups;
	}
}