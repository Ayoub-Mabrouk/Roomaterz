<?php
class InterestModel {
    private $con;
    public function __construct()
    {
        $this->con = new Database();
    }
    
    public function my_interests($user_id){
        // $this->con->query("SELECT p.id, CONCAT(u.first_name,' ',u.last_name) AS Name,t.type,c.city,p.description,p.created_at FROM post p,user u,type t,city c,interested_at i WHERE i.user_id = :user_id and u.id=p.user_id and p.id=post_id and p.type_id=t.id and p.city_id=c.id");
        $this->con->query("SELECT p.id AS post_id,
        p.user_id,
        CONCAT(u.first_name, ' ', u.last_name) AS name,
        u.profile_img,
        t.type,
        c.city,
        p.description,
        p.created_at,
        i.likes
 FROM post p,
      TYPE t,
           city c,
           USER u,
 
   (SELECT count(id) AS likes,
           post_id,
           user_id
    FROM `interested_at`
    GROUP BY post_id) i
 WHERE i.post_id=p.id
   AND i.user_id=:user_id
   AND p.type_id=t.id
   AND p.city_id=c.id
   AND p.user_id=u.id");
        $this->con->bind(':user_id', $user_id);
        return $this->con->getAll();
    }
    public function notification($user_id){
        $this->con->query("SELECT p.id post_id,u.id as user_id,p.description,CONCAT(u.first_name,' ',u.last_name) AS name ,u.profile_img FROM post p,user u,( SELECT * from interested_at WHERE id in ( SELECT MAX(id) from ( select id ,user_id,post_id from `interested_at` order by id desc) x GROUP by post_id)) i where p.id=i.post_id and u.id=i.user_id and p.user_id=:user_id");
        $this->con->bind(':user_id', $user_id);
        return $this->con->getAll();
    }
    public function interested($user_id,$post_id){
        $this->con->query("INSERT INTO interested_at (user_id,post_id) values (:user_id,:post_id)");
            $this->con->bind(':user_id', $user_id);
            $this->con->bind(':post_id', $post_id);
            try {
                if ($this->con->execute()) {
                    return true;
                }
                else{
                    return false;
                }
            } catch (\Throwable $th) {
                return false;
            }
            
    }
    public function disinterested($user_id,$post_id){
        $this->con->query("DELETE FROM interested_at WHERE user_id = :user_id AND post_id = :post_id");
            $this->con->bind(':user_id', $user_id);
            $this->con->bind(':post_id', $post_id);
            try {
                if ($this->con->execute()) {
                    return true;
                }
                else{
                    return false;
                }
            } catch (\Throwable $th) {
                return false;
            }
    }

    

    
    


}