<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class RegistrationController {

    public function __construct($name, $email, $password, $address, $phnNumber, $sex) {
        include_once '../config/config.php';
        $manager = Config::getManager();
        $manager->selectDB("petservice");

        $sql = "INSERT INTO customer(`name`, `email`, `password`, `address`, `contactNo`, `sex`) VALUES ('" . $name . "','" . $email . "','" . $password . "','" . $address . "','" . $$phnNumber . "','" . $sex . "');";
        $manager->query($sql);
        if (mysqli_error($manager->getConnection())) {
            echo 'Error encountered. ' . mysqli_error($manager->getConnection()) . " at line no. " . mysqli_errno($manager->getConnection()) . "<br>";
        } else {
            echo 'Congratulations, User created successfully!<br>';
        }
    }

}
