<?php

namespace apnem19\SSHConnect;

use phpseclib\Crypt\RSA;
use phpseclib\Net\SCP;
use phpseclib\Net\SSH2;

class SSHConnect
{
    private mixed $output;
    private mixed $error;
    private SSH2 $ssh;

    public function __construct(string $hostname, string $username, string $password, int $port = 22, int $timeout)
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

    public function __debugInfo(): array
    {
        return ['output' => $this->getRawOutput(), 'error' => $this->getRawError()];
    }
}
