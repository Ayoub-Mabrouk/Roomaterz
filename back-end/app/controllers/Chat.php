<?php
class Chat extends Controller {
    public function __construct()
    {
        $this->Chat = $this->model('ChatModel');
    }
    
    public function my_conversations(){
        try {
            $user_id=$this->verifytoken($this->gettoken());
            if ($user_id) { 
                print_r(json_encode($this->Chat->my_conversations($user_id)));
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
    public function conversation(){
        try {
            $user_id=$this->verifytoken($this->gettoken());
            if ($user_id) { 
                print_r(json_encode($this->Chat->conversation($user_id,$this->data->conversation_id)));
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
    public function send_message(){
        try {
            $user_id=$this->verifytoken($this->gettoken());
            if ($user_id) { 
                print_r(json_encode($this->Chat->send_message($user_id,$this->data->reciever_id,$this->data->reply)));
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
}