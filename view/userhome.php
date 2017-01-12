<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
?>

<?php

if (isset($_SESSION['username'])) {
    if ($_SESSION['username'] == 'adminlucey') {
        header("location: ./admin/AddPetType.php");
    } else {
        header("location: ./user/petRegistration.php");
    }
}else{
    header("location: ./login.php");
}
?>
