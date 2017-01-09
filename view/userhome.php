<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
if (isset($_SESSION['username'])) {
    echo 'Welcome, ' . $_SESSION['username'];
    echo '<br>';
    echo 'Click ';
    ?>
    <a href="logout.php">here</a>
    <?php
    echo ' to logout.';
}else{
    header("location: login.php");
}
?>
