<?php

class UserModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function login($felhasznalonev, $jelszo) {
        $this->db->query('SELECT users.id, users.jelszo, users.felhasznalonev FROM users WHERE users.felhasznalonev = :felhasznalonev AND users.torolt = 0 LIMIT 1');
        $this->db->bind(':felhasznalonev', $felhasznalonev);
        $row = $this->db->single();

        if (!empty($row)) {
            $hashedPassword = $row->jelszo;
        }
        else {
            $hashedPassword = "nem adott meg jelszót";
        }

        if (password_verify($jelszo, $hashedPassword)) {
            return $row;
        } else {
            return false;
        }
    }
}
