<?php
class ChatModel {
    private $con;
    public function __construct()
    {
        $this->con = new Database();
    }
    
    // get all conversations info
    public function my_conversations($user_id){
        $sql="SELECT c.id conversation_id,u.id user_id ,CONCAT(u.first_name,' ',u.last_name)  name,u.profile_img ,m.reply,m.created_at
                FROM user u,conversation c, 
                        ( SELECT * 
                        from message 
                        WHERE id in ( 
                        SELECT MAX(id) from 
                        ( select id ,reply,sender_id,conversation_id,created_at from `message` order by id desc) x
                        GROUP by conversation_id)) m        
                WHERE CASE WHEN c.sender_id = :user_id THEN c.reciever_id = u.id
                WHEN c.reciever_id = :user_id THEN c.sender_id= u.id 
                END 
                AND c.id=m.conversation_id AND (c.sender_id =:user_id OR c.reciever_id =:user_id)
                ORDER BY m.created_at DESC";
        $this->con->query($sql);
        $this->con->bind(':user_id', $user_id);
        return $this->con->getAll();
    }
    // 
    public function conversation($user_id,$conversation_id){
        $sql="select c.id conversation_id,u.id user_id, CONCAT(u.first_name,' ',u.last_name)  name,u.profile_img,m.reply,m.created_at,(case when :user_id=u.id then 1 else 0 end) mine  from message m,conversation c,user u
        WHERE m.Conversation_id=:conversation_id and m.Conversation_id=c.id and m.sender_id=u.id and (c.sender_id=:user_id or c.reciever_id=:user_id)";
        $this->con->query($sql);
        $this->con->bind(':user_id', $user_id);
        $this->con->bind(':conversation_id', $conversation_id);
        return $this->con->getAll();
    }
    public function send_message($user_id,$reciever_id,$reply){
        $conversation_id=$this->conversation_exist($user_id,$reciever_id);
        //check if conversation already exists then insert a message to that conversation
        if($conversation_id){
            //insert the message to the conversation
            return $this->insert_msg($user_id,$reply,$conversation_id);
        }else {
            //create a new conversation for the users
            $sql="INSERT INTO conversation (sender_id, reciever_id) VALUES(:user_id,:reciever_id)";
            $this->con->query($sql);
            $this->con->bind(':user_id', $user_id);
            $this->con->bind(':reciever_id', $reciever_id);
            if ($this->con->execute()) {
                //get the conversation id to insert the message into it, i could use the conversation_exist()
                //but that function is not going to be fast at this point
                $this->con->query("SELECT c.id conversation_id FROM conversation c WHERE sender_id= :user_id and reciever_id= :reciever_id ORDER BY conversation_id DESC limit 1");
                $this->con->bind(':user_id', $user_id);
                $this->con->bind(':reciever_id', $reciever_id);
                $row=$this->con->getSingleResult();
                if ($this->con->getRowCount() > 0) {
                    //insert the message to the conversation
                    return $this->insert_msg($user_id,$reply,$row->conversation_id);
                }else {
                    return false;
                }
            } else {
                return false;
            }
        }
        return $this->con->getAll();
    }
    //check if there is a conversation between these two users
    public function conversation_exist($user_id,$reciever_id){
        $this->con->query("SELECT c.id conversation_id FROM conversation c WHERE (sender_id= :user_id and reciever_id= :reciever_id)
        or (sender_id= :reciever_id and reciever_id= :user_id)");
        $this->con->bind(':user_id', $user_id);
        $this->con->bind(':reciever_id', $reciever_id);
        $row=$this->con->getSingleResult();
        if ($this->con->getRowCount() > 0) {
            return $row->conversation_id;
        }else {
            return false;
        }
    }

    // insert a message
    public function insert_msg($user_id,$reply,$conversation_id){
        $sql="INSERT INTO message (reply, sender_id,Conversation_id) VALUES (:reply,:user_id,:conversation_id)";
            $this->con->query($sql);
            $this->con->bind(':user_id', $user_id);
            $this->con->bind(':reply', $reply);
            $this->con->bind(':conversation_id', $conversation_id);
            if ($this->con->execute()) {
                return true;
            } else {
                return false;
            }
    }
 


}