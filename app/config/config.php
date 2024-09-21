<?php
    //APPROOT
    define('APPROOT', dirname(dirname(__FILE__)));

    //Load .env file
    if(!getenv('PRODUCTION'))
        (new DotEnv(dirname(APPROOT) . '/.env'))->load();

    //Database params
    define('DB_HOST', getenv('DB_HOST'));
    define('DB_USER', getenv('DB_USER'));
    define('DB_PASS', getenv('DB_PASS'));
    define('DB_NAME', getenv('DB_NAME'));

    

    //URLROOT (Dynamic links)
    if(!getenv('PRODUCTION'))
        define('URLROOT', 'http://localhost/pollak-idopontfoglalo');
    else
        define('URLROOT', 'https://foglalas.pollak.info');

    //Sitename
    define('SITENAME', 'pollak-idopontfoglalo');

    error_reporting(E_ALL ^ E_DEPRECATED);