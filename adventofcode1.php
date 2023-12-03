<?php
declare(strict_types=1);

const INPUT = 'input1.txt';
$fd = fopen(INPUT, 'r');
if (!$fd) {
    error_log('Could not find ' . INPUT, 1, '/dev/stderr');
    return 1;
}
$sum = 0;
while (($line = fgets($fd)) !== false) {
   [$first, $last] = array('', '');
    foreach (str_split($line) as $character) {
        if (is_numeric($character)) {
            if (empty($first)) {
                $first = $character;
            }
            $last = $character;
        }
    }
    $sum += (((int)$first) * 10 + (int)$last);
}
error_log((string)$sum, 0, '/dev/stderr');
return 0;
