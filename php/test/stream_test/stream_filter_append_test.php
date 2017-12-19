<?php
/**
 * @desc
 * @author 刘阳(lanmo1945@163.com)
 * @date   2017/12/16 23:03
 */
$fp = fopen(__DIR__ . DIRECTORY_SEPARATOR . 'test.txt', 'w+');

//---add string.rot13 filter to write stream
stream_filter_append($fp, 'string.rot13', STREAM_FILTER_WRITE);

//---write data though string.rot13 filter
fwrite($fp, 'This is a test' . PHP_EOL);

//---rewind the fp
rewind($fp);

fpassthru($fp);
fclose($fp);