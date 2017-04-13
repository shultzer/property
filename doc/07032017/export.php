<?php
require_once "core/functions.php";
require_once "core/data.php";

if(! isset($_COOKIE['history'])){
    goBack();
    die;
}
$fileName = time() . '_export.csv';
header('Content-Type: text/csv;charset=windows-1251');
header('Content-Disposition: attachment; filename="'.$fileName.'"');


$titles = array_map(function($title){
    return iconv('utf-8', 'windows-1251', $title);
}, ["Ряды","Колонки","Цвет","Дата"]);

$history = unserialize($_COOKIE['history']);
echo implode(';', $titles) . "\n";
array_walk($history, function($h) {
    $h['date'] = date('d-m-Y H:i:s', $h['date']);
    echo implode(';', $h) . "\n";
});
