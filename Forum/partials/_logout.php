<?php
session_start();
echo 'Login you out. Please wait...';
session_destroy();
header("Location : http://localhost/forum/");


?>