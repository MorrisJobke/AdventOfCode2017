<?php
declare(strict_types=1);

namespace AdventOfCode2017;

class Day04 {

	function solvePart1(string $input): int {
		$lines = explode("\n", $input);

		$validPassphrases = 0;
		foreach ($lines as $line) {
			$words = explode(" ", $line);
			$wordList = [];

			$skip = false;
			foreach ($words as $word) {
				if (isset($wordList[$word])) {
					$skip = true;
					break 1;
				}
				$wordList[$word] = true;
			}
			if (!$skip) {
				$validPassphrases++;
			}
		}

		return $validPassphrases;
	}

	function solvePart2(string $input): int {
		$lines = explode("\n", $input);

		$validPassphrases = 0;
		foreach ($lines as $line) {
			$words = explode(" ", $line);
			$wordList = [];

			$skip = false;
			foreach ($words as $word) {
				$letters = str_split($word);
				sort($letters);
				$word = join('', $letters);
				if (isset($wordList[$word])) {
					$skip = true;
					break 1;
				}
				$wordList[$word] = true;
			}
			if (!$skip) {
				$validPassphrases++;
			}
		}

		return $validPassphrases;
	}
}