<?php
require("start.php");
$service = new Utils\BackendService(CHAT_SERVER_URL, CHAT_SERVER_ID);
var_dump($service->test());
var_dump($service->login("Tom", "12345678"));
var_dump($service->loadUser("Tom"));
?>