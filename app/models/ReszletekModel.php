<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require APPROOT .  '/helpers/phpmailer/PHPMailer.php';
require APPROOT .  '/helpers/phpmailer/Exception.php';
require APPROOT .  '/helpers/phpmailer/SMTP.php';

class ReszletekModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Egy adott esemény részleteinek lekérdezése
    public function egyAdottEsemenyReszletei($id) {
        $this->db->query('SELECT e.cim, e.leiras, e.kep, e.datum, e.id AS "esemeny_id", u.nev, t.neve, t.ferohely, count(j.email) as "jelentkezok"
                          FROM esemenyek e
                          INNER JOIN users u ON e.tanarID = u.id
                          INNER JOIN tanterem t ON e.tanteremID = t.id
                          LEFT JOIN jelentkezok j ON e.id = j.esemenyID AND j.torolt = 0
                          WHERE e.id = :id AND e.torolt = 0'
                        );
        $this->db->bind(':id', $id);
        $results = $this->db->single();
        
        return $results;
    }
    
    //Tiltott email ellenőrzés
    public function emailHozzadas($esemenyID, $email, $neve){

        //Tiltott email ellenőrzés
        $emailprovider = explode("@", $email)[1];
        $this->db->query('SELECT email from tiltottemail where email = :emailprovider');
        $this->db->bind(':emailprovider', $emailprovider);
        $tiltasrow = $this->db->resultSet();

        if (count($tiltasrow) > 0) {
            return false;
        }

        $this->db->query('SELECT nev from tiltottnevek where nev like :tiltottnev');
        $this->db->bind(':tiltottnev', "%$neve%");
        $tiltott = $this->db->resultSet();

        if (count($tiltott) > 0) {
            return false;
        }
        
        // Kis segítség a validáláshoz
        // Lekérdezzük, hogy az adott email cím már szerepel-e az adatbázisban
        // Ha igen, akkor nem engedjük hozzáadni
        // Ha nem, akkor hozzáadjuk
        $this->db->query('SELECT * FROM jelentkezok WHERE email = :email AND esemenyID = :esemenyID');
        $this->db->bind(':email', $email);
        $this->db->bind(':esemenyID', $esemenyID);

        $row = $this->db->resultSet();

        if (count($row) > 0) {
            return false;
        }

        $mail = new PHPMailer();
        $mail->IsSMTP(); // SMTP-n keresztuli kuldes
        $mail->Host = "smtp-mail.outlook.com"; // SMTP szerverek
        $mail->SMTPAuth = true; // SMTP
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // SMTP titkosítás
        $mail->Port = 587; // SMTP port

        $mail->Username = EMAIL_USER; // SMTP felhasználo
        $mail->Password = EMAIL_PASS; // SMTP jelszo

        $mail->From = EMAIL_ADDRESS; // Felado e-mail cime
        $mail->FromName = 'Pollák Antal'; // Felado neve
        $mail->AddAddress($email, $neve); // Cimzett es neve

        $mail->WordWrap = 80; // Sortores allitasa
        $mail->IsHTML(true); // Kuldes HTML-kent

        $mail->Subject = 'Esemény jelentkezés visszaigazolás'; // A level targya
        $mail->Body = 'Szövegtörzs <b>HTML-el formázva</b>'; // A level tartalma

        if (!$mail->Send()) {
        echo 'A levél nem került elküldésre';
        echo 'A felmerült hiba: ' . $mail->ErrorInfo;
        exit;
}

        $this->db->query('INSERT INTO jelentkezok (esemenyID, email, neve) VALUES (:esemenyID, :email, :neve)');
        $this->db->bind(':esemenyID', $esemenyID);
        $this->db->bind(':email', $email);
        $this->db->bind(':neve', $neve);


        if ($this->db->execute()) {
            return true;
        }
        else {
            return false;
        }
    }

}