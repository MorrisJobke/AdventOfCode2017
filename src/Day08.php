<?php
declare(strict_types=1);

namespace AdventOfCode2017;

class Day08 {

	private $registers = [];

	function solvePart1(string $input): int {
		$instructions = explode("\n", $input);

		foreach ($instructions as $instruction) {
			list($register, $operation, $amount, $if, $checkRegister, $comparision, $compareTo) = explode(' ', $instruction);
			if (!isset($this->registers[$register])) {
				$this->registers[$register] = 0;
			}
			if (!isset($this->registers[$checkRegister])) {
				$this->registers[$checkRegister] = 0;
			}

			switch ($comparision) {
				case '>':
					$execute = $this->registers[$checkRegister] > $compareTo;
					break;
				case '<':
					$execute = $this->registers[$checkRegister] < $compareTo;
					break;
				case '>=':
					$execute = $this->registers[$checkRegister] >= $compareTo;
					break;
				case '==':
					$execute = $this->registers[$checkRegister] == $compareTo;
					break;
				case '<=':
					$execute = $this->registers[$checkRegister] <= $compareTo;
					break;
				case '!=':
					$execute = $this->registers[$checkRegister] != $compareTo;
					break;
				default:
					throw new \Exception("Unknown comparision: $comparision");
			}
			if ($execute) {
				if ($operation === 'dec') {
					$amount *= -1;
				}
				$this->registers[$register] += $amount;
			}
		}

		return max($this->registers);
	}

	function solvePart2(string $input): int {
		$instructions = explode("\n", $input);
		$max = -INF;

		foreach ($instructions as $instruction) {
			list($register, $operation, $amount, $if, $checkRegister, $comparision, $compareTo) = explode(' ', $instruction);
			if (!isset($this->registers[$register])) {
				$this->registers[$register] = 0;
			}
			if (!isset($this->registers[$checkRegister])) {
				$this->registers[$checkRegister] = 0;
			}

			switch ($comparision) {
				case '>':
					$execute = $this->registers[$checkRegister] > $compareTo;
					break;
				case '<':
					$execute = $this->registers[$checkRegister] < $compareTo;
					break;
				case '>=':
					$execute = $this->registers[$checkRegister] >= $compareTo;
					break;
				case '==':
					$execute = $this->registers[$checkRegister] == $compareTo;
					break;
				case '<=':
					$execute = $this->registers[$checkRegister] <= $compareTo;
					break;
				case '!=':
					$execute = $this->registers[$checkRegister] != $compareTo;
					break;
				default:
					throw new \Exception("Unknown comparision: $comparision");
			}
			if ($execute) {
				if ($operation === 'dec') {
					$amount *= -1;
				}
				$this->registers[$register] += $amount;
				$max = max($max, $this->registers[$register]);
			}
		}

		return $max;
	}
}