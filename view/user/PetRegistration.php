<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once '../navbar.php';
?>
<head>
    <link rel="stylesheet" href="../../css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../../css/bootstrap-theme.css"/>
    <link rel="stylesheet" href="../../css/w3.css"/>
    <link rel="stylesheet" href="../../css/style.css"/>
</head>
<div class="form-div">
    <form class="w3-container" method="post" action="PetRegister.php" enctype="multipart/form-data">
        <table>
            <tr>
                <td>
                    <label for="petName">Pet Name</label>
                </td>
                <td>
                    <input class="w3-input" type="text" name="petName"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="petAge">Pet Age</label>
                </td>
                <td>
                    <input class="w3-input" type="number" name="petAge"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="petType">Pet Type</label>
                </td>
                <td>
                    <input class="w3-input" type="text" name="petType"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="petImage">Pet Image</label>
                </td>
                <td>
                    <input class="w3-input" type="file" name="petImage"/>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input style="margin-left: 60vh;" class="w3-btn w3-white w3-border w3-border-blue w3-round" type="submit" name="submit" value="Add Pet"/>
                </td>
            </tr>
        </table>
    </form>
</div>
