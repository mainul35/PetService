<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
if (!isset($_SESSION['username'])) {
    header("location: ../login.php");
} else {
    if (isset($_GET['petId'])) {
        echo $_GET['petId'];
        include_once '../../config/config.php';
        $manager = Config::getManager();
        $manager->selectDB('petservice');

        $sql = "DELETE FROM `booking` WHERE booking.petId='" . $_GET['petId'] . "';";
        $manager->query($sql);
        $sql = "DELETE FROM pet WHERE pet.petId = '" . $_GET['petId'] . "';";
        $manager->query($sql);
        $_SESSION['message'] = true;
        header("location: MyPetList.php");
        echo '<script>alert("Pet has been deleted successfully.");</script>';
    }
}