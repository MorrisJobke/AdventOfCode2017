<?php
declare(strict_types=1);

namespace AdventOfCode2017;

class Day12 {
	function solvePart1(string $input, string $startNode): int {
		$lines = explode("\n", $input);

		$connections = [];
		foreach ($lines as $line) {
			preg_match('!(\d+) <-> ((\d+,? ?)+)!', $line, $matches);

			$node = $matches[1];
			$otherNodes = $matches[2];
			$connections[$node] = array_map(
				function($a) {
					return trim($a);
				},
				explode(",", $otherNodes)
			);
		}

		$nextNodes = [$startNode];
		$finalNodes = [];
		while (count($nextNodes)) {
			$nextNode = array_pop($nextNodes);

			foreach ($connections[$nextNode] as $connectedNode) {
				if (!in_array($connectedNode, $finalNodes)) {
					$finalNodes[] = $connectedNode;
					$nextNodes[] = $connectedNode;
				}
			}
		}

		return count($finalNodes);
	}
	function solvePart2(string $input): int {
		$lines = explode("\n", $input);

		$connections = [];
		foreach ($lines as $line) {
			preg_match('!(\d+) <-> ((\d+,? ?)+)!', $line, $matches);

			$node = $matches[1];
			$otherNodes = $matches[2];
			$connections[$node] = array_map(
				function($a) {
					return trim($a);
				},
				explode(",", $otherNodes)
			);
		}

		$nextNodes = [];
		$groups = 0;
		while (count($connections)) {
			$groups++;
			#echo "Group $groups\n";
			$nextNodes[] = array_keys($connections)[0];
			$finalNodes = [];
			while (count($nextNodes)) {
				$nextNode = array_pop($nextNodes);
				#echo "Next node: $nextNode\n";
				#print_r($nextNodes);

				if (!isset($connections[$nextNode])) {
					continue;
				}

				foreach ($connections[$nextNode] as $connectedNode) {
					if (!in_array($connectedNode, $finalNodes)) {
						$finalNodes[] = $connectedNode;
						$nextNodes[] = $connectedNode;
					}
				}

				unset($connections[$nextNode]);
			}
		}

		return $groups;
	}
}