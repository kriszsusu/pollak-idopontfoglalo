<?php

class MainModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Főoldal adatainak lekérdezése
    public function kartyaLekerdezes() {
        $this->db->query('SELECT e.cim, e.leiras, e.kep, e.datum, e.id AS "esemeny_id", u.nev, t.neve, t.ferohely, count(j.email) as "jelentkezok"
                          FROM esemenyek e
                          INNER JOIN users u ON e.tanarID = u.id
                          INNER JOIN tanterem t ON e.tanteremID = t.id
                          LEFT JOIN jelentkezok j ON e.id = j.esemenyID
                          WHERE e.torolt = 0');
        $results = $this->db->resultSet();
        
        return $results;
    }

}