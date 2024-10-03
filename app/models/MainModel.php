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
                        WHERE e.torolt = 0
                        GROUP BY e.cim, e.leiras, e.kep, e.datum, e.id, u.nev, t.neve, t.ferohely');
        $results = $this->db->resultSet();
        
        return $results;
    }

    // Időpontok lekérdezése
    public function idopontokLekerdezes() {
        $this->db->query('SELECT id, datum FROM esemenyek WHERE torolt = 0');
        $results = $this->db->resultSet();
        
        return $results;
    }

    // Szakok lekérdezése
    public function szakokLekerdezes() {
        $this->db->query('SELECT id, cim FROM esemenyek WHERE torolt = 0');
        $results = $this->db->resultSet();
        
        return $results;
    }

    // Oktatók lekérdezése
    public function oktatokLekerdezes() {
        $this->db->query('SELECT id, nev FROM users WHERE torolt = 0');
        $results = $this->db->resultSet();
        
        return $results;
    }

    // Tantermek lekérdezése
    public function teremLekerdezes() {
        $this->db->query('SELECT id, neve FROM tanterem');
        $results = $this->db->resultSet();
        
        return $results;
    }

    /* Ékezetek helyett '_' jel */
    private function replaceHungarianAccents($string) {
        // A HTML entitások visszacserélése ékezetekre
        $string = html_entity_decode($string, ENT_QUOTES, 'UTF-8');

        // A magyar ékezetek cseréje '_'-re, hogy az ékezetmentes keresés is működjön
        $accents = ['á', 'Á', 'é', 'É', 'í', 'Í', 'ó', 'Ó', 'ö', 'Ö', 'ő', 'Ő', 'ú', 'Ú', 'ü', 'Ü', 'ű', 'Ű'];
        $replacement = '_';

        return str_replace($accents, $replacement, $string);
    }

    /* Az adott szórészletet tartalmazó termékek lekérdezése */
    public function termekekKeresese($keresendo) {
        $keresendo = $this->replaceHungarianAccents($keresendo);

        $this->db->query("      
          SELECT e.cim, e.leiras, e.kep, e.datum, e.id AS 'esemeny_id', u.nev, t.neve, t.ferohely, count(j.email) as 'jelentkezok' FROM esemenyek e INNER JOIN users u ON e.tanarID = u.id INNER JOIN tanterem t ON e.tanteremID = t.id LEFT JOIN jelentkezok j ON e.id = j.esemenyID WHERE e.torolt = 0 AND (e.cim LIKE :keresendo OR e.leiras LIKE :keresendo OR u.nev LIKE :keresendo) GROUP BY e.cim, e.leiras, e.kep, e.datum, e.id, u.nev, t.neve, t.ferohely;     
        ");

        $this->db->bind(':keresendo', "%$keresendo%");
        return $this->db->resultSet();
    }

        // Termékek szűrése
        public function termekekSzurese($keresendo, $szuro) {
            $keresendo = $this->replaceHungarianAccents($keresendo);

            if($szuro == "termek") {
                    $this->db->query("      
                SELECT e.cim, e.leiras, e.kep, e.datum, e.id AS 'esemeny_id', u.nev, t.neve, t.ferohely, count(j.email) as 'jelentkezok' FROM esemenyek e INNER JOIN users u ON e.tanarID = u.id INNER JOIN tanterem t ON e.tanteremID = t.id LEFT JOIN jelentkezok j ON e.id = j.esemenyID WHERE e.torolt = 0 AND t.id = :keresendo GROUP BY e.cim, e.leiras, e.kep, e.datum, e.id, u.nev, t.neve, t.ferohely;
                ");
            }else if($szuro == "szak") {
                $this->db->query("      
                SELECT e.cim, e.leiras, e.kep, e.datum, e.id AS 'esemeny_id', u.nev, t.neve, t.ferohely, count(j.email) as 'jelentkezok' FROM esemenyek e INNER JOIN users u ON e.tanarID = u.id INNER JOIN tanterem t ON e.tanteremID = t.id LEFT JOIN jelentkezok j ON e.id = j.esemenyID WHERE e.torolt = 0 AND e.id = :keresendo GROUP BY e.cim, e.leiras, e.kep, e.datum, e.id, u.nev, t.neve, t.ferohely;
                ");

            }else if($szuro == "oktatok") {
                $this->db->query("      
                SELECT e.cim, e.leiras, e.kep, e.datum, e.id AS 'esemeny_id', u.nev, t.neve, t.ferohely, count(j.email) as 'jelentkezok' FROM esemenyek e INNER JOIN users u ON e.tanarID = u.id INNER JOIN tanterem t ON e.tanteremID = t.id LEFT JOIN jelentkezok j ON e.id = j.esemenyID WHERE e.torolt = 0 AND u.id = :keresendo GROUP BY e.cim, e.leiras, e.kep, e.datum, e.id, u.nev, t.neve, t.ferohely;
                ");
            }else if($szuro == "idopontok") {
                $this->db->query("      
                SELECT e.cim, e.leiras, e.kep, e.datum, e.id AS 'esemeny_id', u.nev, t.neve, t.ferohely, count(j.email) as 'jelentkezok' FROM esemenyek e INNER JOIN users u ON e.tanarID = u.id INNER JOIN tanterem t ON e.tanteremID = t.id LEFT JOIN jelentkezok j ON e.id = j.esemenyID WHERE e.torolt = 0 AND e.id = :keresendo GROUP BY e.cim, e.leiras, e.kep, e.datum, e.id, u.nev, t.neve, t.ferohely;
                ");
            }
    
            
    
            $this->db->bind(':keresendo', "$keresendo");
            return $this->db->resultSet();
        }

}