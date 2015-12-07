<?php

for ($day = 1; $day <= 24; $day++) {
    $filename = __DIR__ . '/day_' . $day . '.php';

    if (!file_exists($filename)) {
        break;
    }

    include($filename);
}
