<?php
/*
 * 不使用apache，cli模式
 * 客户端
 */
class SocketClient {

    protected $client;
    protected $message;

    public function __construct($domain, $port) {
        $this->init();
        $this->client = stream_socket_client("tcp://$domain:$port", $errno, $errstr, 300000);
        if (!$this->client) {
            self::log("$errstr ($errno)");
            return false;
        }
        self::log('client ok');
    }

    protected static function init() {
        error_reporting(E_ALL ^ E_NOTICE);
        //error_reporting(0);
        set_time_limit(0);
        ob_implicit_flush();
        date_default_timezone_set('Asia/Shanghai');
        ignore_user_abort(true);
        // mb_internal_encoding('gbk');
    }

    public function sendMessage($msg) {
        if ($msg === '') {
            return -1;
        }
        try {
            stream_socket_sendto($this->client, $msg);
        } catch (Exception $exc) {
            //$this->log($exc->getTraceAsString());
        }
    }

    public function getMessage() {
        $this->message = stream_socket_recvfrom($this->client, 10270000);
        //$this->log("收到消息:");
        //$this->log($this->message);
        fwrite(STDOUT, $this->message . "\r\n");
    }

    public function shutdown() {
        stream_socket_shutdown($this->client, STREAM_SHUT_RDWR);
        fclose($this->client);
    }

    public static function log($message) {
        echo "\r\n" . $message . "\r\n";
    }

}

//

$client = new SocketClient('127.0.0.1',12345);
while (true) {
    $msg = fread(STDIN, 9999999);
    if (!trim($msg)) {
        continue;
    }
    $client->sendMessage($msg);
    $client->getMessage();
}

