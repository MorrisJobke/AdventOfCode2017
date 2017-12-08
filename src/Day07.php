<?php
declare(strict_types=1);

namespace AdventOfCode2017;

class Day07 {

	function solvePart1(string $input): string {
		$elementAnswers = explode("\n", $input);

		$allChildren = [];
		$allNames = [];
		foreach ($elementAnswers as $answer) {
			preg_match('!(\w+) \((\d+)\)( -> (.*))?!', $answer, $matches);

			$name = $matches[1];
			$weight = $matches[2];
			if (isset($matches[4])) {
				$children = array_map('trim', explode(',', $matches[4]));
			} else {
				$children = [];
			}

			$allNames[] = $name;
			$allChildren = array_merge($allChildren, $children);
		}
		sort($allNames);
		sort($allChildren);

		$diff = array_diff($allNames, $allChildren);

		if (count($diff) !== 1) {
			print_r($diff);
			return '';
		}

		return array_pop($diff);
	}

	function getWeight($elements, $name): int {
		$weight = $elements[$name]['weight'];
		foreach ($elements[$name]['children'] as $child) {
			$weight += $this->getWeight($elements, $child);
		}
		return $weight;
	}

	function childrenBalanced($elements, $name) {
		$weights = [];
		foreach ($elements[$name]['children'] as $child) {
			$weights[$child] = $this->getWeight($elements, $child);
		}

		if (count(array_unique($weights)) === 1) {
			return true;
		}

		$values = array_count_values($weights);
		asort($values);

		$value = key($values);

		foreach ($weights as $name => $weight) {
			if ($weight === $value) {
				next($values);
				return [
					'name' => $name,
					'diff' => key($values) - $value,
				];
			}
		}

		throw new \Exception('Boom');
	}

	function findUnbalanced($allElements, $name, $overweight = 0) {

		$childrenBalanced = $this->childrenBalanced($allElements, $name);

		if ($childrenBalanced === true) {
			return $allElements[$name]['weight'] + $overweight;
		}

		return $this->findUnbalanced($allElements, $childrenBalanced['name'], $childrenBalanced['diff']);
	}

	function solvePart2(string $input): int {
		$elementAnswers = explode("\n", $input);

		$allChildren = [];
		$allNames = [];
		$allElements = [];
		foreach ($elementAnswers as $answer) {
			preg_match('!(\w+) \((\d+)\)( -> (.*))?!', $answer, $matches);

			$name = $matches[1];
			$weight = $matches[2];
			if (isset($matches[4])) {
				$children = array_map('trim', explode(',', $matches[4]));
			} else {
				$children = [];
			}

			$allNames[] = $name;
			$allChildren = array_merge($allChildren, $children);
			$allElements[$name] = [
				'weight' => (int)$weight,
				'children' => $children,
			];
		}
		sort($allNames);
		sort($allChildren);

		$diff = array_diff($allNames, $allChildren);

		if (count($diff) !== 1) {
			print_r($diff);
			return -INF;
		}

		$start = array_pop($diff);

		return $this->findUnbalanced($allElements, $start);
	}

}