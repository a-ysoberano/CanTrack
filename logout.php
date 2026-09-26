<?php
require 'config/database.php';
$_SESSION = [];
session_destroy();
redirect('login.php');
