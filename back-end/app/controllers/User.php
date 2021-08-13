<?php
class User extends Controller
{
    public function __construct()
    {
        $this->User = $this->model('UserModel');
    }
    public function user_info()
    {
        try {
            if ($this->verifytoken($this->gettoken())) { 
                print_r(json_encode($this->User->user_info($this->data->user_id)));
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
    public function register()
    {
        $register = $this->User->register($this->data->first_name, $this->data->last_name, $this->data->location,$this->data->gender,$this->data->birth_date, $this->data->email,$this->data->phone, $this->data->password,$this->data->profile_img);
        print_r(json_encode($register));
    }
    public function reference_generator()
    {
        return $this->data->first_name[0] . $this->data->last_name[0] . uniqid() . time() . $this->data->first_name[1] . $this->data->last_name[1];
    } 
    public function login()
    {
        $user = $this->User->login($this->data->email, $this->data->password);
        if ($user['status'] == true) {
            $token = $this->authorization($user['data']->id);
            print_r(json_encode(array(
                'user' => $user['status'],
                'token' => $token,
                'data' => $user['data']
            )));
        } else {
            print_r(json_encode($user['status']));
        }
    }
    public function loginbyreference(){
        $user = $this->User->loginByReference($this->data->p_reference);
        if ($user['status'] == true) {
            $token = $this->authorization($user['data']->p_id);
            print_r(json_encode(array(
                'user' => $user['status'],
                'token' => $token,
                'data' => $user['data']
            )));
        } else {
            print_r(json_encode($user['status']));
        }
    }
    public function check_expiration()
    {   
        exit(json_encode( $this->verifytoken($this->gettoken())));
        
    }
    public function profile_photo(){
        if($this->verifytoken($this->gettoken())){
            $result=$this->uplaod_image($_FILES["image"]);
            if($result[0]){
                $res=$this->User->profile_photo($this->verifytoken($this->gettoken()),$result[1]);
                if($res!=false){
                    unlink(realpath(__DIR__ . './../..'. "/public/storage/images/").'\\'.$res);
                }
            }
        }
        
    }
    
    
}
