<?php
class Chats extends Controller {
    public function __construct() {
        $this->chatModel = $this->model('Chat');
    }

    public function index() {

        $currentUserId = $_SESSION['user_id'];

        if(!$currentUserId){
            header('location:' . URLROOT . '/users/login');
        }

        $users = $this->chatModel->allUsers($currentUserId);
        $data = [
            'users' => $users,
        ];
        
        $this->view('index', $data);
    }

    public function conversation(){

        $currentUserId = $_SESSION['user_id'];

        if(!$currentUserId){
            header('location:' . URLROOT . '/users/login');
        }
        $toUserId = $_GET["toUser"];

        $readMessages = $this->chatModel->markedMessagesRead($currentUserId,$toUserId);
        header('Content-Type: application/json');

        if($readMessages){
            $conversation = $this->chatModel->findConversation($currentUserId,$toUserId);
            echo json_encode(['result' => $conversation]);
        }
        else{
            echo json_encode(['result' => []]);
        }


    }

    public function sendmessage(){

        $currentUserId = $_SESSION['user_id'];

        if(!$currentUserId){
            header('location:' . URLROOT . '/users/login');
        }
        $toUserId = $_POST["toUser"];
        $message = $_POST["message"];

        header('Content-Type: application/json');
        


        if($this->chatModel->newMessage($currentUserId,$toUserId,$message)){

            $conversation = $this->chatModel->findConversation($currentUserId,$toUserId);
            
            echo json_encode(['result' => $conversation]);
        }
        else{

            echo json_encode(['result' => []]);
        }


    }

}
