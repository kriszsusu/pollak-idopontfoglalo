<?php

class KapcsolatModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

}