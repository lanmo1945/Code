<?php

/**
* 
*/
class WebSocketServer
{
	protected $scoket;
	protected $host;
	protected $port;
	protected $maxuser;
	protected $cycle;
	protected $accept;

	public function __construct($args = null)
	{
		# code...
	}

	public function start_server()
	{
		// 创建scoket
		$this->scoket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

		// 允许使用本地地址
		// 绑定地址，端口
		socket_set_option($this->scoket, SOL_SOCKET, SO_REUSEADDR, true);
		socket_bind($this->scoket, $this->host, $this->port);

		// 最多10个人连接，超过的客户端连接会返回WSAECONNREFUSED错误
		// 监听
		socket_listen($this->scoket, $this->maxuser);

		while (true) {
			# code...


		}
	}
}