<?php
class UserModel
{
    private $con;
    public function __construct()
    {
        $this->con = new Database();
    }
    public function user_info($user_id){
        $this->con->query("SELECT u.id,CONCAT(u.first_name,' ',u.last_name) AS name,u.gender,u.birth_date,c.city,u.email,u.phone,u.profile_img from user u,city c WHERE u.location=c.id AND u.id=:user_id");
        $this->con->bind(':user_id', $user_id);   
        return $this->con->getSingleResult();
    }

    public function register(string $first_name,string $last_name,string $location,string $gender,string $birth_date,string $email,string $phone,string $password,string $profile_img)
    {
        $this->con->query('SELECT * FROM user WHERE email= :email');
        $this->con->bind(':email', $email);
        $this->con->getSingleResult();
        if ($this->con->getRowCount() > 0) {
            return false;
        } else {
            $this->con->query("INSERT INTO user (first_name, last_name, location,gender,birth_date, email,phone, password,profile_img) VALUES (:first_name, :last_name, :location,:gender,:birth_date, :email,:phone, :password,:profile_img)");
            $this->con->bind(':first_name', $first_name);
            $this->con->bind(':last_name', $last_name);
            $this->con->bind(':location', $location);
            $this->con->bind(':gender', $gender);
            $this->con->bind(':birth_date', $birth_date);
            $this->con->bind(':email', $email);
            $this->con->bind(':phone', $phone);
            $this->con->bind(':password', PASSWORD_HASH($password, PASSWORD_DEFAULT));
            $this->con->bind(':profile_img', $profile_img);
            if ($this->con->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function login( string $email,string $password)
    {

        $this->con->query('SELECT * FROM user WHERE email= :email');
        $this->con->bind(':email', $email);
        $row = $this->con->getSingleResult();
        if ($row) {
            if (password_verify($password, $row->password)) {
                unset($row->password);
                return  ['status'=>true,'data'=>$row];
            } else {
                return ['status'=>false];
            }
        } else {
            return ['status'=>false];
        }
    }
    public function loginByReference($p_reference)
    {
        $this->con->query("SELECT * FROM patient WHERE p_reference= :p_reference ");
        $this->con->bind(':p_reference', $p_reference);
        $row = $this->con->getSingleResult();
        if ($row) {
            unset($row->password);
            $array['status'] = true;
            $array['data'] = $row;
            return  $array;
        } else {
            $array['status'] = false;
            return $array;
        }
    }
    public function profile_photo($user_id,$image_name){
        //fetching the old img url
        $this->con->query("SELECT profile_img FROM user WHERE id= :user_id");
        $this->con->bind(':user_id', $user_id);
        $row = $this->con->getSingleResult();

        //inserting new url
        $this->con->query("UPDATE user SET profile_img=:image_name WHERE id=:user_id");
        $this->con->bind(':user_id', $user_id);
        $this->con->bind(':image_name', $image_name);
        $this->con->getSingleResult();
        if($row->profile_img==''){
            return false;
        }else {
            return $row->profile_img;
        }
        
    }

}
