<?php
declare(strict_types=1);

namespace AdventOfCode2017;

class Day09 {

	function eliminateIgnoredCharacters(string $input): string {
		return preg_replace('/!./', '', $input);
	}

	function eliminateGarbage(string $input, string $replacement = ''): string {
		return preg_replace('/<[^>]*>/', $replacement, $this->eliminateIgnoredCharacters($input));
	}

	function getGroups(string $input, int $parentScore = 0): array {
		$input = $this->eliminateGarbage($input, 'NULL');
		$output = str_replace(['{', '}'], ['[', ']'], $input);

		return eval("return $output;");

		/*
		$total = 0;
		if ($input[0] === '{' && $input[strlen($input)-1] === '}') {
			$length = strlen($input) - 2;
			$content = substr($input, 1, $length);
			echo "Start: 1 Length: $length Output: $content\n";
			try {
				$parts = explode(',', $content);
				$results = [];
				foreach ($parts as $part) {
					if ($part !== '') {
						list($subTotal, $result) = $this->getGroups($part, $thisScore);
						$total += $subTotal;
						$results[] = $result;
					}
				}
			} catch (\Exception $e) {
				list($subTotal, $result) = $this->getGroups($content, $thisScore);
				$total += $subTotal;
				$results[] = $result;
			}
		} else {
			throw new \Exception('failure');
		}
		$total += $thisScore;
		return [$total, $results];*/
	}

	function calculateScore(array $groups, int $parentScore): int {
		$thisScore = $parentScore + 1;

		$total = 0;

		foreach ($groups as $group) {
			if ($group !== null) {
				$total += $this->calculateScore($group, $thisScore);
			}
		}

		$thisScore += $total;
		return $thisScore;
	}

	function solvePart1(string $input): int {
		$groups = $this->getGroups($input);
		return $this->calculateScore($groups, 0);
	}

	function countEliminateGarbage(string $input): int {
		preg_replace('/<[^>]*>/', '', $this->eliminateIgnoredCharacters($input), -1, $count);
		return $count;
	}

	function solvePart2(string $input): int {
		$filtered = $this->eliminateIgnoredCharacters($input);
		$garbageCleaned = $this->eliminateGarbage($input);
		$garbageCount = $this->countEliminateGarbage($input);

		$totalLength = strlen($input);
		$filteredLength = strlen($filtered);
		$garbageCharacters = $garbageCount * 2; // for < and > around each garbage
		$garbageCleanedLength = strlen($garbageCleaned);

		$filteredCharacters = $totalLength - $filteredLength;

		return $totalLength - $garbageCleanedLength - $garbageCharacters - $filteredCharacters;
	}

}