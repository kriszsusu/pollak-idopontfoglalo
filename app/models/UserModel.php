<?php

class UserModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }
}
