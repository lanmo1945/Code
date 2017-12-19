<?php
// here doc
$str = '999';
$doc = '123' . <<< DOC
	This is the Doc.
	Please notice it.
	Thanks,
	Tony
	$str
DOC
. '456';
echo $doc . "\n";

// strpos
var_dump(strpos($doc, '@'));

// substr
var_dump(substr($doc, 1, 4));
var_dump(substr($doc, 1));
var_dump(substr($doc, 90));
var_dump(substr($doc, 1, 90));
var_dump(substr($doc, -1, 3));
var_dump(substr($doc, -99, 3));
var_dump(substr($doc, -99, -3));
var_dump(substr($doc, -2, -1));
var_dump(substr($doc, 10, -2));

// substr_replace
$str = 'My pet is a blue dog.';
var_dump(substr_replace($str, 'fish.', 12));
var_dump(substr_replace($str, 'green', 12, 4));
var_dump(substr_replace($str, 'fish.', -9));
var_dump(substr_replace($str, 'green', -9, 4));
var_dump(substr_replace($str, 'green', -9, -5));
var_dump(substr_replace($str, 'Title: ', 0, 0));
var_dump(substr_replace($str, 'green', 999, 4));
var_dump(substr_replace($str, 'green', 999, 999));
var_dump(substr_replace($str, 'green', -999, 999));
var_dump(substr_replace($str, 'green', 999, -999));
var_dump(substr_replace($str, 'green', -999, -999));

// for
for ($i = 1, $j = 0; $i <= 10; $j += $i, var_dump($j),$i++);

// strrev
var_dump(strrev($str));

// array_reverse
$arr = [1, 2, 3, 4, 5];
var_dump(array_reverse($arr));
var_dump(array_reverse($arr, true));

// strstr
var_dump(strstr($str, 'is'));
var_dump(strstr($str, 'is', true));

// str_replace
// ltrim, rtrim, trim
// fputcsv, fgetcsv
// pack, substr, str_pad
// unpack, str_split
// explode, split, preg_split
// wordwarp
$pack = pack('S4', 1074, 106, 28225, 32725);
var_dump($pack);
var_dump(unpack('S4', $pack));
var_dump(unpack('S4num', $pack));
var_dump(unpack('S1a/S1b/S1c/S1d', $pack));

$s = 'abcdefghijklmnopqrstuvwxyz';
$s = strtoupper($s);
$ascii = unpack('c*', $s);
var_dump($ascii);
