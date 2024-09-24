<?php

class ReszletekModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Egy adott esemény részleteinek lekérdezése
    public function egyAdottEsemenyReszletei($id) {
        $this->db->query('SELECT *, esemenyek.id AS "esemeny_id" FROM esemenyek INNER JOIN users ON esemenyek.tanarID = users.id INNER JOIN tanterem ON esemenyek.tanteremID = tanterem.id WHERE esemenyek.id = :id AND esemenyek.torolt = 0');
        $this->db->bind(':id', $id);
        $results = $this->db->single();
        
        return $results;
    }

    public function emailHozzadas($esemenyID, $email){
        $this->db->query('INSERT INTO jelentkezok (esemenyID, email) VALUES (:esemenyID, :email)');
        $this->db->bind(':esemenyID', $esemenyID);
        $this->db->bind(':email', $email);


        if ($this->db->execute()) {
            return true;
        }
        else {
            return false;
        }
    }

}