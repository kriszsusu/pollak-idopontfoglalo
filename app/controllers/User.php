<?php
#[AllowDynamicProperties]

class User extends Controller {
    public function __construct() {
        $this->userModel = $this->model('UserModel');
    }
    
    public function login() {
        $data = [
            'felhasznalonev' => '',
            'jelszo' => '',
            'usernameError' => '',
            'passwordError' => ''
        ];

        //Check for post
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data = [
                'felhasznalonev' => trim($_POST['felhasznalonev']),
                'jelszo' => trim($_POST['jelszo']),
                'usernameError' => '',
                'passwordError' => '',
            ];
            //Validate username
            if (empty($data['felhasznalonev'])) {
                $data['usernameError'] = 'Add meg a felhasználónevet!';
            }

            //Validate password
            if (empty($data['jelszo'])) {
                $data['passwordError'] = 'Add meg a jelszót!';
            }

            //Check if all errors are empty
            if (empty($data['usernameError']) && empty($data['passwordError'])) {
                $loggedInUser = $this->userModel->login($data['felhasznalonev'], $data['jelszo']);
               
                if ($loggedInUser) {
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['passwordError'] = 'A bejelentkezés nem sikerült. Próbáld újra!';

                    $this->view('user/login', $data);
                }
            }

        } else {
            $data = [
                'felhasznalonev' => '',
                'jelszo' => '',
                'usernameError' => '',
                'passwordError' => ''
            ];
        }
        $this->view('user/login', $data);
    }

    public function createUserSession($user) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['felhasznalonev'] = $user->felhasznalonev;
        header('location:' . URLROOT . '/admin');
    }

    public function logout() {
        if (isset($_SESSION['username'])) {
            // logozzuk, hogy kilépett
        }
        else {
            // lejárt a munkamenet, azt kell logozni
        }
		
        unset($_SESSION['user_id']);
        unset($_SESSION['felhasznalonev']);

        header('location:' . URLROOT);
    }
}