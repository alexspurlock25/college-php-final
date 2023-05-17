<?php

$ip = "127.0.0.1";

if(filter_var($ip, FILTER_VALIDATE_IP)){
    echo ("$ip is a valid IP address");

} else{
    echo ("$ip is a valid NOT A IP address");
}

?>
