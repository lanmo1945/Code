<?php
date_default_timezone_set('PRC');
echo 'zuotian: ' . date('Y-m-d', strtotime('-1 day')) . "\n";
echo 'houtian: ' . date('Y-m-d', strtotime('1 day')) . "\n";
echo 'yizhouhou: ' . date('Y-m-d', strtotime('1 week')) . "\n";
