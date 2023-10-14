<?php

namespace apnem19\SSHConnect;

use phpseclib\Crypt\RSA;
use phpseclib\Net\SCP;
use phpseclib\Net\SSH2;

class SSHConnect{
	private $hostname;
    private $port = 22;
    private $username;
    private $password;
    private $timeout;
	private $output;
	private $error;
	
	public function __construct($hostname, $username, $password, $port, $timeout) {
		$this->server = $hostname;
		$this->username = $username;
		$this->password = $password;
		$this->timeout = $timeout;
		$this->port = $port;
	}
	
	public function connect() {
		$ssh = new SSH2($this->server, $this->port);
		if ($ssh->login($this->username, $this->password)) {
			return $ssh;
		}
		
		return "Ошибка: Не удалось соединиться с сервером!";
	}
	
	public function exec($exec) {
		$ssh->enableQuietMode();
		$this->output = $ssh->exec($exec);
		$this->error = $ssh->getStdError();
	}
	
	public function getRawOutput(): string
    {
        return $this->output;
    }

    public function getRawError(): string
    {
        return $this->error;
    }

    public function getOutput(): string
    {
        return trim($this->getRawOutput());
    }

    public function getError(): string
    {
        return trim($this->getRawError());
    }
}
?>
