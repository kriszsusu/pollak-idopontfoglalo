<?php

class MainModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

}