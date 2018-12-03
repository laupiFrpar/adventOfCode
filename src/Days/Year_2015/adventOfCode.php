<?php

for ($day = 1; $day <= 24; $day++) {
    $filename = __DIR__ . '/day_' . str_pad($day, 2, '0', STR_PAD_LEFT) . '.php';

    if (!file_exists($filename)) {
        break;
    }

    include($filename);
}
