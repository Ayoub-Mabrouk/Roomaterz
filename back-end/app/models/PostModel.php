<?php
class PostModel {
    private $con;
    public function __construct()
    {
        $this->con = new Database();
    }

    //get my posts
    public function posts_of($user_id,$profile_id) {
        // $this->con->query("SELECT p.id,t.type,c.city,p.description,p.created_at FROM post p,type t,city c WHERE p.user_id = :user_id and p.type_id=t.id and p.city_id=c.id");
        $this->con->query("SELECT * FROM (SELECT * FROM (SELECT p.id as post_id,p.user_id,CONCAT(u.first_name,' ',u.last_name) AS name,u.profile_img,t.type,c.city,p.description,p.created_at , i.likes FROM post p,type t,city c,user u, (SELECT count(id) as likes,post_id FROM `interested_at` GROUP BY post_id) i WHERE i.post_id=p.id and p.type_id=t.id and p.city_id=c.id and p.user_id=u.id AND p.user_id = :profile_id  UNION SELECT p.id as post_id,p.user_id,CONCAT(u.first_name,' ',u.last_name) AS name,u.profile_img,t.type,c.city,p.description,p.created_at,0 as likes FROM post p,type t,city c,user u where p.type_id=t.id and p.city_id=c.id and p.user_id=u.id AND p.user_id = :profile_id) k GROUP BY post_id ) t1 INNER JOIN (SELECT exists(select 1 from interested_at li where li.post_id = p.id and li.user_id = u.id limit 1) as liked , p.id as post_id FROM user u, post p WHERE u.id = :user_id) t2 ON t1.post_id=t2.post_id");
        $this->con->bind(':user_id', $user_id);
        $this->con->bind(':profile_id', $profile_id);
        return $this->con->getAll();
    }
    public function one_post($user_id,$post_id) {
        // $this->con->query("SELECT p.id,t.type,c.city,p.description,p.created_at FROM post p,type t,city c WHERE p.user_id = :user_id and p.type_id=t.id and p.city_id=c.id");
        $this->con->query("SELECT * FROM (SELECT * FROM (SELECT p.id as post_id,p.user_id,CONCAT(u.first_name,' ',u.last_name) AS name,u.profile_img,t.type,c.city,p.description,p.created_at , i.likes FROM post p,type t,city c,user u, (SELECT count(id) as likes,post_id FROM `interested_at` GROUP BY post_id) i WHERE i.post_id=p.id AND p.id=:post_id and p.type_id=t.id and p.city_id=c.id and p.user_id=u.id UNION SELECT p.id as post_id,p.user_id,CONCAT(u.first_name,' ',u.last_name) AS name,u.profile_img,t.type,c.city,p.description,p.created_at,0 as likes FROM post p,type t,city c,user u where p.type_id=t.id and p.city_id=c.id and p.user_id=u.id  AND p.id=:post_id) k GROUP BY post_id ) t1 INNER JOIN (SELECT exists(select 1 from interested_at li where li.post_id = p.id and li.user_id = u.id limit 1) as liked , p.id as post_id FROM user u, post p WHERE u.id =:user_id) t2 ON t1.post_id=t2.post_id");
        $this->con->bind(':user_id', $user_id);
        $this->con->bind(':post_id', $post_id);
        return $this->con->getSingleResult();
    }

    //return true if a post created successfuly 
    public function create_post($user_id,$type_id,$city_id,$description){
        if($this->type_id_Exists($type_id) && $this->city_id_Exists($city_id)){
            $this->con->query("INSERT INTO post (user_id,type_id,city_id,description) values (:user_id,:type_id,:city_id,:description)");
            $this->con->bind(':user_id', $user_id);
            $this->con->bind(':type_id', $type_id);
            $this->con->bind(':city_id', $city_id);
            $this->con->bind(':description', $description);
            if ($this->con->execute()) {
                return true;
            }
        }else {
            return false;
        }
    }

    //return true if post deleted, false if it didn't
    public function delete_post($user_id,$post_id){
        $this->con->query("DELETE FROM post WHERE user_id = :user_id AND id = :post_id");
        $this->con->bind(':user_id', $user_id);
        $this->con->bind(':post_id', $post_id);
        if ($this->con->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function all_posts($user_id) {
        // $this->con->query("SELECT p.id as post_id,p.user_id,CONCAT(u.first_name,' ',u.last_name) AS name,t.type,c.city,p.description,p.created_at FROM post p,type t,city c,user u WHERE p.type_id=t.id and p.city_id=c.id and p.user_id=u.id");
        // $this->con->query("SELECT p.id as post_id,p.user_id,CONCAT(u.first_name,' ',u.last_name) AS name,t.type,c.city,p.description,p.created_at , i.likes FROM post p,type t,city c,user u, (SELECT count(id) as likes,post_id FROM `interested_at` GROUP BY post_id) i WHERE i.post_id=p.id and p.type_id=t.id and p.city_id=c.id and p.user_id=u.id");
        $this->con->query("SELECT * FROM 
        (SELECT * FROM (SELECT p.id as post_id,p.user_id,CONCAT(u.first_name,' ',u.last_name) AS name,u.profile_img,t.type,c.city,p.description,p.created_at , i.likes FROM post p,type t,city c,user u, 
                        (SELECT count(id) as likes,post_id FROM `interested_at` GROUP BY post_id) i 
                        WHERE i.post_id=p.id and p.type_id=t.id and p.city_id=c.id and p.user_id=u.id 
                        UNION 
                        SELECT p.id as post_id,p.user_id,CONCAT(u.first_name,' ',u.last_name) AS name,u.profile_img,t.type,c.city,p.description,p.created_at,0 as likes FROM post p,type t,city c,user u where p.type_id=t.id and p.city_id=c.id and p.user_id=u.id) k GROUP BY post_id ) t1 INNER JOIN (SELECT exists(select 1 from interested_at li where li.post_id = p.id and li.user_id = u.id limit 1) as liked , p.id as post_id FROM user u, post p WHERE u.id = :user_id) t2 ON t1.post_id=t2.post_id");
        $this->con->bind(':user_id', $user_id);
        return $this->con->getAll();
    }
    //search in posts by filter, if no filter is set then it returns all posts
    // public function search_posts($type_id='',$city_id='') {
    //     $sql_query="SELECT p.id as post_id,p.user_id,CONCAT(u.first_name,' ',u.last_name) AS name,t.type,c.city,p.description,p.created_at FROM post p,type t,city c,user u WHERE p.type_id=t.id and p.city_id=c.id and p.user_id=u.id";
    //     $search_filter='';
    //     if($type_id!='') {
    //         $search_filter .= ' and type_id=:type_id';
    //     }
    //     if($city_id!='') {
    //         $search_filter .= ' and city_id=:city_id';
    //     }
    //     if($search_filter!=''){
            
    //         $sql_query=$sql_query.$search_filter;
    //         $this->con->query($sql_query);
    //         if($city_id!=''){
    //             $this->con->bind(':city_id', $city_id); 
    //         }
    //         if($type_id!=''){
    //             $this->con->bind(':type_id', $type_id);
    //         }
    //     }else {
    //         $this->con->query($sql_query);
    //     }
    //     return $this->con->getAll();
    // }
    public function search_posts($user_id,$type_id,$city_id) {
        $this->con->query("SELECT * FROM (SELECT * FROM (SELECT p.id as post_id,p.user_id,CONCAT(u.first_name,' ',u.last_name) AS name,u.profile_img,t.type,c.city,p.description,p.created_at , i.likes FROM post p,type t,city c,user u, (SELECT count(id) as likes,post_id FROM `interested_at` GROUP BY post_id) i WHERE i.post_id=p.id and p.type_id=t.id and p.type_id=:type_id and p.city_id=c.id and p.city_id=:city_id and p.user_id=u.id UNION SELECT p.id as post_id,p.user_id,CONCAT(u.first_name,' ',u.last_name) AS name,u.profile_img,t.type,c.city,p.description,p.created_at,0 as likes FROM post p,type t,city c,user u where p.type_id=t.id and p.type_id=:type_id and p.city_id=:city_id  and p.city_id=c.id and p.user_id=u.id) k GROUP BY post_id ) t1 INNER JOIN (SELECT exists(select 1 from interested_at li where li.post_id = p.id and li.user_id = u.id limit 1) as liked , p.id as post_id FROM user u, post p WHERE u.id = :user_id) t2 ON t1.post_id=t2.post_id");
        $this->con->bind(':user_id', $user_id);
        $this->con->bind(':type_id', $type_id);
        $this->con->bind(':city_id', $city_id);
        return $this->con->getAll();
    }
    //get all post types
    public function all_types(){
        $this->con->query("SELECT * FROM type");
        return $this->con->getAll();
    }
    //get all cities
    public function all_cities(){
        $this->con->query("SELECT * FROM city");
        return $this->con->getAll();
    }
    //return true if post type exists, false if its not exists
    public function type_id_Exists($type_id){
        $this->con->query("SELECT id FROM type WHERE id = :type_id");
        $this->con->bind(':type_id', $type_id);
        $this->con->getSingleResult();
        if($this->con->getRowCount() > 0){
            return true;
        }
        else {
            return false;
        }
    }

    //return true if city exists, false if its not exists
    public function city_id_Exists($city_id){
        $this->con->query("SELECT id FROM city WHERE id = :city_id");
        $this->con->bind(':city_id', $city_id);
        $this->con->getSingleResult();
        if($this->con->getRowCount() > 0){
            return true;
        }
        else {
            return false;
        }
    }
    


}