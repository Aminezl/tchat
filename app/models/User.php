<?php
class User {

    private $db;
    public function __construct() {
        $this->db = new Database;
    }

    public function register($email, $password) {
        $this->db->query('INSERT INTO users (email, password) VALUES(:email, :password)');

        $this->db->bind(':email', $email);
        $this->db->bind(':password', $password);


        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function login($email, $password) {

        $this->db->query('SELECT * FROM users WHERE email = :email');

        //Bind value
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        $hashedPassword = $row->password;

        if (password_verify($password, $hashedPassword)) {
            return $row;
        } else {
            return false;
        }
    }

    public function markedOnline($email){
        $this->db->query('UPDATE users SET is_online = :is_online WHERE email = :email');

        $this->db->bind(':is_online', true);
        $this->db->bind(':email', $email);


        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function logout($email){
        $this->db->query('UPDATE users SET is_online = :is_online WHERE email = :email');

        $this->db->bind(':is_online', false);
        $this->db->bind(':email', $email);


        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function findUserByEmail($email) {

        $this->db->query('SELECT * FROM users WHERE email = :email');

        
        $this->db->bind(':email', $email);
        
        if($this->db->single()) {
            return true;
        } else {
            return false;
        }
    }


}
