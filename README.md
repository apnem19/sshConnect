<?php

$connect = new SSHConnect('ip', 'login', 'password', 'port'); //Connecting to SSH
$first = $connect->exec('ls /root'); //Execute the command
if(isset($first->getError())){ // Checking for errors
  echo $first->getError(); // Displaying the error text
}
echo $first->getOutput() //We get the answer

?>
