Type can be TYPE_SFTP or TYPE_SSH
$connect = new SSHConnect(type, 'ip', 'login', 'password', 'port'); //Connecting to SSH <br>
$first = $connect->exec('ls /root'); //Execute the command<br>
<br>
echo $first //We get the answer<br>
