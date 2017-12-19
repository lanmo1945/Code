<?php
error_reporting(E_ALL);
set_time_limit(0);
ini_set('memory_limit', '128M');

$host = '127.0.0.1';
$port = 10005;

// 创建端口
if(!$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP))
{
	die('socket_create failed. Reason: '. socket_strerror(socket_last_error()) . "\n");
}

// 绑定
if(false === socket_bind($socket, $host, $port))
{
	die('socket_bind failed. Reason: '. socket_strerror(socket_last_error($socket)) . "\n");
}

//阻塞模式
socket_set_block($socket) or die("socket_set_block() 失败的原因是:" . socket_strerror(socket_last_error()) . "/n");

// 监听
if(false === socket_listen($socket, 5))
{
	die('socket_listen failed. Reason: '. socket_strerror(socket_last_error($socket)) . "\n");
}

do
{
	// 得到一个连接
	if(!$msgsocket = socket_accept($socket))
	{
		die('socket_accept failed. Reason: '. socket_strerror(socket_last_error($socket)) . "\n");
	}

	// 发送消息到客户端
	$msg = 'server send: Hello world!' . "\n";
	socket_write($msgsocket, $msg, strlen($msg));

	// read
	echo "read client mesage.\n";
	$buffer = socket_read($msgsocket, 8192);
	$talkback = "received message: $buffer\n";
	echo $talkback;

	// send
	if(false === socket_write($msgsocket, $talkback, strlen($talkback)))
	{
		die('socket_write failed. Reason: '. socket_strerror(socket_last_error($socket)) . "\n");
	}
	else
	{
		echo "send success!\n\n\n\n";
	}

	sleep(1);
} while (true);

// 关闭socket
socket_close($socket);


