<?php
    //Database params
    define('DB_HOST', 'localhost');
    define('DB_USER', 'user');
    define('DB_PASS', 'jelszo');
    define('DB_NAME', 'adatbazisnev');

    //APPROOT
    define('APPROOT', dirname(dirname(__FILE__)));

    //URLROOT (Dynamic links)
    define('URLROOT', 'http://localhost/pollakidopontfoglalas');
    // define('URLROOT', 'https://pollakbufe.hu');

    //Sitename
    define('SITENAME', 'PollakIdopontFoglalas');

    error_reporting(E_ALL ^ E_DEPRECATED);