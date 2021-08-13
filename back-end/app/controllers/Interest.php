<?php
class Interest extends Controller {
    public function __construct()
    {
        $this->Interest = $this->model('InterestModel');
    }
    
    public function my_interests(){
        try {
            if ($this->verifytoken($this->gettoken())) { 
                print_r(json_encode($this->Interest->my_interests($this->verifytoken($this->gettoken()))));
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
    public function notification(){
        try {
            if ($this->verifytoken($this->gettoken())) { 
                print_r(json_encode($this->Interest->notification($this->verifytoken($this->gettoken()))));
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
    public function interested(){
        try {
            if ($this->verifytoken($this->gettoken())) { 
                print_r(json_encode($this->Interest->interested($this->verifytoken($this->gettoken()),$this->data->post_id)));
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
    public function disinterested(){
        try {
            if ($this->verifytoken($this->gettoken())) { 
                print_r(json_encode($this->Interest->disinterested($this->verifytoken($this->gettoken()),$this->data->post_id)));
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
    
}