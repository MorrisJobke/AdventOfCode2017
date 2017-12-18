<?php
declare(strict_types=1);

namespace AdventOfCode2017;

class AbcException extends \Exception {}

class Day18 {

	private $registers = [];
	private $lastSound = 0;

	/**
	 * @param $instruction
	 * @throws AbcException
	 */
	function doIt($instruction) {
		$parts = explode(' ', $instruction);

		if (!is_numeric($parts[1]) && !isset($this->registers[$parts[1]])) {
			$this->registers[$parts[1]] = 0;
		}
		if (isset($parts[2]) &&!is_numeric($parts[2]) && !isset($this->registers[$parts[2]])) {
			$this->registers[$parts[2]] = 0;
		}

		$jump = 1;
		switch($parts[0]) {
			case 'snd':
				if (is_numeric($parts[1])) {
					$this->lastSound = (int)$parts[1];
				} else {
					$this->lastSound = $this->registers[$parts[1]];
				}
				break;
			case 'set':
				if (is_numeric($parts[2])) {
					$this->registers[$parts[1]] = (int)$parts[2];
				} else {
					$this->registers[$parts[1]] = $this->registers[$parts[2]];
				}
				break;
			case 'add':
				if (is_numeric($parts[2])) {
					$this->registers[$parts[1]] += (int)$parts[2];
				} else {
					$this->registers[$parts[1]] += $this->registers[$parts[2]];
				}
				break;
			case 'mul':
				if (is_numeric($parts[2])) {
					$this->registers[$parts[1]] *= (int)$parts[2];
				} else {
					$this->registers[$parts[1]] *= $this->registers[$parts[2]];
				}
				break;
			case 'mod':
				if (is_numeric($parts[2])) {
					$this->registers[$parts[1]] %= (int)$parts[2];
				} else {
					$this->registers[$parts[1]] %= $this->registers[$parts[2]];
				}
				break;
			case 'jgz':
				if ($this->registers[$parts[1]] > 0) {
					if (is_numeric($parts[2])) {
						$jump = (int)$parts[2];
					} else {
						$jump = $this->registers[$parts[2]];
					}
				}
				break;
			case 'rcv':
				if (is_numeric($parts[1])) {
					if ($parts[1] !== 0) {
						throw new AbcException();
					}
				} else {
					if ($this->registers[$parts[1]] !== 0) {
						throw new AbcException();
					}
				}
				break;
		}

		return $jump;
	}

	function solvePart1(string $input): int {
		$instructions = explode("\n", $input);

		try {

			$i = 0;
			$length = count($instructions);
			while (true) {
				$i = ($i + $this->doIt($instructions[$i])) % $length;
			}
		} catch (AbcException $e) {
			return $this->lastSound;
		}
		echo "Boom\n";
	}

}