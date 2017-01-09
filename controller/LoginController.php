<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class LoginController{
    public function __construct() {
    }

    public function checkLogin($username, $password) {
        include_once '../config/config.php';
        $manager = Config::getManager();
        $manager->selectDB("petservice");
        $username = mysqli_real_escape_string($manager->getConnection(), $username);
        $password = mysqli_real_escape_string($manager->getConnection(), $password);
        
        if($this->getPassword($manager, $username)==md5($password)){
            return true;
        }
    }
    
    private function getPassword($manager, $username) {
        $sql="select `password` from customer where `username`='".$username."';";
        $result = $manager->query($sql);
        return $manager->fetchArray($result)[0];
    }
}