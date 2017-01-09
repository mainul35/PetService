<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
include_once '../header.html';
include_once './RightNav.php';
?>
<link rel="stylesheet" href="../../css/w3.css"/>
<link rel="stylesheet" href="../../css/style.css"/>
<style>
    .form-div{
        margin: -50% 10% 10% 30%;
        border-radius: 5px;
        border: 1px solid #239585;
        padding: 2%;
        width: 48%;
        padding-left: 5%;
        background-color: #2DD8C0;
    }
</style>
<div class="form-div">
    <form class="w3-container" method="post" action="AddPetType.php">
        <table>
            <tr>
                <td>
                    <label for="petName">Pet Name</label>
                </td>
                <td>
                    <input class="w3-input" type="petName" name="petName"/>
                </td>
            </tr>
            <tr>

                <td colspan="2">
                    <input style="margin-left: 45vh;" class="w3-btn w3-white w3-border w3-border-blue w3-round" type="submit" name="add" value="Add pet type"/>
                </td>
            </tr>
        </table>
    </form>
</div>
