<?php

class MainModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Főoldal adatainak lekérdezése
    public function kartyaLekerdezes() {
        $this->db->query('SELECT *, esemenyek.id AS "esemeny_id" FROM esemenyek INNER JOIN users ON esemenyek.tanarID = users.id WHERE users.torolt = 0');
        $results = $this->db->resultSet();
        
        return $results;
    }

}