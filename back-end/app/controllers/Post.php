<?php
class Post extends Controller {
    public function __construct()
    {
        $this->Post = $this->model('PostModel');
    }
    public function posts_of(){
        try {
            if ($this->verifytoken($this->gettoken())) { 
                print_r(json_encode($this->Post->posts_of($this->verifytoken($this->gettoken()),$this->data->user_id)));
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
    public function one_post(){
        try {
            if ($this->verifytoken($this->gettoken())) { 
                print_r(json_encode($this->Post->one_post($this->verifytoken($this->gettoken()),$this->data->post_id)));
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        } 
    }
    public function create_post(){
        
        try {
            if ($this->verifytoken($this->gettoken())) { 
                print_r(json_encode($this->Post->create_post($this->verifytoken($this->gettoken()),$this->data->type_id,$this->data->city_id,$this->data->description)));
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
    public function delete_post(){
        try {
            if ($this->verifytoken($this->gettoken())) { 
                print_r(json_encode($this->Post->delete_post($this->verifytoken($this->gettoken()),$this->data->post_id)));
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
    public function all_posts(){
        try {
            if ($this->verifytoken($this->gettoken())) { 
                print_r(json_encode($this->Post->all_posts($this->verifytoken($this->gettoken()))));
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
    public function all_cities(){
        try {
            
                print_r(json_encode($this->Post->all_cities()));
            
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
    public function search_posts(){
        try {
            if ($this->verifytoken($this->gettoken())) { 
                print_r(json_encode($this->Post->search_posts($this->verifytoken($this->gettoken()),$this->data->type_id,$this->data->city_id)));
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
    public function all_types(){
        try {
            if ($this->verifytoken($this->gettoken())) { 
                print_r(json_encode($this->Post->all_types()));
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
    
    
    
}