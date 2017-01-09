<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class RegistrationController {

    public function __construct($name, $username, $email, $password, $address, $phnNumber, $sex) {
        include_once '../config/config.php';
        $manager = Config::getManager();
        $manager->selectDB("petservice");
        $name = mysqli_real_escape_string($manager->getConnection(), $name);
        $email = mysqli_real_escape_string($manager->getConnection(), $email);
        $username = mysqli_real_escape_string($manager->getConnection(), $username);
        $password = mysqli_real_escape_string($manager->getConnection(), $password);
        $address = mysqli_real_escape_string($manager->getConnection(), $address);
        $phnNumber = mysqli_real_escape_string($manager->getConnection(), $phnNumber);
        $sex = mysqli_real_escape_string($manager->getConnection(), $sex);
        if ($this->checkEmailExists($manager, $email)) {
            echo 'Sorry, this email is already registered. Try different one.';
        } else if ($this->checkUsernameExists($manager, $username)) {
            echo 'Sorry, this username is already registered. Try different one.';
        } else {
            $sql = "INSERT INTO customer(`name`, `username`, `email`, `password`, `address`, `contactNo`, `sex`) VALUES ('" . $name . "','" . $username . "','" . $email . "','" . md5($password) . "','" . $address . "','" . $phnNumber . "','" . $sex . "');";
            $manager->query($sql);
            if (mysqli_error($manager->getConnection())) {
                echo 'Error encountered. ' . mysqli_error($manager->getConnection()) . " at line no. " . mysqli_errno($manager->getConnection()) . "<br>";
            } else {
                echo 'Congratulations, User created successfully!<br>Click ';
                ?><a href="../view/login.php">here</a><?php
                echo ' to log in.';
            }
        }
    }

    function checkEmailExists($manager, $email) {
        $sql = "Select email from customer WHERE email='" . $email . "'";
        if ($manager->num_rows($manager->query($sql)) > 0) {
            return true;
        }
    }

    function checkUsernameExists($manager, $username) {
        $sql = "Select username from customer WHERE username='" . $username . "'";
        if ($manager->num_rows($manager->query($sql)) > 0) {
            return true;
        }
    }

}
