<?php
/**
 * @desc
 * @author 刘阳(lanmo1945@163.com)
 * @date   2017/12/16 17:37
 */
$post_ = array (
    'author' => 'Gonn',
    'mail'=>'gonn@nowamagic.net',
    'url'=>'http://www.nowamagic.net/',
    'text'=>'欢迎访问简明现代魔法');
$data = http_build_query($post_);

$opts = array(
    'http' => array(
        'method' => 'POST',
        'header' => "Content-Type: application/x-www-form-urlencoded\r\n" .
                    "Content-Length: " . strlen($data) . "\r\n",
        'content' => $data,
    ),
);

$context = stream_context_create($opts);
$result = file_get_contents('http://nowamagic.net', false, $context);
var_dump($result);