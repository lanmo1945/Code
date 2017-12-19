<?php
/**
 * @desc
 * @author 刘阳(lanmo1945@163.com)
 * @date   2017/12/17 18:22
 */

/**
 * @desc  post
 * @param string $url
 * @param string $data
 * @return bool|string
 */
function post($url, $data = '')
{
    if(false == is_string($data))
    {
        $data = http_build_query($data);
    }

    $option = array(
        'http' => array(
            'method' => 'POST',
            'header' => 'Content-Type: application/x-www-form-urlencoded',
            'content' => $data,
            'timeout' => 60,
        ),
    );
    $context = stream_context_create($option);
    return file_get_contents($url, false, $context);
}

/**
 * @desc  get
 * @param string $url
 * @return bool|string
 */
function get($url)
{
    $option = array(
        'http' => array(
            'method' => 'GET',
            'timeout' => 60,
        ),
    );
    $context = stream_context_create($option);
    return file_get_contents($url, false, $context);
}

//$postResult = post('http://www.baidu.com', array('wd' => 123,));
//$postResult = mb_convert_encoding($postResult, 'GBK');
//echo $postResult;

$getResult = get('http://www.baidu.com');
$getResult = mb_convert_encoding($getResult, 'GBK');
echo $getResult;

if($getResult instanceof Traversable)
{

}