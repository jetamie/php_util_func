<?php
require_once 'socket.php';
$instance = Factory::getInstance('server');
$instance->init('127.0.0.1','8888')->start();