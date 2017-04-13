<?php

function showFoldersAndFiles($path, $delimeter='')
{
    $dir = opendir($path);

    while ($d = readdir($dir)) {
        if ($d == '.' || $d == '..') {
            continue;
        }

        if (is_dir($path.'/'.$d)) {
            echo "{$delimeter}<strong>[$d]</strong><br>";
            showFoldersAndFiles($path.'/'.$d, $delimeter . '----');
        } else {
            echo "{$delimeter}$d<br>";
        }
    }

    closedir($dir);
}

showFoldersAndFiles('.');