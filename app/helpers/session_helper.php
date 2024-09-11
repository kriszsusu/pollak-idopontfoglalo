<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');

    session_start();

    function isLoggedIn() {
        if (isset($_SESSION['user_id'])) {
            return true;
        } else {
            return false;
        }
    }

    function isAdmin() {
        if (isset($_SESSION['admin'])) {
            if ($_SESSION['admin']) {
                return true;
            }
        } else {
            return false;
        }
    } 

    function betaTester() {
        if ($_SESSION['user_id'] == "1") {
            echo "<span style='color:red;'>(beta)</span>";
            return true;
        }
        else {
            return false;
        }
    }
