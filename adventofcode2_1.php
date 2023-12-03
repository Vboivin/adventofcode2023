<?php
declare(strict_types=1);

const INPUT = 'input2_1.txt';
const RED_MAX = 12;
const GREEN_MAX = 13;
const BLUE_MAX = 14;

$fd = fopen(INPUT, 'r');
if (!$fd) {
    error_log('Could not find ' . INPUT, 1, '/dev/stderr');
    return 1;
}
[$sum, $gameId] = array(0, 1);
while (($line = fgets($fd)) !== false) {
    $isPossible = true;
    $game = explode(':', $line);
    $rounds = explode(';', $game[1]);
    foreach ($rounds as $round) {
        [$red, $green, $blue] = array(0, 0, 0);
        $cubes = explode(',', $round);
        foreach ($cubes as $cube) {
            [$qty, $color] = explode(' ', trim($cube));
            match ($color) {
                'red' => $red += (int)$qty,
                'green' => $green += (int)$qty,
                'blue' => $blue += (int)$qty,
                default => 0,
            };
        }
        if ($red > RED_MAX || $blue > BLUE_MAX || $green > GREEN_MAX) {
            $isPossible = false;
            break;
        }
    }
    if ($isPossible) {
        $sum += $gameId;
    }
    $gameId++;
}
error_log((string)$sum, 0, '/dev/stderr');
return 0;
