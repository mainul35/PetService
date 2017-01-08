<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Config{
    public static final function getManager() {
        include_once 'DatabaseManager.php';
        return DatabaseManager::createConnection("root", "");
    }
}