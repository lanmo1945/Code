<?php
/**
 * @desc
 * @author 刘阳(lanmo1945@163.com)
 * @date   2017/12/16 19:15
 */

echo 'Wrapper list:' . PHP_EOL;
print_r(stream_get_wrappers());
echo PHP_EOL;

echo 'Transport list:' . PHP_EOL;
print_r(stream_get_transports());
echo PHP_EOL;

echo 'Filter list:' . PHP_EOL;
print_r(stream_get_filters());
echo PHP_EOL;

var_dump(get_magic_quotes_gpc());