<?php

$connect = new SSHConnect('ip', 'login', 'password', 'port'); //Connecting to SSH <br>
$first = $connect->exec('ls /root'); //Execute the command<br>
if(isset($first->getError())){ // Checking for errors<br>
  echo $first->getError(); // Displaying the error text<br>
}<br>

echo $first->getOutput() //We get the answer<br>

?>
