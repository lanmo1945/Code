<?php
error_reporting(E_ALL);
set_time_limit(0);

$server_host = '127.0.1';
$port = 10005;

// 创建socke
if(!$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP))
{
	die('socket_create() failed: reason:' . socket_strerror(socket_last_error()) . "\n");
}

// 连接服务器
if(!$result = socket_connect($socket, $server_host, $port))
{
	die('socket_connect() failed: reason:' . socket_strerror(socket_last_error($socket)) . "\n");
}
else
{
	echo "connect servert $server_host:$port ok!\n";
}

// 发送信息
$msg_send = "Client: message send\r\n\r\n";
echo "send message:\n";
if(false === socket_write($socket, $msg_send, strlen($msg_send)))
{
	die('socket_send() failed: reason:' . socket_strerror(socket_last_error($socket)) . "\n");
}
else
{
	echo "send message ok!\n";
}

// 读取信息
// $count = 0;
echo "Read response message:\n";
$out = socket_read($socket, 8192, PHP_NORMAL_READ);
echo $out;
// while($out = socket_read($socket, 8192, PHP_NORMAL_READ))
// {
// 	echo $out;
// 	echo "\n" . $count++ . "\n";
// 	sleep(1);
// }

// 关闭socket
echo "socket_close:\n";
socket_close($socket);
echo "socket_ok!\n";

