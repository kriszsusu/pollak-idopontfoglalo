<?php
    //APPROOT
    define('APPROOT', dirname(dirname(__FILE__)));

    if(getenv('PRODUCTION')) {
        define('DB_HOST', getenv('DB_HOST'));
        define('DB_USER', getenv('DB_USER'));
        define('DB_PASS', getenv('DB_PASS'));
        define('DB_NAME', getenv('DB_NAME'));

        define('URLROOT', 'https://foglalas.pollak.info');
    } else {
        define('DB_HOST', 'localhost');
        define('DB_USER', 'root');
        define('DB_PASS', '');
        define('DB_NAME', 'pollakidopontfoglalas');

        define('URLROOT', 'http://localhost/pollak-idopontfoglalo');
    }      

    //Sitename
    define('SITENAME', 'pollak-idopontfoglalo');

    error_reporting(E_ALL ^ E_DEPRECATED);