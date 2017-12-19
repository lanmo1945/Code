<?php
/**
 * @desc
 * @author 刘阳(lanmo1945@163.com)
 * @date   2017/12/16 23:24
 */
class MD5Filter extends php_user_filter
{
    public function filter($in, $out, &$consumed, $closing)
    {
        $data = '';
        while($bucket = stream_bucket_make_writeable($in))
        {
            $data .= $bucket->data;
            $bucket->data = md5($bucket->data);
            $consumed += $bucket->datalen;
            stream_bucket_append($out, $bucket);
        }
        call_user_func($this->params, $data);

        //---数据处理成功，可供其他管道读取
        return PSFS_PASS_ON;
    }
}

$callback = function($data) {
    if('' != trim($data))
    {
        file_put_contents(__DIR__ . DIRECTORY_SEPARATOR . 'log.txt', $data);
    }
};

stream_filter_register('string.md5', 'MD5Filter');

$fp = fopen(__DIR__ . DIRECTORY_SEPARATOR . 'test.txt', 'w+');
stream_filter_prepend($fp, 'string.md5', STREAM_FILTER_WRITE, $callback);

fwrite($fp, 'Hello world' . PHP_EOL);
rewind($fp);

fpassthru($fp);
fclose($fp);
