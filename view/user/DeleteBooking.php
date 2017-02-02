<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!isset($_SESSION['username'])) {
    header("location: ../login.php");
} else {
    include_once '../../config/config.php';
    $manager = Config::getManager();
    $manager->selectDB('petservice');
    if(isset($_GET['id'])){
        $sql = 'DELETE FROM booking WHERE booking.bookingId = "'.$_GET['id'].'"';
        $manager->query($sql);
        header("location: MyOrders.php");
    }
}