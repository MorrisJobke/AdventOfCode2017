<?php
declare(strict_types=1);

namespace AdventOfCode2017;

class Day13 {

	private $delayCacheNumber = 0;
	private $delayCache = null;
	private $multiples = [];

	function printFirewall(array $firewall) {
		echo "\n";
		$height = max(array_map('count', $firewall));
		$width = max(array_keys($firewall));

		for ($x = 0; $x < $width + 1; $x++) {
			printf('%2d  ', $x);
		}
		echo "\n";
		for ($y = 0; $y < $height + 1; $y++) {
			for ($x = 0; $x < $width + 1; $x++) {
				if (isset($firewall[$x][$y])) {
					echo "[" . $firewall[$x][$y] . "] ";
				} else {
					echo "    ";
				}
			}
			echo "\n";
		}
	}

	function step(array $firewall): array {
		foreach ($firewall as &$layer) {
			$downKey = array_search('d', $layer);
			if ($downKey !== false) {
				$layer[$downKey] = ' ';
				if (($downKey + 1) === count($layer)) {
					$layer[$downKey - 1] = 'u';
				} else {
					$layer[$downKey + 1] = 'd';
				}
			} else {
				$upKey = array_search('u', $layer);
				$layer[$upKey] = ' ';
				if ($upKey === 0) {
					$layer[$upKey + 1] = 'd';
				} else {
					$layer[$upKey - 1] = 'u';
				}
			}
		}
		return $firewall;
	}

	function solvePart1(string $input): int {
		$lines = explode("\n", $input);
		$firewall = [];
		foreach($lines as $line) {
			$parts = explode(":", $line);
			$index = (int)$parts[0];
			$range = (int)trim($parts[1]);
			$firewall[$index] = array_fill(0, $range, ' ');
			$firewall[$index][0] = 'd';
		}

		$steps = max(array_keys($firewall)) + 1;
		$result = 0;
		for ($i = 0; $i < $steps; $i++) {
			#echo "\nstep $i";
			if (isset($firewall[$i])) {
				if ($firewall[$i][0] !== ' ') {
					$result += $i * count($firewall[$i]);
				}
			}
			#$this->printFirewall($firewall);
			$firewall = $this->step($firewall);
		}

		#$this->printFirewall($firewall);

		return $result;
	}
	function helperPart2(string $input, int $delay): bool {
		if (isset($this->multiples[$delay])) {
			return true;
		}

		$lines = explode("\n", $input);
		$firewall = [];
		foreach($lines as $line) {
			$parts = explode(":", $line);
			$index = (int)$parts[0];
			$range = (int)trim($parts[1]);
			$firewall[$index] = array_fill(0, $range, ' ');
			$firewall[$index][0] = 'd';
		}

		if ($this->delayCache !== null) {
			$firewall = $this->delayCache;
		}
		for ($i = $this->delayCacheNumber; $i < $delay; $i++) {
			$firewall = $this->step($firewall);
		}
		$this->delayCacheNumber = $delay;
		$this->delayCache = $firewall;

		$steps = max(array_keys($firewall)) + 1;
		$caught = false;
		for ($i = 0; $i < $steps; $i++) {
			#echo "\nstep $i";
			if (isset($firewall[$i])) {
				if ($firewall[$i][0] !== ' ') {
					$caught = true;

					$factor = (count($firewall[$i]) - 1) * 2;
					for ($i = 0; $i < 500000; $i++) {
						$multiple = $delay + $i * $factor;
						$this->multiples[$multiple] = true;
						if ($multiple > 5000200) {
							break;
						}
					}
					break;
				}
			}
			#$this->printFirewall($firewall);
			$firewall = $this->step($firewall);
		}

		#$this->printFirewall($firewall);

		return $caught;
	}


	function solvePart2(string $input): int {
		$delay = 0;
		while($this->helperPart2($input, $delay)) {
			$delay++;
			if ($delay > 5000000) {
				break;
			}
		}

		return $delay;
	}
}