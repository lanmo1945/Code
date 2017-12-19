<?php
// is_numeric
// is_float, is_double, is_real, is_int, is_integer, is_long
var_dump(is_numeric('5.1'));

// abs
$delta = 0.00001;
$a = 1.00000001;
$b = 1.00000000;
var_dump(abs($a - $b) < $delta);

// round, ceil, floor
var_dump(round(2.4));
var_dump(ceil(2.4));
var_dump(floor(2.4));

// 如果一个数位于两个整数之间，PHP会向远离0的方向取整
var_dump(round(2.5)); // 3
var_dump(round(-2.5)); // -3

// range $start可以比$end小，表示得到一个降序序列
// range生成一个闭合区间
var_dump(range(4, 1));

// mt_rand 生成一个闭合区间
var_dump(mt_getrandmax());
var_dump(mt_rand());
var_dump(mt_rand(1, 12));

// pc_rand_weighted 加权随机数
function pc_rand_weighted($numbers)
{
	$total = 0;
	foreach ($numbers as $number => $weight) {
		# code...
		$total += $weight;
		$distribution[$number] = $total;
	}
	// var_dump($distribution);

	$rand = mt_rand(0, $total - 1);
	foreach ($distribution as $number => $weights) {
		# code...
		if ($rand < $weights) {
			# code...
			return $number;
		}
	}
}

$ads = [
	'ford' => 12234,
	'att' => 46823,
	'ibm' => 33424
	];

var_dump(pc_rand_weighted($ads));
// $arr_ad_count = ['ford' => 0, 'att' => 0, 'ibm' => 0];
// for ($i=0; $i < 100; $i++) {
// 	# code...
// 	$arr_ad_count[pc_rand_weighted($ads)]++;
// }
// var_dump($arr_ad_count);

// log, log10
// log10(10) e
// log(10, 2)

// exp, pow
// number_format
$num = 1234.56;
var_dump(number_format($num));
var_dump(number_format($num, 2, '@', '#'));

list($int, $dec) = explode('.', $num);
var_dump(number_format($num, strlen($dec)));

// setlocale(LC_ALL, 'zh_CN');
// print_r(localeconv());

// money_format
// 使用Unix底层strfmon函数，对于windows无效
// $money = 1234.56;
// setlocale(LC_MONETARY, 'en_US');
// var_dump(money_format('%n', $money));
// var_dump(money_format('%i', $money));

// bccomp BCMath PHP捆绑
// gmp_cmp() gmpMath BMP 需要下载安装
// BI库 PECL big_int
var_dump(function_exists('bcadd'));
var_dump(function_exists('gmp_gcd'));
var_dump(function_exists('bi_add'));

// base_convert 2~36进制
var_dump(base_convert('a1', 16, 10));

// mktime, date, time
// strftime, getdate, localtime
// gmmktime, date_default_timezone_set
// checkdate, strtotime
// preg_match