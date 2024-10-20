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

    public function visszaigazol($id) {
        $this->db->query('UPDATE jelentkezok SET visszaigazolt = 1 WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->execute();
        
        $this->db->query('SELECT esemenyID FROM jelentkezok WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single()->esemenyID;
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
        
        // Lekérdezzük, hogy az adott email cím már szerepel-e az adatbázisban
        // Ha igen, akkor nem engedjük hozzáadni
        // Ha nem, akkor hozzáadjuk
        $this->db->query('SELECT * FROM jelentkezok WHERE email = :email AND esemenyID = :esemenyID AND torolt = 0');
        $this->db->bind(':email', $email);
        $this->db->bind(':esemenyID', $esemenyID);

        $row = $this->db->resultSet();

        if (count($row) > 0) {
            return false;
        }

        $this->db->query('INSERT INTO jelentkezok (esemenyID, email, neve) VALUES (:esemenyID, :email, :neve)');
        $this->db->bind(':esemenyID', $esemenyID);
        $this->db->bind(':email', $email);
        $this->db->bind(':neve', $neve);
        $this->db->execute();
        $this->db->query('SELECT id FROM jelentkezok WHERE email = :email AND esemenyID = :esemenyID');
        $this->db->bind(':email', $email);
        $this->db->bind(':esemenyID', $esemenyID);
        $insertedId = $this->db->single()->id;

        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        $mail->IsSMTP();
        $mail->Host = "smtp-mail.outlook.com";
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->Username = EMAIL_USER;
        $mail->Password = EMAIL_PASS;

        $mail->From = EMAIL_ADDRESS;
        $mail->FromName = 'Pollák Antal';
        $mail->AddAddress($email, $neve);

        $mail->WordWrap = 80;
        $mail->IsHTML(true);

        $mail->Subject = 'Esemény jelentkezés megerősítése';
        $mail->Body = 'Kedves ' . $neve . '!<br><br>Az alábbi linkre kattintva megerősítheti jelentkezését az eseményre:<br><br><a href="' . URLROOT . '/reszletek/jelentkezes/' . $insertedId . '">Jelentkezés megerősítése</a>';

        if (!$mail->Send()) {
            echo 'A levél nem került elküldésre';
            echo 'A felmerült hiba: ' . $mail->ErrorInfo;
            exit;
        }

        if ($insertedId) {
            return true;
        }
        else {
            return false;
        }
    }

}