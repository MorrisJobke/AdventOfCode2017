<?php
declare(strict_types=1);

namespace AdventOfCode2017;

class Day20 {

	function parseParticle(string $input): array {
		preg_match('!p=< *(.*), *(.*), *(.*)>, v=< *(.*), *(.*), *(.*)>, a=< *(.*), *(.*), *(.*)>!', $input, $matches);
		return [
			'position' => [
				(int)$matches[1],
				(int)$matches[2],
				(int)$matches[3],
			],
			'velocity' => [
				(int)$matches[4],
				(int)$matches[5],
				(int)$matches[6],
			],
			'acceleration' => [
				(int)$matches[7],
				(int)$matches[8],
				(int)$matches[9],
			],
		];
	}

	function tick(array $particles): array {

		foreach ($particles as &$particle) {
			$particle['velocity'][0] += $particle['acceleration'][0];
			$particle['velocity'][1] += $particle['acceleration'][1];
			$particle['velocity'][2] += $particle['acceleration'][2];
			$particle['position'][0] += $particle['velocity'][0];
			$particle['position'][1] += $particle['velocity'][1];
			$particle['position'][2] += $particle['velocity'][2];
		}

		return $particles;
	}

	function solvePart1(string $input): int {
		$lines = explode("\n", $input);
		$particles = [];
		foreach ($lines as $line) {
			$particles[] = $this->parseParticle($line);
		}

		for ($i = 0; $i < 1000; $i++) {
			$particles = $this->tick($particles);
			/*$min = INF;
			$result = NULL;
			foreach ($particles as $index => $particle) {
				$manhattan = abs($particle['position'][0]) + abs($particle['position'][1]) + abs($particle['position'][2]);
				if ($manhattan < $min) {
					$result = $index;
					$min = $manhattan;
				}
			}

			echo "Current: $result\n";*/
		}
		$min = INF;
		$result = NULL;
		foreach ($particles as $index => $particle) {
			$manhattan = abs($particle['position'][0]) + abs($particle['position'][1]) + abs($particle['position'][2]);
			if ($manhattan < $min) {
				$result = $index;
				$min = $manhattan;
			}
		}

		return $result;
	}

	function solvePart2(string $input): int {
		$lines = explode("\n", $input);
		$particles = [];
		foreach ($lines as $line) {
			$particles[] = $this->parseParticle($line);
		}

		echo "\n";

		for ($i = 0; $i < 1000; $i++) {
			$particles = $this->tick($particles);
			$min = INF;
			$map = [];
			$toDelete = [];
			foreach ($particles as $index => $particle) {
				$hashPosition = sprintf("%s+%s+%s", $particle['position'][0], $particle['position'][1], $particle['position'][2]);
				if (!isset($map[$hashPosition])) {
					$map[$hashPosition] = [];
				} else {
					if (!isset($map[$hashPosition][1])) {
						$toDelete[] = $map[$hashPosition][0];
					}
					$toDelete[] = $index;
				}
				$map[$hashPosition][] = $index;
			}

			foreach ($toDelete as $delete) {
				unset($particles[$delete]);
				#echo "Delete $delete\n";
			}
		}

		return count($particles);
	}


}