<?php
declare(strict_types=1);

namespace AdventOfCode2017;

class Day10 {

	function reversePart(array $list, int $start, int $length): array {
		if ($length === 0) {
			return $list;
		}
		$listLength = count($list);
		$end = ($start + $length - 1) % $listLength;
		if ($start <= $end) {
			$steps = floor(($end - $start + 1) / 2);
		} else {
			$steps = floor(($listLength - $start + $end + 1) / 2);
		}
		for($i = 0; $i < $steps; $i++) {
			$startPos = ($start + $i) % $listLength;
			$endPos = ($end - $i + $listLength) % $listLength;
			list($list[$startPos], $list[$endPos]) = [$list[$endPos], $list[$startPos]];
		}
		return $list;
	}

	function solvePart1(array $lengths, int $size): int {
		$list = [];
		for ($i = 0; $i < $size; $i++) {
			$list[] = $i;
		}

		$position = 0;
		$skip = 0;
		foreach ($lengths as $length) {
			$list = $this->reversePart($list, $position, $length);
			$position = ($position + $length + $skip) % count($list);
			$skip++;
		}

		return $list[0] * $list[1];
	}

	function convertFromASCII(string $input): array {
		if ($input === '') {
			return [];
		}
		$list = str_split($input);
		return array_map('ord', $list);
	}

	function convertAndAppend(string $input): array {
		return array_merge($this->convertFromASCII($input), [17, 31, 73, 47, 23]);
	}

	function runRound($list, $position, $skip, array $lengths): array {
		foreach ($lengths as $length) {
			$list = $this->reversePart($list, $position, $length);
			$position = ($position + $length + $skip) % count($list);
			$skip++;
			#echo "Position: $position Length: $length Skip: $skip Count: " . count($list) . PHP_EOL;
		}
		return [$list, $position, $skip];
	}

	function xorSlice(array $slice): int {
		return $slice[0] ^ $slice[1] ^ $slice[2] ^ $slice[3] ^
			$slice[4] ^ $slice[5] ^ $slice[6] ^ $slice[7] ^
			$slice[8] ^ $slice[9] ^ $slice[10] ^ $slice[11] ^
			$slice[12] ^ $slice[13] ^ $slice[14] ^ $slice[15];
	}

	function densify($sparseHash) {
		$denseHash = [];
		for ($i = 0; $i < 16; $i++) {
			$slice = array_slice($sparseHash, $i * 16, 16);
			$denseHash[] = $this->xorSlice($slice);
		}
		return $denseHash;
	}

	function hex(array $list) {
		$hex = '';
		foreach($list as $element) {
			if (strlen(dechex($element)) === 1) {
				$hex .= 0;
			}
			$hex .= dechex($element);
		}
		return $hex;
	}

	function solvePart2(string $input): string {
		$list = [];
		for ($i = 0; $i < 256; $i++) {
			$list[] = $i;
		}

		$position = 0;
		$skip = 0;
		$operations = $this->convertAndAppend($input);

		for ($i = 0; $i < 64; $i++) {
			list($list, $position, $skip) = $this->runRound($list, $position, $skip, $operations);
		}

		$denseList = $this->densify($list);
		$hex = $this->hex($denseList);

		return $hex;
	}

}