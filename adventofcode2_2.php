<?php
declare(strict_types=1);

const INPUT = 'input2_2.txt';

$fd = fopen(INPUT, 'r');
if (!$fd) {
    error_log('Could not find ' . INPUT, 1, '/dev/stderr');
    return 1;
}
$sum = 0;
while (($line = fgets($fd)) !== false) {
    [$redMin, $greenMin, $blueMin] = array(0, 0, 0);
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
        $redMin = max($red, $redMin);
        $greenMin = max($green, $greenMin);
        $blueMin = max($blue, $blueMin);
    }
    $sum += ($redMin * $greenMin * $blueMin);
}
error_log((string)$sum, 0, '/dev/stderr');
return 0;
