<?php

$row['visits'] = 10;
$row['freq_act'] = 10;
 $result = max((min(($row['visits']-$row['freq_act']),1)),-2);
 print_r($result);