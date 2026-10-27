<?php
define('_SERVER_NAME', 'localhost'); // domyslnie xampp wykorzystuje port 80. Z bazowego kodu usunąłem  zadeklarowany port 8080
define('_SERVER_URL', 'http://'._SERVER_NAME);
define('_APP_ROOT', '/kredyt'); // Trzeba podać opdowiednią lokalizację / folder, w którym znajdują się pliki
define('_APP_URL', _SERVER_URL._APP_ROOT);
define("_ROOT_PATH", dirname(__FILE__));


function out(&$param){
	if (isset($param)){
		echo $param;
	}
}
?>