<?php
declare(strict_types=1);

namespace AdventOfCode2017;

class Day19 {

	private $step = [
		'down'  => [ 'x' =>  0, 'y' =>  1 ],
		'up'    => [ 'x' =>  0, 'y' => -1 ],
		'left'  => [ 'x' => -1, 'y' =>  0 ],
		'right' => [ 'x' =>  1, 'y' =>  0 ],
	];

	function printGrid(array $grid) {
		foreach ($grid as $row) {
			echo join('', $row) . "\n";
		}
	}

	function solvePart1(string $input): string {
		$lines = explode("\n", $input);

		$grid = [];
		foreach ($lines as $y => $line) {
			$grid[$y] = str_split($line);
		}

		#echo "\n";
		#$this->printGrid($grid);

		$x = 0;
		$y = 0;
		$width = count($grid[0]);
		for($i = 0; $i < $width; $i++) {
			if ($grid[0][$i] === '|') {
				$x = $i;
				break;
			}
		}

		#echo "Start: [$x, $y]\n";
		$direction = 'down';
		$result = "";

		while(true) {

			$x += $this->step[$direction]['x'];
			$y += $this->step[$direction]['y'];

			#echo "Position: [$x, $y] Direction: $direction\n";
			switch ($grid[$y][$x]) {
				case '|':
					// pass on
					break;
				case '-':
					// pass on
					break;
				case ' ':
					//stop
					#echo "Stop\n";
					break 2;
				case '+':
					if ($direction === 'down' || $direction === 'up') {
						if (isset($grid[$y][$x-1]) && $grid[$y][$x-1] !== ' ') {
							$direction = 'left';
						} else if (isset($grid[$y][$x+1]) && $grid[$y][$x+1] !== ' ') {
							$direction = 'right';
						} else {
							echo "Failed\n";
						}
					} else if ($direction === 'left' || $direction === 'right') {
						if (isset($grid[$y-1][$x]) && $grid[$y-1][$x] !== ' ') {
							$direction = 'up';
						} else if (isset($grid[$y+1][$x]) && $grid[$y+1][$x] !== ' ') {
							$direction = 'down';
						} else {
							echo "Failed\n";
						}
					} else {
						echo "Möööööp\n";
					}
					break;
				default:
					$result .= $grid[$y][$x];
					break;
			}
		}

		return $result;
	}

	function solvePart2(string $input): int {
		$lines = explode("\n", $input);

		$grid = [];
		foreach ($lines as $y => $line) {
			$grid[$y] = str_split($line);
		}

		#echo "\n";
		#$this->printGrid($grid);

		$x = 0;
		$y = 0;
		$width = count($grid[0]);
		for($i = 0; $i < $width; $i++) {
			if ($grid[0][$i] === '|') {
				$x = $i;
				break;
			}
		}

		#echo "Start: [$x, $y]\n";
		$direction = 'down';
		$result = "";
		$count = 0;

		while(true) {
			$count++;

			$x += $this->step[$direction]['x'];
			$y += $this->step[$direction]['y'];

			#echo "Position: [$x, $y] Direction: $direction\n";
			switch ($grid[$y][$x]) {
				case '|':
					// pass on
					break;
				case '-':
					// pass on
					break;
				case ' ':
					//stop
					#echo "Stop\n";
					break 2;
				case '+':
					if ($direction === 'down' || $direction === 'up') {
						if (isset($grid[$y][$x-1]) && $grid[$y][$x-1] !== ' ') {
							$direction = 'left';
						} else if (isset($grid[$y][$x+1]) && $grid[$y][$x+1] !== ' ') {
							$direction = 'right';
						} else {
							echo "Failed\n";
						}
					} else if ($direction === 'left' || $direction === 'right') {
						if (isset($grid[$y-1][$x]) && $grid[$y-1][$x] !== ' ') {
							$direction = 'up';
						} else if (isset($grid[$y+1][$x]) && $grid[$y+1][$x] !== ' ') {
							$direction = 'down';
						} else {
							echo "Failed\n";
						}
					} else {
						echo "Möööööp\n";
					}
					break;
				default:
					$result .= $grid[$y][$x];
					break;
			}
		}

		return $count;
	}

}