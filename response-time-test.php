<?php
// This script uses cURL to measure server response time over $iterations it compares the difference between $url1 and $url2

$iterations = $argv[1] ?? 500;

$url1 = $argv[2] ?? 'https://127.0.0.1:8010';
$url2 = $argv[3] ?? 'https://127.0.0.1:8011';

$total1 = 0;
$total2 = 0;

for ($i = 0; $i < $iterations; $i++) {
    exec('curl -s -w \'%{time_total}\' -o /dev/null ' . $url1, $r1);
    
    $total1 += (double) $r1[0];
    
    exec('curl -s -w \'%{time_total}\' -o /dev/null ' . $url2, $r2);
    
    $total2 += (double) $r2[0];

}

echo "Total for $url1: $total1\n";
echo "Total for $url2: $total2\n";

$total = $total2-$total1;
echo "Difference: $total\n";

echo "Percentage:" . (min($total1, $total2) / max($total1, $total2))*100;


