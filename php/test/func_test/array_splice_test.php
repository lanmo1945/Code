<?php
/**
 * @desc
 * @author 刘阳(lanmo1945@163.com)
 * @date   2017/12/17 15:05
 */
$a = array('Dog', 'Cat', 'Horse', 'Bird');
$b = array('Tiger', 'Lion');
$c = array_splice($a, 0, 2, $b);

print_r($a);
print_r($c);
echo '-----------------------------' . PHP_EOL;

$c = array_splice($a, 2, 0, $c);
print_r($a);
print_r($c);

shuffle($a);
print_r($a);
print_r(array_rand($a));