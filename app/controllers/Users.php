<?php
class Users extends Controller {
    public function __construct() {
        $this->userModel = $this->model('User');
    }


    // if the email does not exist the account creation is done automatically
    public function login() {

        $currentSession = $_SESSION;

        if(!empty($currentSession)){
            header('location:' . URLROOT . '/chats/index');
        }

        $data = [
            'email' => '',
            'password' => '',
            'emailError' => '',
            'passwordError' => ''
        ];

        //Check for post
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'usernameError' => '',
                'passwordError' => '',
            ];
            //Validate email
            if (empty($data['email'])) {
                $data['emailError'] = 'Veuillez saisir une adresse email';
            }
            elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['emailError'] = 'Veuillez saisir une adresse email valide.';
            } 

            //Validate password
            if (empty($data['password'])) {
                $data['passwordError'] = 'Veuillez saisir mot de passe.';
            }

            //Check if all errors are empty
            if (empty($data['emailError']) && empty($data['passwordError'])) {

                if ($this->userModel->findUserByEmail($data['email'])){
                    $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                    if ($loggedInUser && $this->userModel->markedOnline($data['email'])) {
                        $this->createUserSession($loggedInUser);
                    }
                    else{
                        $data['emailError'] = null;
                        $data['passwordError'] = 'Mot de passe incorrect.';
                    }
                }
                else{
                    
                    $passwordHash = password_hash($data['password'], PASSWORD_DEFAULT);
                    
                    $registerUser =  $this->userModel->register($data['email'], $passwordHash);

                    if ($registerUser) {
                        
                        $loggedInUser = $this->userModel->login($data['email'], $data['password']);
                        
                        if ($loggedInUser) {

                            $this->createUserSession($loggedInUser);
                        }
                    }
                    else{

                        die('La connexion n\'a pas pu être établie.');
                    }
                    $this->view('users/login', $data);

                }
            }

        } 
        else {
            $data = [
                'username' => '',
                'password' => '',
                'emailError' => '',
                'passwordError' => ''
            ];
        }
        $this->view('users/login', $data);
    }

    public function createUserSession($user) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['email'] = $user->email;
        header('location:' . URLROOT . '/chats/index');
    }

    public function logout() {
        if($this->userModel->logout($_SESSION['email'])){
            unset($_SESSION['user_id']);
            unset($_SESSION['email']);
            header('location:' . URLROOT . '/users/login');
        }    
        
    }
}
