<?php

$n = 9;

for ($i = 0; $i < $n * 2; $i++) {
    if ($i < $n) {
        $result = ($i + 1) * 2 - 1;
    }
    else {
        $x = abs($n * 2 - $i);
        $result = $x * 2;
    }

    echo $result . ' ';
}
