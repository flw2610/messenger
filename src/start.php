<?php

spl_autoload_register(function ($class) {
    include str_replace('\\', '/', $class) . '.php';
});

session_start();


define('CHAT_SERVER_URL', 'https://online-lectures-cs.thi.de/chat/');
define('CHAT_SERVER_ID', 'ba4b0337-1d77-490f-9c1b-5e344e6084ab'); # Ihre Collection ID

$service = new Utils\BackendService(CHAT_SERVER_URL, CHAT_SERVER_ID);
?>