<?php

/**
 * simple socket
 * Create by <米唐>jetamiett@163.com
 * FileName:mt_socket.php
 * Date:2019/2/21
 */
interface socket
{
	public function start();
	public function init($ip,$port);
}
class Server implements socket
{
	protected $ip;
	protected $port;
	protected $stop = false;
	public function init($ip, $port)
	{
		$this->ip = $ip;
		$this->port = $port;
		return $this;
	}
	public function stop()
	{
		$this->stop = true;
	}
	public function start()
	{
		if (!$this->ip || !$this->port) {
			exit('please execute init()!');
		}
		//net协议为IPv4，套接字流SOCK_STREAM[TCP]、SOCK_DGRAM[UDP]，protocol协议为TCP
		$socket = socket_create(AF_INET,SOCK_STREAM,SOL_TCP);
		$bind = socket_bind($socket, $this->ip, $this->port);
		if (!$bind) {
			echo socket_strerror(socket_last_error());
		}
		$listen = socket_listen($socket, 4);
		if (!$listen) {
			echo socket_strerror(socket_last_error());
		}
		while(!$this->stop) {
			//接收绑定的主机发来的套接字流
			$accept_s = socket_accept($socket);
			if ($accept_s !== false) {
				$string = socket_read($accept_s, 1024);
				if ($string) {
					echo $string;
					//返回主机信息
					$msg = 'receviced';
					socket_write($accept_s,$msg,strlen($msg));
				}
				//关闭套接字流
				socket_close($accept_s);
			} 
		}
		//关闭连接
		socket_close($socket);
	}
}
class Client implements socket
{
	protected $ip;
	protected $port;
	protected $stop = false;
	public function init($ip, $port)
	{
		$this->ip = $ip;
		$this->port = $port;
		return $this;
	}
	public function start()
	{
		if (!$this->ip || !$this->port) {
			exit('please execute init()!');
		}
		$socket = socket_create(AF_INET,SOCK_STREAM,SOL_TCP);
		$connect = socket_connect($socket, $this->ip, $this->port);
		if(!$connect){
			exit(socket_strerror(socket_last_error()));
		}
		$message = 'socket';
		//转码
		//$message = mb_convert_encoding($message,'GBK','UTF-8');
		//向服务端写入字符串信息
		$write = socket_write($socket,$message,strlen($message));
		if (!$write) {
			echo socket_strerror(socket_last_error());

		} else {
			//读取服务端返回来的套接流信息
			while($callback = socket_read($socket,1024)){
				echo 'server message:'.$callback;
			}
		}
		socket_close($socket);
	}
}
class Factory
{
	public static function getInstance($type)
	{
		switch($type)
		{
			case 'server':
			return new Server();
			break;
			case 'client':
			return new Client();
			break;
		}
	}
}