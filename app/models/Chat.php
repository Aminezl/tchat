<?php
class Chat {

    private $db;
    public function __construct() {
        $this->db = new Database;
    }

    public function allUsers($currentUserId) {

        $this->db->query('SELECT id,email,is_online FROM users WHERE id != :currentUserId');

        //Bind value
        $this->db->bind(':currentUserId', $currentUserId);

        $rows = $this->db->resultSet();


        return $rows;
    }

    public function markedMessagesRead($from_user,$to_user){
        $this->db->query('UPDATE chats SET is_read = :is_read WHERE (from_user = :from_user and to_user = :to_user) OR (from_user = :to_user and to_user = :from_user)');

        $this->db->bind(':is_read', true);
        $this->db->bind(':from_user', $from_user);
        $this->db->bind(':to_user', $to_user);


        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function findConversation($from_user,$to_user) {
        $this->db->query('SELECT ch.*,u.email FROM chats ch INNER JOIN users u ON u.id = ch.to_user WHERE (from_user = :from_user and to_user = :to_user) OR (from_user = :to_user and to_user = :from_user) ORDER BY ch.created_at ASC');

        
        $this->db->bind(':from_user', $from_user);
        $this->db->bind(':to_user', $to_user);

        $rows = $this->db->resultSet();
        
        return $rows;
    }

    public function newMessage($from_user,$to_user,$message) {

        $this->db->query('INSERT INTO chats (from_user,to_user,message) VALUES (:from_user,:to_user,:message)');

        $this->db->bind(':from_user', $from_user);
        $this->db->bind(':to_user', $to_user);
        $this->db->bind(':message', $message);


        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    }


}