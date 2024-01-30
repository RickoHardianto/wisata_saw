<?php

$alternatif = array();
$kriteria = array();
$r = array();

$kriteria[] = 'C1';
$kriteria[] = 'C2';
$kriteria[] = 'C3';
$kriteria[] = 'C4';
$kriteria[] = 'C5';

$alternatif[] = array('A1', 4.3, 12000, 3, 5, 3);
$alternatif[] = array('A2', 3, 10000, 3, 4, 2);
$alternatif[] = array('A3', 5, 11000, 3, 3, 1);
$alternatif[] = array('A4', 4, 15000, 3, 5, 4);
$alternatif[] = array('A5', 3.3, 15000, 3, 5, 5);

$index_alternatif = 1;
foreach ($alternatif as $alt) {
    $index_kriteria = 1;
    foreach ($kriteria as $kri) {
        if ($kri == 'C1') {
            $r[$index_alternatif][$index_kriteria] = max(array_column($alternatif, $index_kriteria)) / $alternatif[$index_alternatif][$index_kriteria];
        } else if ($kri == 'C2') {
            $r[$index_alternatif][$index_kriteria] = min(array_column($alternatif, $index_kriteria)) / $alternatif[$index_alternatif][$index_kriteria];
        } else if ($kri == 'C3' || $kri == 'C4') {
            $r[$index_alternatif][$index_kriteria] = max(array_column($alternatif, $index_kriteria)) / $alternatif[$index_alternatif][$index_kriteria];
        }
        $index_kriteria++;
    }
    $index_alternatif++;
}


print_r($r);
