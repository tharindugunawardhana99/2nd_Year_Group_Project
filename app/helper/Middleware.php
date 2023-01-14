<?php

class Middleware{
    public static function redirect($page){
        header('location:' . URLROOT . '/' . $page);
    }
    
    public static function authorizeUser($current_userrole, $authorized_role){
        if($current_userrole == $authorized_role){
            return;
        }
        else{
            Middleware::redirect('access/restrict');
        }
    }

    public static function isLoggedIn(){
        if(Session::isLoggedIn()){
            Middleware::redirect('access/restrict');
            exit();
        }
    }

    public static function isNotLoggedIn(){
        if(!Session::isLoggedIn()){
            Middleware::redirect('access/unauth');
            exit();
        }
    }
}