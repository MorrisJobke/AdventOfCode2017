<?php
declare(strict_types=1);

namespace AdventOfCode2017;

class Day21 {

	function convertToBlocks(string $input): array {
		$lines = explode("\n", $input);

		$size = strlen($lines[0]);
		$blockSize = ($size % 2 === 0) ? 2 : 3;
		$blockCount = $size / $blockSize;

		$map = [];
		foreach ($lines as $line) {
			$map[] = str_split($line);
		}

		$result = [];
		for ($i = 0; $i < $blockCount; $i++) {
			for ($j = 0; $j < $blockCount; $j++) {
				if ($blockSize === 2) {
					$block = $map[0 + $i * $blockSize][0 + $j * $blockSize] . $map[0 + $i * $blockSize][1 + $j * $blockSize] . '/' .
						$map[1 + $i * $blockSize][0 + $j * $blockSize] . $map[1 + $i * $blockSize][1 + $j * $blockSize];
				} else {
					$block = $map[0 + $i * $blockSize][0 + $j * $blockSize] . $map[0 + $i * $blockSize][1 + $j * $blockSize] . $map[0 + $i * $blockSize][2 + $j * $blockSize] . '/' .
						$map[1 + $i * $blockSize][0 + $j * $blockSize] . $map[1 + $i * $blockSize][1 + $j * $blockSize] . $map[1 + $i * $blockSize][2 + $j * $blockSize] . '/' .
						$map[2 + $i * $blockSize][0 + $j * $blockSize] . $map[2 + $i * $blockSize][1 + $j * $blockSize] . $map[2 + $i * $blockSize][2 + $j * $blockSize];
				}
				$result[] = $block;
			}
		}

		return $result;
	}

	function convertToMap(array $input): string {
		$size = (int)sqrt(count($input));

		foreach ($input as &$entry) {
			$entry = explode('/', $entry);
		}

		$subBlockCount = count($input[0]);

		$map = '';

		for ($i = 0; $i < $size; $i++) {
			for ($k = 0; $k < $subBlockCount; $k++) {
				for ($j = 0; $j < $size; $j++) {
					$map .= $input[$j + $i * $size][$k];
				}
				$map .= "\n";
			}
		}

		return trim($map, "\n");
	}

	function getRotated(string $input): array {
		$result = [$input];

		$characters = str_split(str_replace('/', '', $input));
		if (strlen($input) === 5) { // 2x2
			$result[] = $characters[1] . $characters[3] . '/' . $characters[0] . $characters[2];
			$result[] = $characters[3] . $characters[2] . '/' . $characters[1] . $characters[0];
			$result[] = $characters[2] . $characters[0] . '/' . $characters[3] . $characters[1];
		} else { // 3x3
			$result[] = $characters[2] . $characters[5] . $characters[8] . '/' . $characters[1] . $characters[4] . $characters[7] . '/' . $characters[0] . $characters[3] . $characters[6];
			$result[] = $characters[8] . $characters[7] . $characters[6] . '/' . $characters[5] . $characters[4] . $characters[3] . '/' . $characters[2] . $characters[1] . $characters[0];
			$result[] = $characters[6] . $characters[3] . $characters[0] . '/' . $characters[7] . $characters[4] . $characters[1] . '/' . $characters[8] . $characters[5] . $characters[2];
		}

		// flip all

		$flips = [];
		foreach ($result as $element) {
			$characters = str_split(str_replace('/', '', $element));
			if (strlen($input) === 5) { // 2x2
				$flips[] = $characters[1] . $characters[0] . '/' . $characters[3] . $characters[2];
			} else { // 3x3
				$flips[] = $characters[2] . $characters[1] . $characters[0] . '/' . $characters[5] . $characters[4] . $characters[3] . '/' . $characters[8] . $characters[7] . $characters[6];

			}
		}

		return array_merge($result, $flips);
	}

	/**
	 * @throws \Exception
	 */
	function findReplacement(string $input, array $book): string {

		$rotated = $this->getRotated($input);

		foreach ($rotated as $e) {
			if (isset($book[$e])) {
				return $book[$e];
			}
		}
		throw new \Exception('Boom');
	}

	/**
	 * @throws \Exception
	 */
	function solvePart1(string $bookInput, int $iterations): int {
		$bookInput = explode("\n", $bookInput);
		$book = [];
		foreach ($bookInput as $line) {
			$pos = strpos($line, ' => ');
			$index = substr($line, 0, $pos);
			$replacement = substr($line, $pos + 4);

			$book[$index] = $replacement;
		}
		$mapBlocks = [
			'.#./..#/###'
		];

		#print_r($book);
		#echo "\n\n";
		#print_r($this->convertToMap($mapBlocks));
		for ($i = 0; $i < $iterations; $i++) {
			//
			foreach ($mapBlocks as &$element) {
				#echo "Before: $element\n";
				$element = $this->findReplacement($element, $book);
				#echo "After: $element\n";
			}
			$mapBlocks = $this->convertToBlocks($this->convertToMap($mapBlocks));
			#echo "End\n\n";
			#echo "\n\n";
			#print_r($this->convertToMap($mapBlocks));
		}


		return count_chars($this->convertToMap($mapBlocks))[ord('#')];
	}


}