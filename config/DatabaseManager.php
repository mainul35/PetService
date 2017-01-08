<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class DatabaseManager {

    private $con;
    private function __construct($user, $password) {
        $this->con = mysqli_connect("localhost", $user, $password);
    }
    
    public function selectDB($dbName) {
        mysqli_select_db($this->con, $dbName);
    }

    public static function createConnection($user, $password) {
        return new DatabaseManager($user, $password);
    }
    public function getConnection() {
        return $this->con;
    }
    public function query($sql) {
        return mysqli_query($this->con, $sql);
    }
    public function num_rows($result) {
        return mysqli_num_rows($result);
    }
    public function fetchArray($result) {
        return mysqli_fetch_array($result);
    }
    public function fetchAssociativeArray($result) {
        return mysqli_fetch_assoc($result);
    }
    private function __clone() {
        
    }
}
