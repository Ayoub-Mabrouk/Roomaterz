<?php
// require $_SERVER['DOCUMENT_ROOT'].'/MVC/app/vendor/autoload.php';
require_once '../app/vendor/autoload.php';
// require_once 'vendor/firebase/php-jwt/src/JWT.php';
use \Firebase\JWT\JWT;

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


/*
 * Base controller
 * loads the models and views
 */
class Controller
{
    public $data;
    public $key = "randomthing";

    // load model
    public function model($model)
    {
        // require model file
        require_once '../app/models/' . $model . '.php';
        // instantiate model
        return new $model();
    }

    public function authorization($user_id)
    {
        $iat = time();
        // 30min
        $exp = $iat + 60 * 30;
        $payload = array(
            "iss" => "localhost",
            "aud" => "localhost",
            "iat" => $iat,
            'exp' => $exp,
            'user_id' => $user_id
        );
        $jwt = JWT::encode($payload, $this->key, 'HS512');
        return $jwt;
    }
    public function gettoken()
    {
        return isset(apache_request_headers()['Authorization']) ? str_replace('Bearer ', '', apache_request_headers()['Authorization']) : false;
    }
    public function verifytoken($token)
    {
        if ($token) {
            try {
                return isset(JWT::decode($token, $this->key, array('HS512'))->user_id) ? JWT::decode($token, $this->key, array('HS512'))->user_id : false;
            } catch (\Throwable $th) {
                return false;
            }
        }else{
            return false;
        }
    }
    //upload images
    public static function uplaod_image($imagefile)
    {  
        $valid_extensions = array('jpeg', 'jpg');
        $upload_success=0;
        if ($imagefile == []) {
            return null;
        }
        $fileName  =  $imagefile['name'];
        $tempPath  = $imagefile['tmp_name'];
        $fileSize  =  $imagefile['size'];
        $path = realpath(__DIR__ . './../..'. "/public/storage/images/");
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $name = $fileName[1].md5(time() . mt_rand(1, 1000000)).uniqid('',true).$fileName[0];
        if (in_array($fileExt, $valid_extensions)) {
            if ($fileSize < 5000000) {
                if (move_uploaded_file($tempPath, $path .'/'. $name . '.' . $fileExt)) {
                    $upload_success=1;
                    print_r(json_encode(['message'=>'uploaded succefully']));
                } else {
                    print_r(json_encode(["message" => "Sorry, cant move the file", "status" => false]));
                }
            } else {
                print_r(json_encode(["message" => "Sorry, your file is too large, please upload 5 MB size", "status" => false]));

            }
        } else {
            print_r(json_encode(["message" => "Sorry, only JPG, JPEG files are allowed", "status" => false]));
        }
        return array($upload_success,$name.'.'.$fileExt);
    }
    
}
