<?php
/*
 * 不使用apache，cli模式
 * 命令接收端
 * 单用户，即单连接
 */
/**
 * 命令接收端Messenger
 * 单线程
 */
class SocketServer
{
	protected $ip;
	protected $port;
	protected $webSocket;
	protected $users;
	protected $userIndex = 0;
	protected $message;

	public function __construct($ip = '127.0.0.1', $port = 12345)
	{
		# code...
		$this->ip = $ip;
		$this->port = $port;
		self::init();
		$this->createServer();
		self::log('listenning user...');
		$this->listenningUser();
	}

	protected function createServer()
	{
		$errno;
		$errstr;
		$this->webSocket = stream_socket_server('tcp://' . $this->ip . ':' . $this->port,
			$errno, $errstr);
		if(!$this->webSocket)
		{
			self::log("$errstr ($errno)");
			exit(1);
		}
		self::log('Create server ok!');
	}

	protected function listenningUser()
	{
		while (true) {
			# code...
			$this->userIndex++;
			$user = $this->users[$this->userIndex]
			= stream_socket_accept($this->webSocket, 9999999999);

			if (is_resource($u = $this->users[$this->userIndex - 1]))
			{
				# code...
				$u->close();
				$u = null;
				unset($this->users[$this->userIndex - 1]);
			}
			self::log('connect new user!');
			$this->listenningMessage();
		}
	}

	protected function listenningMessage()
	{
		while (is_resource($u = $this->users[$this->userIndex])) {
			# code...
			$this->message = stream_socket_recvfrom($u, 10270000);
			if(!$this->message)
			{
				$this->closeUser();
				break;
			}
			$this->messageOperate();
		}
	}

	protected function messageOperate()
	{
		self::log('收到消息：');
		self::log($this->message);
		$this->sendMessage('done!');
	}

	public function sendMessage($msg)
	{
		if('' === $msg)
		{
			return -1;
		}
		return stream_socket_sendto($this->users[$this->userIndex], $msg);
	}

	protected function closeUser() {
        if (!is_resource($this->users[$this->userIndex]))
            return false;
        @stream_socket_shutdown($this->users[$this->userIndex], STREAM_SHUT_RDWR);
        @fclose($this->users[$this->userIndex]);
        self::log("用户连接断开.");
        return true;
    }

    public function shutdown() {
        stream_socket_shutdown($this->webSocket, STREAM_SHUT_RDWR);
        fclose($this->webSocket);
    }

	protected static function init()
	{
		error_reporting(E_ALL ^ E_NOTICE);
		set_time_limit(0);
		ob_implicit_flush();
		date_default_timezone_set('Aisa/ShangHai');
		ignore_user_abort(true);
		// mb_internal_encoding('gbk');
	}

	public static function log($msg)
	{
		echo "\r\n$msg\r\n";
	}
}

$server = new SocketServer();