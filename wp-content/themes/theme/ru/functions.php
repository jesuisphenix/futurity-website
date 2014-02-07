<?php
$url = $_SERVER['REQUEST_URI'];
$request = $url;
$url = str_replace('/ru/', '', $url);
if (!$url) $url = 'home';

ob_start();
if (file_exists($url.'.php'))
  include_once $url.'.php';
else
  include_once '404.php';
  
$page = ob_get_clean();