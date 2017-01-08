<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class LoginController{
    public function __construct() {
    }

    public function checkLogin($email, $password) {
        include_once '../config/config.php';
        $manager = Config::getManager();
        $manager->selectDB("petservice");
        $email = mysqli_real_escape_string($manager->getConnection(), $email);
        $password = mysqli_real_escape_string($manager->getConnection(), $password);
        
        if($this->getPassword($manager, $email)==md5($password)){
            $_SESSION['signedEmail']=$email;
            return true;
        }
    }
    
    private function getPassword($manager, $email) {
        $sql="select `password` from user where `email`='".$email."';";
        $result = $manager->query($sql);
        return $manager->fetchArray($result)[0];
    }
}