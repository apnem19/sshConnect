<?php

namespace Apnem19\SshConnect;

use phpseclib\Net\SSH2;
use phpseclib\Net\SFTP;

class SSHConnect
{
    private mixed $output;
    private mixed $error;
    private SSH2|SFTP $ssh;
	
    public function __construct(string $hostname, string $username, string $password, int $port = 22)
    {
	$ssh = new SSH2($hostname, $port);
	if ($ssh->login($username, $password)) {
		 $this->ssh = $ssh;
	} else {
		throw new \RuntimeException('Unable to connect to server');
	}
    }

    public function exec($exec): void
    {
        $this->ssh->enableQuietMode();
        $this->output = $this->ssh->exec($exec);
        $this->error = $this->ssh->getStdError();
    }
	
	public function open($command) {
		return $this->ssh->get($command);
	}
	
	public function write($command, $file) {
		return $this->ssh->put($command, $file);
	}
	
	public function get($path, $fun) {
		return @$this->ssh->$fun($path);
	}

}
