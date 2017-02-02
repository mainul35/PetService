<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (isset($_SESSION['username'])) {
    if ($_SESSION['username'] == 'adminlucey') {
        if (isset($_GET['id'])) {
            include_once '../../config/config.php';
            $manager = Config::getManager();
            $manager->selectDB('petservice');
            $sql = "UPDATE `booking` SET `confirmed`= 1 WHERE `bookingId` = '".$_GET['id']."'";
            $manager->query($sql);
            header("location: OrderedServices.php");
            echo '<script>alert("The service has been confirmed.");</script>';
            
        }
    }
}